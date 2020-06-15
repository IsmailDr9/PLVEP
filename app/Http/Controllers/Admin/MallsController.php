<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\MallDatatable;
use App\Http\Requests\MallRequest;
use App\Model\Country;
use App\Model\Mall;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MallsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param MallDatatable $mall
     * @return void
     */
    public function index(MallDatatable $mall)
    {
        return $mall->render('admin.malls.index',['title'=>'Mall']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $country = Country::select('id','country_name_'.session('lang'))->get();
        return view('admin.malls.create',['title'=>'Mall Create'])->with('country',$country);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MallRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MallRequest $request)
    {
        $att = $request->post();
        if (request()->hasFile('icon')) {
            $att['icon'] = request()->file('icon')->store('malls') ;
        }
        Mall::create($att);
        session()->flash('success', 'Mall Add Success');
        return redirect('admin/malls');
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
        $mall = Mall::findOrFail($id);
        $country = Country::select('id','country_name_'.session('lang'))->get();
        return view('admin.malls.edit',['title'=>'Mall Edit'])->with('mall', $mall)->with('country',$country);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MallRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(MallRequest $request, $id)
    {
        $mall = Mall::find($id);
        $att = $request->post();

        if (request()->hasFile('icon')) {
            !empty($mall->icon)?Storage::delete($mall->icon):'';
            $att['icon'] = request()->file('icon')->store('malls') ;
        }

        $mall->update($att);

        session()->flash('success', 'Mall Update Success');
        return redirect('admin/malls');


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

            $mall = Mall::find($id);
            Storage::delete($mall->icon);
            $mallName =$mall->name_en;
            $mall->delete();
            session()->flash('danger', 'Mall ' . $mallName . ' Delete Success');
            return redirect('admin/malls');
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
               $mall = Mall::find($id);
               Storage::delete($mall->icon);
               $mall->delete();
           }
       }else{
           $mall = Mall::find(request('item'));
           Storage::delete($mall->icon);
           $mall->delete();
       }
        session()->flash('danger', 'Mall Delete Success');
        return redirect('admin/malls');
    }
}
