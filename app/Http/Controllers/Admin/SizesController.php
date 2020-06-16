<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\SizeDatatable;
use App\Http\Requests\SizeRequest;
use App\Model\Country;
use App\Model\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param SizeDatatable $size
     * @return void
     */
    public function index(SizeDatatable $size)
    {
        return $size->render('admin.sizes.index',['title'=>'Size']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.sizes.create',['title'=>'Size Create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SizeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SizeRequest $request)
    {
        $att = $request->post();
//        $att['is_public']  == 0 ? $att['is_public']='yes': $att['is_public']= 'no';

        Size::create($att);
        session()->flash('success', 'Size Add Success');
        return redirect('admin/sizes');
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
        $size = Size::findOrFail($id);
        return view('admin.sizes.edit',['title'=>'Size Edit'])->with('size', $size);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SizeRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(SizeRequest $request, $id)
    {
        $size = Size::find($id);
        $att = $request->post();
//        $att['is_public']  == 0 ? $att['is_public']='yes': $att['is_public'] ='no';

        $size->update($att);

        session()->flash('success', 'Size Update Success');
        return redirect('admin/sizes');


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

            $size = Size::find($id);
            Storage::delete($size->icon);
            $sizeName =$size->name_en;
            $size->delete();
            session()->flash('danger', 'Size ' . $sizeName . ' Delete Success');
            return redirect('admin/sizes');
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
               $size = Size::find($id);
               Storage::delete($size->icon);
               $size->delete();
           }
       }else{
           $size = Size::find(request('item'));
           Storage::delete($size->icon);
           $size->delete();
       }
        session()->flash('danger', 'Size Delete Success');
        return redirect('admin/sizes');
    }
}
