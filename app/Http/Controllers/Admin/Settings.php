<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Setting;
use Illuminate\Support\Facades\Storage;

class Settings extends Controller
{

    public function setting()
    {
        return view('admin.settings', ['title' => 'Admin Settings']);
    }

    public function setting_save()
    {
        $data = $this->validate(request(),['logo' => validateImage(), 'icon' => validateImage()]);
        $data = request()->except(['_token', '_method']);

        if (request()->hasFile('logo')) {
            !empty(setting()->logo)?Storage::delete(setting()->logo):'';
            $data['logo'] = request()->file('logo')->store('settings') ;
        }

        if (request()->hasFile('icon')) {
            !empty(setting()->icon)?Storage::delete(setting()->icon):'';
            $data['icon'] = request()->file('icon')->store('settings') ;
        }

        Setting::orderBy('id', 'desc')->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('settings'));
    }
}