<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\CityDatatable;
use App\Http\Requests\CityRequest;
use App\Model\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CountryDatatable;
use Illuminate\Support\Facades\Auth;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CityDatatable $city
     * @return void
     */
    public function index(CityDatatable $city)
    {
        return $city->render('admin.cities.index',['title'=>'Admin Cities']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.cities.create',['title'=>'City Create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CityRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CityRequest $request)
    {
        $att = $request->post();
        City::create($att);
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
        $city = City::findOrFail($id);
        return view('admin.cities.edit',['title'=>'City Edit'])->with('city', $city);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CityRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CityRequest $request, $id)
    {
        $city = City::find($id);
        $att = $request->post();

        $city->update($att);

        session()->flash('success', 'City Update Success');
        return redirect('admin/cities');


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

            $city = City::find($id);
            $cityName = $city->country_name_en;
            $city->delete();
            session()->flash('danger', 'City ' . $cityName . ' Delete Success');
            return redirect('admin/cities');
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
               $city = City::find($id);
               $city->delete();
           }
       }else{
           $city = Country::find(request('item'));
           $city->delete();
       }
        session()->flash('danger', 'City Delete Success');
        return redirect('admin/cities');
    }
}
