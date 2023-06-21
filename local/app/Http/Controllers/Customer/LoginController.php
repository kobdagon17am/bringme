<?php

namespace App\Http\Controllers\Customer;

use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
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
    dd($req->all());
    $get_member = User::where('email', '=', $req->email)
      ->where('password', '=', md5($req->password))
      ->first();
      dd($get_member);

  if ($get_member) {
    //   session()->forget('access_from_admin');
      Auth::guard('admin')->login($get_member);

      return redirect('admin');
    } else {
      return redirect('admin')->withError('Pless check username and password !.');
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
