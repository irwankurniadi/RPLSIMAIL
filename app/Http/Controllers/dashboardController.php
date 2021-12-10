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

        if($_SESSION['role'] == "admin"){
            $sp = DB::select("SELECT * FROM s_person");
            $csp = count($sp);
            $skeg = DB::select("SELECT * FROM s_ket");
            $cskeg = count($skeg);
            $dft = DB::select("SELECT * FROM dft_hadir");
            $cdft = count($dft);
            $skdek = DB::select("SELECT * FROM sk_dekan");
            $cskdek = count($skdek);
            $ba = DB::select("SELECT * FROM b_acara");
            $cba = count($ba);
            return view('admin/dashadmin', ['csp' => $csp, 'cdft' => $cdft, 'cst' => $cskdek, 'cba' => $cba, 'csk' => $cskeg]);
        }else if($_SESSION['role'] == "mahasiswa"){
            $sketm = DB::select("SELECT * FROM s_ket WHERE id_user = '".$_SESSION['id']."'");
            $csketm = count($sketm);
            $skdek = DB::select("SELECT * FROM sk_dekan WHERE id_user = '".$_SESSION['id']."'");
            $cskdek = count($skdek);
            return view('mahasiswa/dashmhs', ['st' => $cskdek, 'sket' => $csketm]);
        }else{
            $sketd = DB::select("SELECT * FROM s_ket WHERE id_user = '".$_SESSION['id']."'");
            $csketd = count($sketd);
            $skdek = DB::select("SELECT * FROM sk_dekan WHERE id_user = '".$_SESSION['id']."'");
            $cskdek = count($skdek);
            return view('mahasiswa/dashmhs', ['st' => $cskdek, 'sket' => $csketd]);
        }
    }
}
