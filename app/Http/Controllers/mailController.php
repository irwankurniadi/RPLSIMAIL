<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;

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
            $sket = DB::select("SELECT * FROM s_ket WHERE status = 'On Process'");
            return view('admin/mailin', ['sp' => $sp, 'ba' => $ba, 'df' => $df, 'sk' => $sk, 'sket' => $sket]);
        }else{
            #already signed
            $sp = DB::select("SELECT * FROM s_person WHERE status = 'Accepted' AND id_user = '".$_SESSION['id']."'");
            $ba = DB::select("SELECT * FROM b_acara WHERE status = 'Accepted' AND id_user = '".$_SESSION['id']."'");
            $df = DB::select("SELECT * FROM dft_hadir WHERE status = 'Accepted' AND id_user = '".$_SESSION['id']."'");
            $sk = DB::select("SELECT * FROM sk_dekan WHERE status = 'Accepted' AND id_user = '".$_SESSION['id']."'");
            $sket = DB::select("SELECT * FROM s_ket WHERE status = 'Accepted' AND id_user = '".$_SESSION['id']."'");
            if($_SESSION['role'] == "mahasiswa"){
                return view('mahasiswa/mailin', ['sp' => $sp, 'ba' => $ba, 'dft' => $df, 'sk' => $sk, 'sket' => $sket]);
            }else{
                return view('dosen/mailin', ['sp' => $sp, 'ba' => $ba, 'dft' => $df, 'sk' => $sk, 'sket' => $sket]);
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
            $sp = DB::select("SELECT * FROM s_person WHERE id_user = '".$_SESSION['id']."' ORDER BY id_surat DESC LIMIT 5 ");

            $ba = DB::select("SELECT * FROM b_acara WHERE id_user = '".$_SESSION['id']."' ORDER BY id_surat DESC  LIMIT 5 ");

            $df = DB::select("SELECT * FROM dft_hadir WHERE id_user = '".$_SESSION['id']."' ORDER BY id_surat DESC  LIMIT 5 ");

            $st = DB::select("SELECT * FROM sk_dekan WHERE id_user = '".$_SESSION['id']."' ORDER BY id_surat DESC  LIMIT 5 ");

            $sk = DB::select("SELECT * FROM s_ket WHERE id_user = '".$_SESSION['id']."' ORDER BY id_surat DESC  LIMIT 5 ");

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
        if($tp==md5('s_person')){
            $srt = "s_person";
        }else if($tp==md5('s_ket')){
            $srt = "s_ket";
        }else if($tp==md5('sk_dekan')){
            $srt = "sk_dekan";
        }else if($tp==md5('dft_hadir')){
            $srt = "dft_hadir";
        }else if($tp==md5('b_acara')){
            $srt = "b_acara";
        }
        $cno = DB::select("SELECT count(no_surat) as nosurat FROM $srt");
        foreach ($cno as $c){
            $nums = $c->nosurat;
        }
        $nobaru = $nums+1;
        $ttd = $_POST['ac'];
        
        if($srt=="b_acara"){
            $sn = $_POST['sn']." - ".$_POST['cmp'];
            DB::update(
                "UPDATE $srt SET 
                status = 'Accepted', 
                no_surat = '$nobaru', 
                nama_ttd = '$ttd',
                nama_ttd_2 = '$sn'
                WHERE id_surat = ?",
                [$_GET['id']]
            );
        }else {
            DB::update(
                "UPDATE $srt SET 
                status = 'Accepted', 
                no_surat = '$nobaru', 
                nama_ttd = '$ttd'
                WHERE id_surat = ?",
                [$_GET['id']]
            );
        }
        return redirect('/mailin');
    }
    function decline(){
        $tp = $_GET['type'];
        if($tp==md5('s_person')){
            $srt = "s_person";
        }else if($tp==md5('s_ket')){
            $srt = "s_ket";
        }else if($tp==md5('sk_dekan')){
            $srt = "sk_dekan";
        }else if($tp==md5('dft_hadir')){
            $srt = "dft_hadir";
        }else if($tp==md5('b_acara')){
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
        }else if($tp==md5('sket')){
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
            if($_SESSION['role']=='admin'){
                $id = $_POST['id'];
            }else {
                $id = $_SESSION['id'];
            }
            $pp = $_POST['pp'];
            $tgl = $_POST['tgl'];
            $at = $_POST['at'];
            $lok = $_POST['lok'];
            $desc = $_POST['desc'];

            DB::insert("INSERT INTO $dbs (id_user, tgl, hal, n_mitra, al_mitra, isi, status) values (?,?,?,?,?,?,?)", [$id, "$tgl", "$pp", "$at", "$lok", "$desc", 'On Process']);
        }else if($dbs=="b_acara"){
            if($_SESSION['role']=='admin'){
                $id = $_POST['id'];
            }else {
                $id = $_SESSION['id'];
            }
            $tgl = $_POST['tgl'];
            $en = $_POST['nm_e'];
            $et = $_POST['tm_e'];
            $lok = $_POST['lok'];
            $desc = $_POST['desc'];

            DB::insert("INSERT INTO $dbs (id_user, tgl, tema, nama_acara, tempat, keterangan, status) values (?,?,?,?,?,?,?)", [$id, "$tgl", "$et", $en, "$lok", "$desc",'On Process']);
        }else if($dbs=="dft_hadir"){
            if($_SESSION['role']=='admin'){
                $id = $_POST['id'];
            }else {
                $id = $_SESSION['id'];
            }
            $tgl = $_POST['tgl'];
            $en = $_POST['nm_e'];
            $st = $_POST['stime'];
            $et = $_POST['etime'];
            $lok = $_POST['lok'];
            $guest = $_POST['guest'];
            $evman = $_POST['evman'];

            DB::insert("INSERT INTO $dbs (id_user, tgl, jam, nama_acara, tempat, pembicara, nama_ttd, status) values (?,?,?,?,?,?,?,?)", [$id, "$tgl", "$st - $et", $en, "$lok", "$guest", $evman, 'On Process']);
        }
        else if($dbs=="s_ket"){
            if($_SESSION['role']=='admin'){
                $id = $_POST['id'];
            }else {
                $id = $_SESSION['id'];
            }
            $tgl = $_POST['tgl'];
            $sem = $_POST['sem'];
            $maj = $_POST['maj'];
            $fac = $_POST['fac'];

            DB::insert("INSERT INTO $dbs (id_user, tgl, semester, prodi, fakult, status) values (?,?,?,?,?,?)", [$id, "$tgl", "$sem", "$maj", "$fac", 'On Process']);
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

    function download(){
        try {
            $user = $_SESSION['id'];
            $role = $_SESSION['role'];
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'You must Log in first');
        }
        $tp = $_GET['type'];
        if($tp==md5('sp')){
            $rev = "s_person";
            $filename = "SuratPersonalia";
            $view = "suratpersonal";
        }else if($tp==md5('sket')){
            $rev = "s_ket";
            $filename = "SuratKeterangan";
            $view = "suratket";
        }else if($tp==md5('sk')){
            $rev = "sk_dekan";
            $filename = "SuratTugas";
            $view = "surattugas";
        }else if($tp==md5('dft')){
            $rev = "dft_hadir";
            $filename = "DaftarHadir";
            $view = "daftarhadir";
        }else if($tp==md5('ba')){
            $rev = "b_acara";
            $filename = "BeritaAcara";
            $view = "beritaacara";
        }
        $content = DB::select("SELECT * FROM $rev WHERE id_surat = '".$_GET['id']."'");
        $namauser = DB::select("SELECT nama FROM users WHERE id_users = '".$_SESSION['id']."'");
        foreach($namauser as $nm){
            $nama = $nm->nama;
        }
        if($tp==md5('sp')){
            foreach($content as $c){
                $no = $c->no_surat;
                $id = $c->id_user;
                $tgl = $c->tgl;
                $hal = $c->hal;
                $nmit = $c->n_mitra;
                $almit = $c->al_mitra;
                $isi = $c->isi;
                $ttd = $c->nama_ttd;
            }
        }else if($tp==md5('sket')){
            foreach($content as $c){
                $no = $c->no_surat;
                $id = $c->id_user;
                $tgl = $c->tgl;
                $sem = $c->semester;
                $pro = $c->prodi;
                $fac = $c->fakult;
                $ttd = $c->nama_ttd;
            }
        }else if($tp==md5('sk')){
            foreach($content as $c){
                $no = $c->no_surat;
                $id = $c->id_user;
                $tglm = $c->tgl_mulai;
                $tgls = $c->tgl_sls;
                $pem = $c->pemohon;
                $ac = $c->acara;
                $ket = $c->keterangan;
                $lok = $c->tempat;
                $ttd = $c->nama_ttd;
            }
        }else if($tp==md5('dft')){
            foreach($content as $c){
                $no = $c->no_surat;
                $id = $c->id_user;
                $tg = $c->tgl;
                $pemb = $c->pembicara;
                $ac = $c->nama_acara;
                $jam = $c->jam;
                $lok = $c->tempat;
                $ttd = $c->nama_ttd;
            }
        }else if($tp==md5('ba')){
            $no = 1;
            $ttd = "72190317 - Irwan Kurniadi";
        }
        
        if($no<10){
            $num = "00".$no;
        }else if($no=10&&$no<100){
            $num = "0".$no;
        }else {
            $num = $no;
        }
        $tglsk = date('dnY');
        #$tglfn = date_format($tgfn, 'dnY');
        $idttd = substr($ttd, 0, 7);
        $namattd = substr($ttd, 10, 50);
        $string = "Yang Bertanda Tangan : ";
        $qrcode = base64_encode(QrCode::size(100)->errorCorrection('H')->generate("$string\nNama : $namattd\nID : $idttd"));

        if($tp==md5('sp')){
            $data = ['nosurat' => $num,
                     'hal' => $hal, 
                     'nmitra' => $nmit, 
                     'almitra' => $almit, 
                     'namattd' => $namattd, 
                     'isi' => $isi,
                     'tgl' => $tgl, 
                     'idttd' => $idttd];
        }else if($tp==md5('sket')){
            $data = ['nosurat' => $num,
                     'nama' => $nama,
                     'role' => $_SESSION['role'],
                     'id' => $id, 
                     'fac' => $fac, 
                     'maj' => $pro, 
                     'namattd' => $namattd, 
                     'sem' => $sem,
                     'tgl' => $tgl, 
                     'idttd' => $idttd];
        }else if($tp==md5('sk')){
            $data = ['nosurat' => $num,
                     'nama' => $nama,
                     'pemohon' => $pem,
                     'role' => $_SESSION['role'],
                     'id' => $id, 
                     'ket' => $ket, 
                     'tglm' => $tglm, 
                     'namattd' => $namattd, 
                     'acara' => $ac,
                     'lok' => $lok,
                     'tgls' => $tgls, 
                     'idttd' => $idttd];
        }else if($tp==md5('dft')){
            $data = ['nakeg' => $ac,
                     'pemb' => $pemb,
                     'time' => $jam, 
                     'tgl' => $tg, 
                     'namattd' => $namattd, 
                     'lok' => $lok, 
                     'idttd' => $idttd];
        }else if($tp==md5('ba')){
            $data = ['no' => $no];
        }

        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView("/surat/$view", $data, compact('qrcode'))->stream($filename."_".$num.$tglsk.'.pdf');
    }

    function archive(){
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
            $sp = DB::select("SELECT * FROM s_person");
            $ba = DB::select("SELECT * FROM b_acara");
            $df = DB::select("SELECT * FROM dft_hadir");
            $st = DB::select("SELECT * FROM sk_dekan");
            $sk = DB::select("SELECT * FROM s_ket");
            return view('admin/arsip', ['sp' => $sp, 'ba' => $ba, 'df' => $df, 'sk' => $sk, 'st' => $st]);
        }else if($_SESSION['role'] == "mahasiswa"){
            return view('mahasiswa/arsip', ['sk' => $sk, 'st' => $st]);
        }else{
            return view('dosen/arsip', ['ba' => $ba, 'st' => $st, 'sk' => $sk]);
        }
    }

    function cek(){
        return view('surat/beritaacara');
    }
}
