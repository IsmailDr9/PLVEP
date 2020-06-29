<?php

use App\Model\Department;
use App\Model\MallProduct;

if (!function_exists('aurl')) {
    function aurl($url = null) {
        return url('admin/'.$url);
    }
}

if (!function_exists('admin')) {
    function admin() {
        return auth()->guard('admin');
    }
}

if (!function_exists('active_menu')) {
    function active_menu($link) {
        if (preg_match('/'.$link.'/i', Request::segment(2))) {
            return ['menu-open', 'display:block'];
        } else {
            return ['', ''];
        }
    }
}

if (!function_exists('lang')) {
    function lang() {
        if (session()->has('lang')) {
            return session('lang');
        } else {
            return 'en';
        }
    }
}

if (!function_exists('direction')) {
    function direction() {
        if (session()->has('lang')) {
            if (session('lang') == 'ar') {
                return 'rtl';
            } else {
                return 'ltr';
            }
        } else {
            return 'ltr';
        }
    }
}

if (!function_exists('datatable_lang')) {
    function datatable_lang() {
        return ['sProcessing' => trans('admin.sProcessing'),
            'sLengthMenu'        => trans('admin.sLengthMenu'),
            'sZeroRecords'       => trans('admin.sZeroRecords'),
            'sEmptyTable'        => trans('admin.sEmptyTable'),
            'sInfo'              => trans('admin.sInfo'),
            'sInfoEmpty'         => trans('admin.sInfoEmpty'),
            'sInfoFiltered'      => trans('admin.sInfoFiltered'),
            'sInfoPostFix'       => trans('admin.sInfoPostFix'),
            'sSearch'            => trans('admin.sSearch'),
            'sUrl'               => trans('admin.sUrl'),
            'sInfoThousands'     => trans('admin.sInfoThousands'),
            'sLoadingRecords'    => trans('admin.sLoadingRecords'),
            'oPaginate'          => [
                'sFirst'            => trans('admin.sFirst'),
                'sLast'             => trans('admin.sLast'),
                'sNext'             => trans('admin.sNext'),
                'sPrevious'         => trans('admin.sPrevious'),
            ],
            'oAria'            => [
                'sSortAscending'  => trans('admin.sSortAscending'),
                'sSortDescending' => trans('admin.sSortDescending'),
            ],
        ];
    }
}

if (!function_exists('setting')) {
    function setting() {
        return \App\Model\Setting::orderBy('id', 'desc')->first();
    }
}
//Settings Validate
if (!function_exists('validateImage')) {
    function validateImage($ext = null) {
        if ($ext === null)
        {
            return 'image|mimes:jpg,jpeg,png,gif,bmp';
        }else{
            return 'image|mimes:'.$ext;
        }
    }
}
//End Settings Validate

if (!function_exists('loadDepartment')) {
    function loadDepartment($select = null, $dep_hid = null )
    {
        $departments = \App\Model\Department::selectRaw('dep_name_' . session('lang') . ' as text')
            ->selectRaw('id as id')
            ->selectRaw('parent as parent')
            ->get(['text', 'parent', 'id']);
        $dep_arr = [];
        foreach ($departments as $department) {
            $list_arr = [];
            $list_arr['icon'] = '';
            $list_arr['li_attr'] = '';
            $list_arr['a_attr'] = '';
            $list_arr['children'] = '';

            if ($select !== null && $select == $department->id) {

                $list_arr['state'] = [
                    'opened' => true,
                    'selected' => true,
                    'disabled' => false
                ];
            }
            if ($dep_hid !== null && $dep_hid == $department->id) {

                $list_arr['state'] = [
                    'opened' => false,
                    'selected' => false,
                    'disabled' => true,
                    'hidden' => true
                ];
            }
            $list_arr['id'] = $department->id;
            $list_arr['parent'] = $department->parent > 0 ? $department->parent : '#';
            $list_arr['text'] = $department->text;
            array_push($dep_arr, $list_arr);
        }
        return json_encode($dep_arr, JSON_UNESCAPED_UNICODE);
    }
}

if (!function_exists('getParent')) {

    function getParent($depId)
    {
        $department = Department::find($depId);

        if ($department->parent !== null && $department->parent > 0) {

            return getParent($department->parent) . ',' . $depId;

        } else {

            return $depId;

        }
    }
}

if (!function_exists('up')) {
    function up() {
        return new \App\Http\Controllers\Upload;
    }
}

//scan mall id exist
if (!function_exists('mallId')){
    function mallId($mallId, $productId){
        return MallProduct::where('product_id',$productId)->where('mall_id',$mallId)
            ->count()  >0;
    }
}