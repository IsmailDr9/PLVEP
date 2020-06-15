<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangControllerSet extends Controller
{
    public function getLang($lang, $id=null){
        if (!is_null($id)){
            $admin = \App\Admin::where('id',$id)->first();
            if (!empty($admin)){
                $admin->lang = $lang;
                $admin->save();
            }
        }
        session()->has('lang') ? session()->forget('lang') : '';
        $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');
        return back();
    }
}
