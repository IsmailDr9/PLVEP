<?php

namespace App\Http\Controllers\Admin;

use App\helper\Useful;
use App\User;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\UserDatatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param UserDatatable $admin
     * @return void
     */
    public function index(UserDatatable $admin)
    {
        return $admin->render('admin.users.index',['title'=>'User Controller']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $userLevel = Useful::getUserLevel();
        return view('admin.users.create',['title'=>'User Create'])->with('userLevel',$userLevel);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $att = $request->post();
        $att['password'] = bcrypt($request->password);
        $att['lang'] = !is_null(session('lang')) ? session('lang') : 'en';
        $user->create($att);
        session()->flash('success', 'User Add Success');
        return redirect('admin/user');
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
        $user = User::findOrFail($id);
        $userLevel = Useful::getUserLevel();
        return view('admin.users.edit',['title'=>'User Edit'])->with('user',$user)->with('userLevel',$userLevel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UserRequest $request, $id)
    {
        $admin = User::findOrFail($id);
        $dataPassword = $request->all();
        $data = $request->except('password');
        if (!is_null($request->password)) {

            $dataPassword['password'] = bcrypt($request->password);
            $admin->update($dataPassword);
        } else {
            $admin->update($data);
        }

        session()->flash('success', 'User Update Success');
        return redirect('admin/user');


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
            session()->flash('info', 'This User Your Account Cant Delete');
            return redirect('admin/user');
        } else {
            $admin = User::find($id);
            $adminName = $admin->name;
            $admin->delete();
            session()->flash('danger', 'User ' . $adminName . ' Delete Success');
            return redirect('admin/user');
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

                $admin = User::findOrFail($item);

                $admin->delete();

            } else {

                session()->flash('info', 'This User Your Account Cant Delete');
                return redirect('admin/admin');
            }

        }
        session()->flash('danger', 'User Delete Success');
        return redirect('admin/user');
    }
}
