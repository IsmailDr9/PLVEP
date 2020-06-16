<?php
namespace App\helper;

use App\Admin;
use App\Model\City;
//use App\Model\Manufacturer;
use App\Model\Color;
use App\Model\Mall;
use App\Model\Manufacturer;
use App\Model\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class Useful {

    /**
     * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed|string
     */
    public static function getLang()
    {
        if (session()->has('lang')) {
            return session('lang');
        } else {
            return 'en';
        }

    }

    /**
     * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed|string
     */
    public static function getDir()
    {
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

    /**
     * @return array
     */
    public static function lang()
    {
        $langJason = [
            'sProcessing' => trans('admin.sProcessing'),
            'sLengthMenu' => trans('admin.sLengthMenu'),
            'sZeroRecords' => trans('admin.sZeroRecords'),
            'sEmptyTable' => trans('admin.sEmptyTable'),
            'sInfo' => trans('admin.sInfo'),
            'sInfoEmpty' => trans('admin.sInfoEmpty'),
            'sInfoFiltered' => trans('admin.sInfoFiltered'),

            'sInfoPostFix' => trans('admin.sInfoPostFix'),
            'sSearch' => trans('admin.sSearch'),
            'sUrl' => trans('admin.sUrl'),
            'sInfoThousands' => trans('admin.sInfoThousands'),
            'sLoadingRecords' => trans('admin.sLoadingRecords'),
            'oPaginate' => [
                'sFirst' => trans('admin.sFirst'),
                'sLast' => trans('admin.sLast'),
                'sNext' => trans('admin.sNext'),
                'sPrevious' => trans('admin.sPrevious'),
            ],
            'oAria' => [
                'sSortAscending' => trans('admin.sSortAscending'),
                'sSortDescending' => trans('admin.sSortDescending'),
            ],
        ];

        return $langJason;
    }

    public static function getAdminName($id)
    {
        if (!is_null($id)) {
            $admin = Admin::find($id);
            if (!empty($admin)) {
                return $admin->name;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public static function getUserName($id)
    {
        if (!is_null($id)) {
            $admin = User::find($id);
            if (!empty($admin)) {
                return $admin->name;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public static function getManufacturerName($id)
    {
        if (!is_null($id)) {
            $model = Manufacturer::find($id);
            if (!empty($model)) {
                return $model->name_en;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public static function getMallName($id)
    {
        if (!is_null($id)) {
            $model = Mall::find($id);
            if (!empty($model)) {
                return $model->name_en;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    public static function getColorName($id)
    {
        if (!is_null($id)) {
            $model = Color::find($id);
            if (!empty($model)) {
                return $model->name_en;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public static function getCityName($id)
    {
        if (!is_null($id)) {
            $city = City::find($id);
            if (!empty($city)) {
                return $city->city_name_en;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public static function getStateName($id)
    {
        if (!is_null($id)) {
            $state = State::find($id);
            if (!empty($state)) {
                return $state->state_name_en;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public static function getUserLevel()
    {
        return Config::get('param.user-level');

    }
}