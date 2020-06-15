<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\CountryRequest;
use App\Model\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CountryDatatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CountryDatatable $country
     * @return void
     */
    public function index(CountryDatatable $country)
    {
        return $country->render('admin.countries.index',['title'=>'Admin Countries']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.countries.create',['title'=>'Country Create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CountryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CountryRequest $request)
    {
        $att = $request->post();
        if (request()->hasFile('logo')) {
            $att['logo'] = request()->file('logo')->store('countries') ;
        }
        Country::create($att);
        session()->flash('success', 'Country Add Success');
        return redirect('admin/countries');
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
        $country = Country::findOrFail($id);
        return view('admin.countries.edit',['title'=>'Country Edit'])->with('country', $country);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CountryRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CountryRequest $request, $id)
    {
        $country = Country::find($id);
        $att = $request->post();

        if (request()->hasFile('logo')) {
            !empty($country->logo)?Storage::delete($country->logo):'';
            $data['logo'] = request()->file('logo')->store('countries') ;
        }

        $country->update($att);

        session()->flash('success', 'Country Update Success');
        return redirect('admin/countries');


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

            $country = Country::find($id);
            Storage::delete($country->logo);
            $countryName = $country->country_name_en;
            $country->delete();
            session()->flash('danger', 'Country ' . $countryName . ' Delete Success');
            return redirect('admin/countries');
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
               $country = Country::find($id);
               Storage::delete($country->logo);
               $country->delete();
           }
       }else{
           $country = Country::find(request('item'));
           Storage::delete($country->logo);
           $country->delete();
       }
        session()->flash('danger', 'Country Delete Success');
        return redirect('admin/countries');
    }
}
