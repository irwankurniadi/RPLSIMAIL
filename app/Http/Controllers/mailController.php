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

        if(!empty($_POST['ac'])){
            $ttd = $_POST['ac'];
        }else {
            $ttd = $_POST['idsn']." - ".$_POST['nmsn'];
        }
        
        if($srt=="b_acara"){
            $sn = $_POST['idsn']." - ".$_POST['nmsn'];
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
            $gs = $_POST['gs'];
            $desc = $_POST['desc'];

            DB::insert("INSERT INTO $dbs (id_user, tgl, tema, nama_acara, tempat, pembicara, keterangan, status) values (?,?,?,?,?,?,?,?)", [$id, "$tgl", "$et", $en, "$lok", "$gs", "$desc",'On Process']);
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
            if($_SESSION['role']=='dosen'){
                $sem = null;
            }else {
                $sem = $_POST['sem'];
            }
            
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
        if($_SESSION['role']=="admin"){
            return redirect('/mailin');
        }else {
            return redirect('/mailout');
        }
        
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
                $tgl = $c->tgl;
                $pemb = $c->pembicara;
                $ac = $c->nama_acara;
                $jam = $c->jam;
                $lok = $c->tempat;
                $ttd = $c->nama_ttd;
            }
        }else if($tp==md5('ba')){
            foreach($content as $c){
                $no = $c->no_surat;
                $id = $c->id_user;
                $tgl = $c->tgl;
                $pemb = $c->pembicara;
                $ac = $c->nama_acara;
                $tema = $c->tema;
                $ket = $c->keterangan;
                $lok = $c->tempat;
                $ttd = $c->nama_ttd;
                $ttd2 = $c->nama_ttd_2;
            }
            $spttd2 = explode(" - ", $ttd2);
            $idttd2 = $spttd2[0];
            $nttd = $spttd2[1];
        }
        $namauser = DB::select("SELECT nama FROM users WHERE id_users = '".$id."'");
        foreach($namauser as $nm){
            $nama = $nm->nama;
        }

        if($tp==md5('sk')){
            $tglmindo = date_create($tglm);
            $hari = date_format($tglmindo, 'l');
            $tglA = date_format($tglmindo, 'd');
            $tglY = date_format($tglmindo, 'Y');
            $bln = date_format($tglmindo, 'F');
            $tglsindo = date_create($tgls);
            $harisl = date_format($tglsindo, 'l');
            $tglAs = date_format($tglsindo, 'd');
            $tglYs = date_format($tglsindo, 'Y');
            $blns = date_format($tglsindo, 'F');
            switch ($harisl) {
                case"Sunday":$harisl="Minggu";break;
                case"Monday":$harisl="Senin";break;
                case"Tuesday":$harisl="Selasa";break;
                case"Wednesday":$harisl="Rabu";break;
                case"Thursday":$harisl="Kamis";break;
                case"Friday":$harisl="Jumat";break;
                case"Saturday":$harisl="Sabtu";break;
            }
            switch ($blns) {
                case"January":$blns="Januari";break;
                case"February":$blns="Februari";break;
                case"March":$blns="Maret";break;
                case"April":$bln="April";break;
                case"May":$blns="Mei";break;
                case"June":$blns="Juni";break;
                case"July":$blns="Juli";break;
                case"August":$blns="Agustus";break;
                case"September":$blns="September";break;
                case"October":$blns="Oktober";break;
                case"November":$blns="November";break;
                case"December":$blns="Desember";break;
            }
            $tanggalslsIndo = $harisl.", ".$tglAs." ".$blns." ".$tglYs;
        }else{
            $tgindo = date_create($tgl);
            $hari = date_format($tgindo, 'l');
            $tglA = date_format($tgindo, 'd');
            $tglY = date_format($tgindo, 'Y');
            $bln = date_format($tgindo, 'F');
        }
        
        switch ($hari) {
            case"Sunday":$hari="Minggu";break;
            case"Monday":$hari="Senin";break;
            case"Tuesday":$hari="Selasa";break;
            case"Wednesday":$hari="Rabu";break;
            case"Thursday":$hari="Kamis";break;
            case"Friday":$hari="Jumat";break;
            case"Saturday":$hari="Sabtu";break;
        }
        switch ($bln) {
            case"January":$bln="Januari";break;
            case"February":$bln="Februari";break;
            case"March":$bln="Maret";break;
            case"April":$bln="April";break;
            case"May":$bln="Mei";break;
            case"June":$bln="Juni";break;
            case"July":$bln="Juli";break;
            case"August":$bln="Agustus";break;
            case"September":$bln="September";break;
            case"October":$bln="Oktober";break;
            case"November":$bln="November";break;
            case"December":$bln="Desember";break;
        }
        $tanggalIndo = $hari.", ".$tglA." ".$bln." ".$tglY;
        $tglIndo = $tglA." ".$bln." ".$tglY;

        if($tp==md5('sk')){
            if($tanggalIndo == $tanggalslsIndo){
                $tglST = $tanggalIndo;
            }else{
                $tglST = $hari." - ".$harisl.", ".$tglA." - ".$tglAs." ".$blns." ".$tglYs;
            }
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
        $spttd = explode(" - ", $ttd);
        $idttd = $spttd[0];
        $namattd = $spttd[1];
        $string = "Yang Bertanda Tangan : ";
        $qrcode = base64_encode(QrCode::size(100)->errorCorrection('H')->generate("$string\nNama : $namattd\nID : $idttd"));

        if($tp==md5('sp')){
            $data = ['nosurat' => $num,
                     'hal' => $hal, 
                     'nmitra' => $nmit, 
                     'almitra' => $almit, 
                     'namattd' => $namattd, 
                     'isi' => $isi,
                     'tgl' => $tglIndo, 
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
                     'tgl' => $tglIndo, 
                     'idttd' => $idttd];
        }else if($tp==md5('sk')){
            $data = ['nosurat' => $num,
                     'nama' => $nama,
                     'pemohon' => $pem,
                     'role' => $_SESSION['role'],
                     'id' => $id, 
                     'ket' => $ket, 
                     'tgl' => $tglST, 
                     'namattd' => $namattd, 
                     'acara' => $ac,
                     'lok' => $lok,
                     'idttd' => $idttd];
        }else if($tp==md5('dft')){
            $data = ['nakeg' => $ac,
                     'pemb' => $pemb,
                     'time' => $jam, 
                     'tgl' => $tanggalIndo, 
                     'namattd' => $namattd, 
                     'lok' => $lok, 
                     'idttd' => $idttd];
        }else if($tp==md5('ba')){
            $data = ['nosurat' => $num,
                     'acara' => $ac,
                     'tema' => $tema,
                     'guest' => $pemb,
                     'hari' => $hari,
                     'tgl' => $tanggalIndo,
                     'tglA' => $tglA,
                     'bln' => $bln,
                     'tglY' => $tglY,
                     'ttddek' => $namattd, 
                     'lok' => $lok, 
                     'ket' => $ket,
                     'cmp' => $idttd2,
                     'ttdgs' => $nttd];
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
