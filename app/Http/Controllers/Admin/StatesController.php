<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\CityDatatable;
use App\DataTables\StateDatatable;
use App\Http\Requests\CityRequest;
use App\Http\Requests\StateRequest;
use App\Model\City;
use App\Model\State;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CountryDatatable;
use Illuminate\Support\Facades\Auth;
use Form;
class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CityDatatable $city
     * @return void
     */
    public function index(StateDatatable $city)
    {
        return $city->render('admin.states.index',['title'=>'Admin State']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if (request()->ajax())
        {
            if (request()->has('country_id'))
            {
                $select = request()->has('select')?request('select'):'';
                return \Form::select('city_id',City::where('country_id',request('country_id'))->pluck('city_name_'.session('lang'),'id'),$select,['class'=>'form-control']);

            }
        }
        return view('admin.states.create',['title'=>'State Create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StateRequest $request
     * @return RedirectResponse
     */
    public function store(StateRequest $request)
    {
        $att = $request->post();
        State::create($att);
        session()->flash('success', 'City Add Success');
        return redirect('admin/cities');
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
        $state = State::findOrFail($id);
        return view('admin.states.edit',['title'=>'State Edit'])->with('state', $state);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CityRequest $request
     * @param int $id
     * @return RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(StateRequest $request, $id)
    {
        $state = State::find($id);
        $att = $request->post();

        $state->update($att);

        session()->flash('success', 'State Update Success');
        return redirect('admin/states');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        if ($id == Auth::id()) {

            session()->flash('info', 'This Admin Your Account Cant Delete');
            return redirect('admin/admin');

        } else {

            $state = State::find($id);
            $stateName = $state->state_name_en;
            $state->delete();
            session()->flash('danger', 'State ' . $stateName . ' Delete Success');
            return redirect('admin/states');
        }
    }
    /**
     * Remove the all resource Select from storage.
     *
     * @param  int  $id
     * @return RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function multiDelete(Request $request)
    {
       if (is_array(request('item'))){
           foreach (request('item') as $id) {
               $state = State::find($id);
               $state->delete();
           }
       }else{
           $state = State::find(request('item'));
           $state->delete();
       }
        session()->flash('danger', 'State Delete Success');
        return redirect('admin/states');
    }
}
