<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    function __construct(){
        session_start();
    }

    public function profile(){
        try {
            $user = $_SESSION['id'];
            $role = $_SESSION['role'];
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'You must Log in first');
        }
        $profile = DB::select("SELECT * FROM users WHERE id_users = :id", ['id' => $_SESSION['id']]);
        if($_SESSION['role']=="admin"){
            return view('admin/profileadm', ['pr' => $profile]);
        }else if($_SESSION['role']=="mahasiswa"){
            return view('mahasiswa/profile', ['pr' => $profile]);
        }else {
            return view('dosen/profileds', ['pr' => $profile]);
        }
        
    }
}
