<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    ul {
        margin: 0;
        padding: 2px 0px 0px 15px;
    }
    li {
        list-style: square;
    }
    p {
        text-align: justify;
        text-justify: inter-word;
    }
</style>
<body>
    <div>
        <div>
            <section style="float:left;">
                <img src="https://i.ibb.co/qxKhd8f/ukdw.png" style="height:80px;padding-top:20px;padding-left:5px" alt="UKDW">
                <section style="float:right;padding-left:80px">
                <label for="univ" style="font-size:13pt;font-family:ebrima;word-spacing: 1pt">UNIVERSITAS KRISTEN DUTA WACANA</label><br>
                <label for="univ" style="font-size:13pt;font-family:arial;word-spacing: 6pt"><b>FAKULTAS TEKNOLOGI INFORMASI</b></label>
                <ul>
                    <li style="font-size:11pt;">PROGRAM STUDI INFORMATIKA</li>
                    <li style="font-size:11pt;">PROGRAM STUDI SISTEM INFORMASI</li>
                </ul>
                </section>
            </section>
        </div>
    </div>
    <div style="padding-top:150px" >
        <div align="center">
            <label for="kop" style="letter-spacing: 2px"><b><u>Surat Tugas</u></b><br></label> 
            <label for="nomer"><b>No. : {{$nosurat}}/D/FTI/2021</b></label>
        </div>
        <div style="padding-left:70px;padding-right:70px;padding-top:60px">
            <p>Sehubungan dengan permintaan dari {{$pemohon}}, untuk ini Dekan Fakultas Teknologi Informasi Universitas Kristen Duta Wacana Yogyakarta memberikan tugas kepada {{$role}} tersebut dibawah ini :</p>
            <table style="padding-left:13%;padding-top:10px">
                <tr>
                    <td style="width:120px">Nama</td>
                    <td>:</td>
                    <td>{{$nama}}</td>
                </tr>
                <tr>
                    <td>Nomor Induk</td>
                    <td>:</td>
                    <td>{{$id}}</td>
                </tr>
            </table>
            <div style="padding-top:20px">
                <p>Untuk {{$ket}}, yang diselenggarakan pada :</p>
                <table style="padding-left:13%;padding-top:10px">
                <tr>
                    <td style="width:120px">Hari/tanggal</td>
                    <td>:</td>
                    <td>{{$tgl}}</td>
                </tr>
                <tr>
                    <td>Tema</td>
                    <td>:</td>
                    <td>{{$acara}}</td>
                </tr>
                <tr>
                    <td>Tempat</td>
                    <td>:</td>
                    <td>{{$lok}}</td>
                </tr>
            </table>
                <p style="padding-top:10px">Demikian Surat Tugas ini dibuat untuk dapat dipergunakan sebagaimana perlunya</p>
            </div>
            <div style="padding-top:80px">
            <label for="ttd">Yogyakarta, 
                <?php $blnsk = date("F"); $tglsk = date("d"); $thsk = date("Y");
                    switch ($blnsk) {
                        case"January":$blnsk="Januari";break;
                        case"February":$blnsk="Februari";break;
                        case"March":$blnsk="Maret";break;
                        case"April":$blnsk="April";break;
                        case"May":$blnsk="Mei";break;
                        case"June":$blnsk="Juni";break;
                        case"July":$blnsk="Juli";break;
                        case"August":$blnsk="Agustus";break;
                        case"September":$blnsk="September";break;
                        case"October":$blnsk="Oktober";break;
                        case"November":$blnsk="November";break;
                        case"December":$blnsk="Desember";break;
                    }
                    echo $tglsk." ".$blnsk." ".$thsk;
                ?></label><br>
            <label for="jabatan"><b>Dekan,</b></label>
            <div style="padding-top:60px;padding-bottom:20px">
                <label for="sign">
                    <img src="data:image/png;base64, {!! $qrcode !!}">
                </label>
            </div>
            <label for="namattd"><b><u>{{$namattd}}</u></b></label><br>
            <label for="idttd">{{$idttd}}</label>
            </div>
        </div>
    </div>
</body>
</html>