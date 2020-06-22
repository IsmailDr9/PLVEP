<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Model\Product;
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
        return $product->render('admin.products.index',['title'=>'Admin products']);
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
        if (!empty($product)){

            return redirect(route('products.edit',$product->id));
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
            $att['logo'] = request()->file('logo')->store('products') ;
        }
        Product::create($att);
        session()->flash('success', 'Product Add Success');
        return redirect('admin/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.product',['title'=>'Create Or Edit Product'])->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $att = $request->post();

        if (request()->hasFile('logo')) {
            !empty($product->logo)?Storage::delete($product->logo):'';
            $data['logo'] = request()->file('logo')->store('products') ;
        }

        $product->update($att);

        session()->flash('success', 'Product Update Success');
        return redirect('admin/products');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        if ($id == Auth::id()) {

            session()->flash('info', 'This Admin Your Account Cant Delete');
            return redirect('admin/admin');

        } else {

            $product = Product::find($id);
            Storage::delete($product->logo);
            $productName = $product->Product_name_en;
            $product->delete();
            session()->flash('danger', 'Product ' . $productName . ' Delete Success');
            return redirect('admin/products');
        }
    }
    /**
     * Remove the all resource Select from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function multiDelete(Request $request)
    {
       if (is_array(request('item'))){
           foreach (request('item') as $id) {
               $product = Product::find($id);
               Storage::delete($product->logo);
               $product->delete();
           }
       }else{
           $product = Product::find(request('item'));
           Storage::delete($product->logo);
           $product->delete();
       }
        session()->flash('danger', 'Product Delete Success');
        return redirect('admin/products');
    }

    /**
     * Upload Product Images To Storage.
     *
     * @param  int  $productId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Symfony\Component\HttpFoundation\Response
     */
    public function uploadImage($productId)
    {
        if (request()->hasFile('file')) {
             $fid = up()->upload([
                'file'  => 'file',
                'path'  => 'products/' . $productId,
                'file_type' => 'product',
                'upload_type' => 'files',
                'relation_id' => $productId,
            ]);

            return response(['status' => true, 'id' => $fid],200);
        }
    }

    /**
     * Delete Product Images To Storage.
     *
     */
    public function deleteImage()
    {
        if (request()->has('id')) {
            return up()->delete(request('id'));
        }
    }
}
