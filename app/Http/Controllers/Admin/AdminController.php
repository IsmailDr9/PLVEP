<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Requests\AdminRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\AdminDatatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param AdminDatatable $admin
     * @return void
     */
    public function index(AdminDatatable $admin)
    {
        return $admin->render('admin.admins.index',['title'=>'Admin Controller']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.admins.create',['title'=>'Admin Create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminRequest $request)
    {
        $admin = new Admin();
        $att = $request->post();
        $att['password'] = bcrypt($request->password);
        $att['lang'] = !is_null(session('lang')) ? session('lang') : 'en';
        $admin->create($att);
        session()->flash('success', 'Admin Add Success');
        return redirect('admin/admin');
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
        $admin = Admin::findOrFail($id);
        return view('admin.admins.edit',['title'=>'Admin Edit'])->with('admin',$admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(AdminRequest $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $dataPassword = $request->all();
        $data = $request->except('password');
        if (!is_null($request->password)) {

            $dataPassword['password'] = bcrypt($request->password);
            $admin->update($dataPassword);
        } else {
            $admin->update($data);
        }

        session()->flash('success', 'Admin Update Success');
        return redirect('admin/admin');


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
            $admin = Admin::find($id);
            $adminName = $admin->name;
            $admin->delete();
            session()->flash('danger', 'Admin ' . $adminName . ' Delete Success');
            return redirect('admin/admin');
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
        foreach ($request->item as $item) {

            $currentAdmin = Auth::id();

            if ($currentAdmin != $item) {

                $admin = Admin::findOrFail($item);

                $admin->delete();

            } else {

                session()->flash('info', 'This Admin Your Account Cant Delete');
                return redirect('admin/admin');
            }

        }
        session()->flash('danger', 'Admin Delete Success');
        return redirect('admin/admin');
    }
}
