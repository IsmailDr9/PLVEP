<?php

namespace App\Http\Controllers\Admin;

use App\Model\Color;
use Illuminate\Http\Request;
use App\DataTables\ColorDatatable;
use App\Http\Requests\ColorRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ColorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ColorDatatable $color
     * @return void
     */
    public function index(ColorDatatable $color)
    {
        return $color->render('admin.colors.index',['title'=>'Color']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.colors.create',['title'=>'Color Create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ColorRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ColorRequest $request)
    {
        $att = $request->post();
        Color::create($att);
        session()->flash('success', 'Color Add Success');
        return redirect('admin/colors');
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
        $color = Color::findOrFail($id);
        return view('admin.colors.edit',['title'=>'Color Edit'])->with('color', $color);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ColorRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ColorRequest $request, $id)
    {
        $color = Color::find($id);
        $att = $request->post();

        $color->update($att);
        session()->flash('success', 'Color Update Success');
        return redirect('admin/colors');

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

            $color = Color::find($id);
            $colorName =$color->name_en;
            $color->delete();
            session()->flash('danger', 'Color ' . $colorName . ' Delete Success');
            return redirect('admin/colors');
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
               $color = Color::find($id);
               $color->delete();
           }
       }else{
           $color = Color::find(request('item'));
           $color->delete();
       }
        session()->flash('danger', 'Color Delete Success');
        return redirect('admin/colors');
    }
}
