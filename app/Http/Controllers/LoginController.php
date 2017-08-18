<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Authenticatable as Authenticatable;

class LoginController extends Controller
{
    use Authenticatable;
    public function login(){
        return view('login.loginform');
    }

    public function authenticate(){
        $inputUsername = $_POST['username'];
        $inputPassword = $_POST['password'];
        $adminUserModelInstance = new AdminUser();
        $user = $adminUserModelInstance->fetchData($inputUsername);
        if(!empty($user)){
            
            if(md5($inputPassword) == $user->password){
                Auth::login($user);
                echo json_encode('success');
            } else{
                echo json_encode('fail');
            }
        } else{
            echo json_encode('fail');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }
}
