<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use http\Url;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Mail\AdminResetPassword;
use DB;
use Mail;

class AdminAuth extends Controller
{

    use AuthenticatesUsers;

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function checkGuard()
    {
        $rememberMe = request('remember_me') == 1 ? true : false;

        if (auth()->guard('admin')->attempt(['email' => request('email'), 'password' => request('password')], $rememberMe)) {
            Auth::guard('admin');

            $req = request()->all();
            if (!empty($req)) {
                $adminEmail = $req['email'];
                $admin = Admin::where('email', $adminEmail)->first();
                if (!empty($admin)){
                    session()->put('lang', $admin->lang);
                }
            }
            return redirect('admin/home');

        } else {

            session()->flash('error', trans('admin.incorrect_information_login'));
            return redirect('admin/login');
        }

    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();

        $request->session()->invalidate();

        return redirect('admin/login');
    }

    /**
     * forgot password return view
     */
    public function forgetPassword()
    {
        return view('admin.forgot_password');
    }

    /**
     * Forgot Password check with database
     */
    public function resetPassword()
    {

        $admin = Admin::where('email', request('email'))->first();
        if (!empty($admin)) {
            $token = app('auth.password.broker')->createToken($admin);
            $data = DB::table('password_resets')->insert([
                'email' => $admin->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
            Mail::to($admin->email)->send(new AdminResetPassword(['data' => $admin, 'token' => $token]));
            session()->flash('success', trans('admin.the_link_resent_success'));
            return back();
        }
        return back();
    }

    /**
     * Receive Reset Password
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function receiveResetPassword($token)
    {
        $checkToken = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHour(2))->first();
        if (!empty($checkToken)) {
            return view('admin.reset_password')->with('checkToken', $checkToken);
        } else {
            return view('admin.forgot_password');
        }
    }

    /**
     * check on receive new password
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkResetPassword($token)
    {
        $this->validate(request(), [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        $checkToken = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHour(2))->first();

        if (!empty($checkToken)) {

            $admin = Admin::where('email', $checkToken->email)->update([
                'email' => $checkToken->email,
                'password' => bcrypt(request('password')),
            ]);

            DB::table('password_resets')->where('email', request('email'))->delete();
            auth()->guard('admin')->attempt(['email' => $checkToken->email, 'password' => request('password')]);
            Auth::guard('admin');
            return redirect('admin/home');

        } else {

            return view('admin.forgot_password');
        }
    }
}
