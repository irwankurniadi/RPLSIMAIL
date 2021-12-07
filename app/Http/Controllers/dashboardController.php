<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    function __construct(){
        session_start();
    }
    public function dash(){
        try {
            $user = $_SESSION['id'];
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'You must Log in first');
        }

        $sp = DB::select("SELECT * FROM s_person");
        $csp = count($sp);

        // $skeg = DB::select("SELECT * FROM s_person");
        // $cskeg = count($skeg);
        
        $dft = DB::select("SELECT * FROM dft_hadir");
        $cdft = count($dft);

        $skdek = DB::select("SELECT * FROM sk_dekan");
        $cskdek = count($skdek);

        $ba = DB::select("SELECT * FROM b_acara");
        $cba = count($ba);

        if($_SESSION['role'] == "admin"){
            return view('admin/dashadmin', ['sp' => $csp, 'dft' => $cdft, 'st' => $cskdek, 'ba' => $cba]);
        }else if($_SESSION['role'] == "mahasiswa"){
            return view('mahasiswa/dashmhs', ['sp' => $csp, 'dft' => $cdft, 'st' => $cskdek, 'ba' => $cba]);
        }else{
            return view('dosen/dashds', ['sp' => $csp, 'dft' => $cdft, 'st' => $cskdek, 'ba' => $cba]);
        }
    }
}