<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class mailController extends Controller
{
    function __construct(){
        session_start();
    }
    public function mailin(){
        try {
            $user = $_SESSION['id'];
            $role = $_SESSION['role'];
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'You must Log in first');
        }
        if($_SESSION['role'] == "admin"){
            #request sign
            $sp = DB::select("SELECT * FROM s_person WHERE status = 'On Process'");
            $ba = DB::select("SELECT * FROM b_acara WHERE status = 'On Process'");
            $df = DB::select("SELECT * FROM dft_hadir WHERE status = 'On Process'");
            $sk = DB::select("SELECT * FROM sk_dekan WHERE status = 'On Process'");
            return view('admin/mailin', ['sp' => $sp, 'ba' => $ba, 'df' => $df, 'sk' => $sk]);
        }else{
            #already signed
            $sp = DB::select("SELECT * FROM s_person WHERE status = 'Accepted' AND id_user = '".$_SESSION['id']."'");
            $ba = DB::select("SELECT * FROM b_acara WHERE status = 'Accepted' AND id_user = '".$_SESSION['id']."'");
            $df = DB::select("SELECT * FROM dft_hadir WHERE status = 'Accepted' AND id_user = '".$_SESSION['id']."'");
            $sk = DB::select("SELECT * FROM sk_dekan WHERE status = 'Accepted' AND id_user = '".$_SESSION['id']."'");
            if($_SESSION['role'] == "mahasiswa"){
                return view('mahasiswa/mailin', ['sp' => $sp, 'ba' => $ba, 'df' => $df, 'sk' => $sk]);
            }else{
                return view('dosen/mailin', ['sp' => $sp, 'ba' => $ba, 'df' => $df, 'sk' => $sk]);
            }
        }
    }
    public function mailout(){
        try {
            $user = $_SESSION['id'];
            $role = $_SESSION['role'];
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'You must Log in first');
        }
        #mail sent - raw
            $sp = DB::select("SELECT * FROM s_person WHERE id_user = '".$_SESSION['id']."'");

            $ba = DB::select("SELECT * FROM b_acara WHERE id_user = '".$_SESSION['id']."'");

            $df = DB::select("SELECT * FROM dft_hadir WHERE id_user = '".$_SESSION['id']."'");

            $st = DB::select("SELECT * FROM sk_dekan WHERE id_user = '".$_SESSION['id']."'");

            $sk = DB::select("SELECT * FROM s_ket WHERE id_user = '".$_SESSION['id']."'");

        if($_SESSION['role'] == "admin"){
            return view('admin/mailout', ['sp' => $sp, 'ba' => $ba, 'df' => $df, 'sk' => $sk, 'st' => $st]);
        }else if($_SESSION['role'] == "mahasiswa"){
            return view('mahasiswa/mailout', ['sk' => $sk, 'st' => $st]);
        }else{
            return view('dosen/mailout', ['ba' => $ba, 'st' => $st, 'sk' => $sk]);
        }
    }

    function accept(){
        $tp = $_GET['type'];
        if($tp==md5('sp')){
            $srt = "s_person";
        }else if($tp==md5('sk')){
            $srt = "s_ket";
        }else if($tp==md5('st')){
            $srt = "sk_dekan";
        }else if($tp==md5('dft')){
            $srt = "dft_hadir";
        }else if($tp==md5('ba')){
            $srt = "b_acara";
        }
        $cno = DB::select("SELECT count(no_surat) as nosurat FROM $srt");
        foreach ($cno as $c){
            $nums = $c->nosurat;
        }
        $nobaru = $nums+1;
        
        DB::update(
            "UPDATE $srt SET status = 'Accepted', no_surat = '$nobaru' WHERE id_surat = ?",
            [$_GET['id']]
        );
        return redirect('/mailin');
    }
    function decline(){
        $tp = $_GET['type'];
        if($tp==md5('sp')){
            $srt = "s_person";
        }else if($tp==md5('sk')){
            $srt = "s_ket";
        }else if($tp==md5('st')){
            $srt = "sk_dekan";
        }else if($tp==md5('dft')){
            $srt = "dft_hadir";
        }else if($tp==md5('ba')){
            $srt = "b_acara";
        }
        $al = $_POST['dc'];
        DB::update(
            "UPDATE $srt SET status = 'Declined', alasan = '$al' WHERE id_surat = ?",
            [$_GET['id']]
        );
        return redirect('/mailin');
    }

    function review(){
        try {
            $user = $_SESSION['id'];
            $role = $_SESSION['role'];
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'You must Log in first');
        }
        $tp = $_GET['type'];
        if($tp==md5('sp')){
            $rev = "s_person";
        }else if($tp==md5('st')){
            $rev = "s_ket";
        }else if($tp==md5('sk')){
            $rev = "sk_dekan";
        }else if($tp==md5('dft')){
            $rev = "dft_hadir";
        }else if($tp==md5('ba')){
            $rev = "b_acara";
        }
        $content = DB::select("SELECT * FROM $rev WHERE id_surat = '".$_GET['id']."'");
        
        if($_SESSION['role'] == "admin"){
            return view('admin/review', ['rev' => $rev, 'cont' => $content]);
        }else {
            return view('review', ['rev' => $rev, 'cont' => $content]);
        }
        
    }

    function create(){
        try {
            $user = $_SESSION['id'];
            $role = $_SESSION['role'];
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'You must Log in first');
        }
        $srt = $_GET['type'];
        if($srt==md5("sp")){
            $s = "sp";
        }else if($srt==md5("sk")){
            $s = "sk";
        }
        else if($srt==md5("st")){
            $s = "st";
        }
        else if($srt==md5("ba")){
            $s = "ba";
        }else if($srt==md5("dft")){
            $s = "dft";
        }

        if($_SESSION['role'] == "admin"){
            return view('admin/forms/form'.$s);
        }else if($_SESSION['role'] == "mahasiswa"){
            return view('mahasiswa/forms/form'.$s);
        }else{
            return view('dosen/forms/form'.$s);
        }
    }

    function insertmail(){
        $dbs = $_POST['dbs'];
        if($dbs=="s_person"){
            $id = $_POST['id'];
            $pp = $_POST['pp'];
            $tgl = $_POST['tgl'];
            $at = $_POST['at'];
            $lok = $_POST['lok'];
            $desc = $_POST['desc'];
            $ids = $_POST['ids'];
            $idn = $_POST['idn'];

            DB::insert("INSERT INTO $dbs (id_user, tgl, hal, n_mitra, al_mitra, isi, status) values (?,?,?,?,?,?,?)", [$id, "$tgl", "$pp", "$at", "$lok", "$desc", 'On Process']);
        }else if($dbs=="b_acara"){
            $id = $_POST['id'];
            $tgl = $_POST['tgl'];
            $en = $_POST['nm_e'];
            $et = $_POST['tm_e'];
            $lok = $_POST['lok'];
            $desc = $_POST['desc'];
            $sign1 = $_POST['sign1'];
            $sign2 = $_POST['sign2'];

            DB::insert("INSERT INTO $dbs (id_user, tgl, tema, nama_acara, tempat, keterangan, nama_ttd_1, nama_ttd_2, status) values (?,?,?,?,?,?,?,?,?)", [$id, "$tgl", "$et", $en, "$lok", "$desc", $sign1, "$sign2", 'On Process']);
        }else if($dbs=="dft_hadir"){
            $id = $_POST['id'];
            $tgl = $_POST['tgl'];
            $en = $_POST['nm_e'];
            $st = $_POST['stime'];
            $et = $_POST['etime'];
            $lok = $_POST['lok'];
            $guest = $_POST['guest'];
            $evman = $_POST['evman'];

            DB::insert("INSERT INTO $dbs (id_user, tgl, jam, nama_acara, tempat, pembicara, nama_ttd, status) values (?,?,?,?,?,?,?,?,?)", [$id, "$tgl", "$st."-".$et", $en, "$lok", "$guest", $evman, "$sign2", 'On Process']);
        }
        else if($dbs=="s_ket"){
            $id = $_POST['id'];
            $tgl = $_POST['tgl'];
            $sem = $_POST['sem'];
            $maj = $_POST['maj'];
            $fac = $_POST['fac'];

            DB::insert("INSERT INTO $dbs (id_user, tgl, sem, prodi, fakult, status) values (?,?,?,?,?,?)", [$id, "$tgl", "$sem", "$maj", "$fac", 'On Process']);
        }
        else if($dbs=="sk_dekan"){
            if($_SESSION['role']=="admin"){
                $id = $_POST['id'];
            }else {
                $id = $_SESSION['id'];
            }
            $req = $_POST['req'];
            $ad = $_POST['desc'];
            $st = $_POST['tgls'];
            $et = $_POST['tgle'];
            $ev = $_POST['ev'];
            $lok = $_POST['lok'];

            DB::insert("INSERT INTO $dbs (id_user, pemohon, keterangan, tgl_mulai, tgl_sls, acara, tempat, status) values (?,?,?,?,?,?,?,?)", [$id, "$req", "$ad", "$st","$et", $ev, "$lok", 'On Process']);
        }
        return redirect('/mailout');
    }
}
