<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\ManufacturerDatatable;
use App\Http\Requests\ManufacturerRequest;
use App\Model\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ManufacturersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ManufacturerDatatable $manufacturer
     * @return void
     */
    public function index(ManufacturerDatatable $manufacturer)
    {
        return $manufacturer->render('admin.manufacturers.index',['title'=>'Manufacturer']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.manufacturers.create',['title'=>'Manufacturer Create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ManufacturerRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ManufacturerRequest $request)
    {
        $att = $request->post();
        if (request()->hasFile('icon')) {
            $att['icon'] = request()->file('icon')->store('manufacturers') ;
        }
        Manufacturer::create($att);
        session()->flash('success', 'Manufacturer Add Success');
        return redirect('admin/manufacturers');
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
        $manufacturer = Manufacturer::findOrFail($id);
        return view('admin.manufacturers.edit',['title'=>'Manufacturer Edit'])->with('manufacturer', $manufacturer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ManufacturerRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ManufacturerRequest $request, $id)
    {
        $manufacturer = Manufacturer::find($id);
        $att = $request->post();

        if (request()->hasFile('icon')) {
            !empty($manufacturer->icon)?Storage::delete($manufacturer->icon):'';
            $att['icon'] = request()->file('icon')->store('manufacturers') ;
        }

        $manufacturer->update($att);

        session()->flash('success', 'Manufacturer Update Success');
        return redirect('admin/manufacturers');


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

            $manufacturer = Manufacturer::find($id);
            Storage::delete($manufacturer->icon);
            $manufacturerName =$manufacturer->name_en;
            $manufacturer->delete();
            session()->flash('danger', 'Manufacturer ' . $manufacturerName . ' Delete Success');
            return redirect('admin/manufacturers');
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
               $manufacturer = Manufacturer::find($id);
               Storage::delete($manufacturer->icon);
               $manufacturer->delete();
           }
       }else{
           $manufacturer = Manufacturer::find(request('item'));
           Storage::delete($manufacturer->icon);
           $manufacturer->delete();
       }
        session()->flash('danger', 'Manufacturer Delete Success');
        return redirect('admin/manufacturers');
    }
}
