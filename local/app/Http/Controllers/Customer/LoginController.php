<?php

namespace App\Http\Controllers\Customer;

use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\User;
use App\Customer;
use Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
//use App\Http\Controllers\Session;
class LoginController extends Controller
{
    public function admin_login(Request $req)
    {


        $admin = User::where('email', $req->email)
            // ->whereIn('status', [1, 2])
            ->first();


        if ($admin) {

            if (Hash::check($req->password, $admin->password)) {
                Auth::guard('admin')->login($admin);
                return redirect('admin/home');
            } else {

                return redirect('admin')->withError(
                    'Pless check username and password !.'
                );
            }
        }else{

            return redirect('admin')->withError('Pless check username and password !.');
        }

    }

    public function customer_login(Request $req)
    {


        $admin = Customer::where('email', $req->email)
            // ->whereIn('status', [1, 2])
            ->first();


        if ($admin) {

            if (Hash::check($req->password, $admin->password)) {
                Auth::guard('customer')->login($admin);
                return redirect('home');
            } else {

                return redirect('login')->withError(
                    'Pless check username and password !.'
                );
            }
        }else{

            return redirect('login')->withError('Pless check username and password !.');
        }

    }


    public function forceLogin($username)
    {
        if ($username) {
            $username = Crypt::decryptString($username);
            $user = CUser::where('user_name', $username)->first();

            if ($user) {
                Auth::guard('c_user')->login($user);
                session()->put('access_from_admin', 1);
            }

            return redirect('profile');
        }

        return redirect('/')->withError('Cannot access with this user.');
    }
}
