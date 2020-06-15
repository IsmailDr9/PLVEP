<?php

namespace App\Http\Controllers\Admin;


use App\Model\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Support\Facades\Storage;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.departments.index',['title'=>'Departments']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.departments.create',['title'=>'Department Create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DepartmentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DepartmentRequest $request)
    {
        $att = $request->post();
        if (request()->hasFile('icon')) {
            $att['icon'] = request()->file('icon')->store('departments') ;
        }
        Department::create($att);
        session()->flash('success', 'Department Add Success');
        return redirect('admin/departments');
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
        $department = Department::findOrFail($id);
        return view('admin.departments.edit',['title'=>'Department Edit'])->with('department', $department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DepartmentRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(DepartmentRequest $request, $id)
    {
        $Department = Department::find($id);
        $att = $request->post();

        if (request()->hasFile('icon')) {
            !empty($Department->icon)?Storage::delete($Department->icon):'';
            $data['icon'] = request()->file('icon')->store('departments') ;
        }

        $Department->update($att);

        session()->flash('success', 'Department Update Success');
        return redirect('admin/departments');


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
            return redirect('admin/departments');

        } else {

            $Department = Department::find($id);
            $subCategories = Department::where('parent', $Department->id)->get();

            if ($subCategories->isNotEmpty()){
                foreach ($subCategories as $subCategory){
                    Storage::delete($subCategory->icon);
                    Storage::delete($Department->icon);
                    $Department->delete();
                    $subCategory->delete();
                }
            }else{
                Storage::delete($Department->icon);
                $Department->delete();
            }
            $DepartmentName = $Department->dep_name_en;

            session()->flash('danger', 'Department ' . $DepartmentName . ' Delete Success');
            return redirect('admin/departments');
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
               $Department = Department::find($id);
               $Department->delete();
           }
       }else{
           $Department = Country::find(request('item'));
           $Department->delete();
       }
        session()->flash('danger', 'Department Delete Success');
        return redirect('admin/departments');
    }
}
