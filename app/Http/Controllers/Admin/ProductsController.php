<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Model\Color;
use App\Model\MallProduct;
use App\Model\OtherData;
use App\Model\Product;
use App\Model\Size;
use App\Model\Weight;
use Illuminate\Http\Request;
use App\DataTables\ProductDatatable;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ProductDatatable $product
     * @return void
     */
    public function index(ProductDatatable $product)
    {
        return $product->render('admin.products.index', ['title' => 'Admin products']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create()
    {
        $product = Product::create([
            'title' => '',
        ]);
        if (!empty($product)) {

            return redirect(route('products.edit', $product->id));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        $att = $request->post();
        if (request()->hasFile('logo')) {
            $att['logo'] = request()->file('logo')->store('products');
        }
        Product::create($att);
        session()->flash('success', 'Product Add Success');
        return redirect('admin/products');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.product', ['title' => 'Create Or Edit Product'])->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Symfony\Component\HttpFoundation\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $att = $request->post();

        MallProduct::where('product_id', $product->id)->delete();
        if ($request->has('malls')){
            MallProduct::where('product_id', $product->id)->delete();
            foreach ($request->get('malls') as $mall){
                MallProduct::create([
                    'product_id' => $product->id,
                    'mall_id'    => $mall,
                ]);
            }
        }

        if ($request->has('input_key') && $request->has('input_value')) {

            $i = 0;
            OtherData::where('product_id',$product->id)->delete();
            foreach ($request->get('input_key') as $key) {

                if (!empty($request->get('input_key')) && !empty($request->get('input_value'))){
                    $dataValue = !empty($request->get('input_key')[$i])?$request->get('input_value')[$i]:'';

                    OtherData::create([
                        'product_id' => $product->id,
                        'data_key' => $key,
                        'data_value' => $dataValue,
                    ]);
                    $i++;
                }

            }
        }

        $product->update($att);

        return response(['status' => true, 'message' => 'Products Update Success'], 200);
    }

    /**
     * Upload Product Images To Storage.
     *
     * @param int $productId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Symfony\Component\HttpFoundation\Response
     */
    public function uploadImage($productId)
    {
        if (request()->hasFile('file')) {
            $fid = up()->upload([
                'file' => 'file',
                'path' => 'products/' . $productId,
                'file_type' => 'product',
                'upload_type' => 'files',
                'relation_id' => $productId,
            ]);

            return response(['status' => true, 'id' => $fid], 200);
        }
    }

    /**
     * Upload Product Images To Storage.
     *
     * @param int $productId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Symfony\Component\HttpFoundation\Response
     */
    public function uploadPrimaryImage($productId)
    {
        $product = Product::findOrFail($productId);

        if (request()->hasFile('file')) {

            $productLogo = request()->file('file')->store('products') ;
            $product->photo = $productLogo;
            $product->save();

            return response(['status' => true, 'id' => $productId], 200);

        }
    }

    /**
     * Delete Product Images From Storage.
     *
     */
    public function deleteImage()
    {
        if (request()->has('id')) {
            return up()->delete(request('id'));
        }
    }

    /**
     * Delete Product Images Primary From Storage.
     * @param $productId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Symfony\Component\HttpFoundation\Response
     */
    public function deletePrimaryImage($productId)
    {
        $product = Product::findOrFail($productId);
        Storage::delete($product->photo);
        $product->photo = null;
        $product->save();
        return response(['status' => true], 200);
    }

    /**
     * Delete Product Images To Storage.
     *
     * @param $productId
     * @return string
     * @throws \Throwable
     */
    public function prepareWeightAndSize($productId)
    {
        $product = Product::findOrFail($productId);
        if (request()->ajax() && request()->has('dep_id')) {

            $depList = array_diff(explode(',', getParent(request('dep_id'))), [request('dep_id')]);

            $sizes = Size::
            where('is_public', 'yes')
                ->whereIn('department_id', $depList)
                ->OrWhere('department_id', request('dep_id'))
                ->pluck('name_' . session('lang'), 'id');

            $weights = Weight::pluck('name_' . session('lang'), 'id');

            return view('admin.products.ajax.size_weight', compact('sizes', 'weights', 'product'))->render();

        } else {

            return 'Please Select Department';

        }
    }
    /**
     * Remove the all resource Select from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function multiDelete(Request $request)
    {
        if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                $product = Product::find($id);

                //delete File And All Photo For this Product
                $this->deleteProductFile($product->id);

                //delete All Mall Products
                $this->deleteProductMall($product->id);

                //delete All Other Data For this Product
                $this->deleteProductOtherData($product->id);

                $product->delete();
            }
        } else {
            $product = Product::find(request('item'));

            //delete File And All Photo For this Product
            $this->deleteProductFile($product->id);

            //delete All Mall Products
            $this->deleteProductMall($product->id);

            //delete All Other Data For this Product
            $this->deleteProductOtherData($product->id);

            $product->delete();
        }
        session()->flash('danger', 'Product Delete Success');
        return redirect('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        //delete File And All Photo For this Product
        $this->deleteProductFile($product->id);

        //delete All Mall Products
        $this->deleteProductMall($product->id);

        //delete All Other Data For this Product
        $this->deleteProductOtherData($product->id);

        $productName = $product->title;
        $product->delete();
        session()->flash('danger', 'Product ' . $productName . ' Delete Success');
        return redirect('admin/products');
    }

    /**
     * Delete All Product Photo
     * @param $productId
     */
    public function deleteProductFile($productId)
    {
        $photos = File::where('file_type','product')->where('relation_id',$productId)->get();
        if (!empty($photos)){
            foreach ($photos as $photo){
                Storage::delete($photo->full_file);
                Storage::deleteDirectory($photo->path);
                $photo->delete();
            }
        }
    }

    /**
     * Delete All Product Mall
     * @param $productId
     */
    public function deleteProductMall($productId)
    {
        $malls = MallProduct::where('product_id',$productId)->get();
        if (!empty($malls)){
            foreach ($malls as $mall){
                $mall->delete();
            }
        }
    }

    /**
     * Delete Product All Other Data
     * @param $productId
     */
    public function deleteProductOtherData($productId)
    {
        $otherData = OtherData::where('product_id',$productId)->get();
        if (!empty($otherData)){
            foreach ($otherData as $othersDatum){
                $othersDatum->delete();
            }
        }
    }

    /**
     * Copy Product
     * @param $productId
     */
    public function productCopy($productId)
    {
        $copyProduct = Product::findOrFail($productId)->toArray();

        unset($copyProduct['id']);
        $product = Product::create($copyProduct);

        $ext = \Illuminate\Support\Facades\File::extension($copyProduct['photo']);
//        $newPath = 'products/' .$product->id.'/'.str_random(30).'.'.$ext;
        $newPath = 'products/'.str_random(30).'.'.$ext;
        Storage::copy($copyProduct['photo'],$newPath);
        $product->photo = $newPath;
        $product->save();

        $orginalProduct = Product::findOrFail($productId);

        $malls  = MallProduct::where('product_id',$orginalProduct->id)->get();
        if (!empty($malls)){
            foreach ($malls as $mall){
                MallProduct::create([
                    'product_id' => $product->id,
                    'mall_id'    => $mall->mall_id,
                ]);
            }
        }

        $otherData = OtherData::where('product_id',$orginalProduct->id)->get();
        if (!empty($otherData)){
            foreach ($otherData as $otherDatum){
                OtherData::create([
                    'product_id' => $product->id,
                    'data_key'   => $otherDatum->data_key,
                    'data_value' => $otherDatum->data_value,
                ]);
            }
        }

//        $photos = File::where('file_type','product')->where('relation_id',$orginalProduct->id)->get();
//        if (!empty($photos)){
//            foreach ($photos as $photo){
//                up()->moveImage([
//                    'file' => $photo->file,
//                    'path' => 'products/' . $product->id,
//                    'file_type' => 'product',
//                    'upload_type' => 'files',
//                    'relation_id' => $product->id,
//                    'name' => $photo->name,
//                    'size' => $photo->size,
//                    'mineType' => $photo->mime_type,
//                    'full_file' => $photo->full_file
//
//                ]);
//            }
//        }
        session()->flash('success', 'Product Copied Success');
        return redirect(route('products.edit', $product->id));
    }
}
