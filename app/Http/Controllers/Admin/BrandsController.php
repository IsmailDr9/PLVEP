<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\BrandRequest;
use App\Model\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\BrandDatatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param BrandDatatable $brand
     * @return void
     */
    public function index(BrandDatatable $brand)
    {
        return $brand->render('admin.brands.index',['title'=>'Admin brands']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.brands.create',['title'=>'Brand Create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BrandRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BrandRequest $request)
    {
        $att = $request->post();
        if (request()->hasFile('logo')) {
            $att['logo'] = request()->file('logo')->store('brands') ;
        }
        Brand::create($att);
        session()->flash('success', 'Brand Add Success');
        return redirect('admin/brands');
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
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit',['title'=>'Brand Edit'])->with('brand', $brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BrandRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(BrandRequest $request, $id)
    {
        $brand = Brand::find($id);
        $att = $request->post();

        if (request()->hasFile('logo')) {
            !empty($brand->logo)?Storage::delete($brand->logo):'';
            $att['logo'] = request()->file('logo')->store('brands') ;
        }

        $brand->update($att);

        session()->flash('success', 'Brand Update Success');
        return redirect('admin/brands');


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

            $brand = Brand::find($id);
            Storage::delete($brand->logo);
            $brandName = $brand->brand_name_en;
            $brand->delete();
            session()->flash('danger', 'Brand ' . $brandName . ' Delete Success');
            return redirect('admin/brands');
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
               $brand = Brand::find($id);
               Storage::delete($brand->logo);
               $brand->delete();
           }
       }else{
           $brand = Brand::find(request('item'));
           Storage::delete($brand->logo);
           $brand->delete();
       }
        session()->flash('danger', 'Brand Delete Success');
        return redirect('admin/brands');
    }
}
