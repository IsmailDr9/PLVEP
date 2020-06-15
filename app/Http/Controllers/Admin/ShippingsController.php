<?php

namespace App\Http\Controllers\Admin;

use App\Model\Shipping;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\DataTables\ShippingsDatatable;
use App\Http\Requests\ShippingRequest;
use Illuminate\Support\Facades\Storage;

class ShippingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ShippingsDatatable $shipping
     * @return void
     */
    public function index(ShippingsDatatable $shipping)
    {
        return $shipping->render('admin.shippings.index',['title'=>'Shipping']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $companies = User::select('id','name')->where('level','company')->get();
        return view('admin.shippings.create',['title'=>'Shipping Create'])->with('companies', $companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ShippingRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ShippingRequest $request)
    {
        $att = $request->post();
        if (request()->hasFile('icon')) {
            $att['icon'] = request()->file('icon')->store('shippings') ;
        }
        Shipping::create($att);
        session()->flash('success', 'Shipping Add Success');
        return redirect('admin/shippings');
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
        $shipping = Shipping::with('company')->findOrFail($id);

        $companies = User::select('id','name')->where('level','company')->get();

        return view('admin.shippings.edit',['title'=>'Shipping Edit'])->with('shipping', $shipping)->with('companies', $companies);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ShippingRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ShippingRequest $request, $id)
    {
        $shipping = Shipping::find($id);
        $att = $request->post();

        if (request()->hasFile('icon')) {
            !empty($shipping->icon)?Storage::delete($shipping->icon):'';
            $att['icon'] = request()->file('icon')->store('shippings') ;
        }

        $shipping->update($att);

        session()->flash('success', 'Shipping Update Success');
        return redirect('admin/shippings');


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

            $shipping = Shipping::find($id);
            Storage::delete($shipping->icon);
            $shippingName =$shipping->name_en;
            $shipping->delete();
            session()->flash('danger', 'Shipping ' . $shippingName . ' Delete Success');
            return redirect('admin/shippings');
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
               $shipping = Shipping::find($id);
               Storage::delete($shipping->icon);
               $shipping->delete();
           }
       }else{
           $shipping = Shipping::find(request('item'));
           Storage::delete($shipping->icon);
           $shipping->delete();
       }
        session()->flash('danger', 'Manufacturer Delete Success');
        return redirect('admin/shippings');
    }
}
