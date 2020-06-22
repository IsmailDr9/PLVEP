<?php

namespace App\Http\Controllers\Admin;

use App\Model\Weight;
use Illuminate\Http\Request;
use App\DataTables\WeightDatatable;
use App\Http\Requests\WeightRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WeightsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param WeightDatatable $weight
     * @return void
     */
    public function index(WeightDatatable $weight)
    {
        return $weight->render('admin.weights.index',['title'=>'Weight']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.weights.create',['title'=>'Weight Create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param WeightRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(WeightRequest $request)
    {
        $att = $request->post();

        Weight::create($att);
        session()->flash('success', 'Weight Add Success');
        return redirect('admin/weights');
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
        $weight = Weight::findOrFail($id);
        return view('admin.weights.edit',['title'=>'Weight Edit'])->with('weight', $weight);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param WeightRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(WeightRequest $request, $id)
    {
        $weight = Weight::find($id);
        $att = $request->post();

        $weight->update($att);

        session()->flash('success', 'Weight Update Success');
        return redirect('admin/weights');


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

            $weight = Weight::find($id);
            $weightName =$weight->name_en;
            $weight->delete();
            session()->flash('danger', 'Weight ' . $weightName . ' Delete Success');
            return redirect('admin/weights');
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
               $weight = Weight::find($id);
               $weight->delete();
           }
       }else{
           $weight = Weight::find(request('item'));
           $weight->delete();
       }
        session()->flash('danger', 'Weight Delete Success');
        return redirect('admin/weights');
    }
}
