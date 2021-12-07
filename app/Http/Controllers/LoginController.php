<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{

    public function index(){
        return view('login');
    }

    public function ceklogin(){
        $email = $_POST['email'];
        $pw = $_POST['pw'];
        $db = DB::select("SELECT * FROM users WHERE email = '".$email."' AND password = '".$pw."'");
        foreach ($db as $d){
            $id = $d->id_users;
            $role = $d->role;
        }
        if ($db) {
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['role'] = $role;
            return redirect()->action(
                [dashboardController::class, 'dash']
            );
		}
		   else {
			return back()->with('error', 'Failed to Log In');
		}
        
    }
    
}
