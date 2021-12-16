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
            <label for="kop" style="font-size:13pt"><b>Berita Acara</b><br></label> 
            <label for="kop" style="font-size:12pt;padding-top:10px"><b>{{$acara}}</b><br></label>
            <label for="kop" style="font-size:12pt"><b><i>"{{$tema}}"</i></b><br></label> 
            <label for="nomer"><b>No. : {{$nosurat}}/E/FTI/2021</b></label>
        </div>
        <div style="padding-left:70px;padding-right:70px;padding-top:60px">
                <p>Pada hari ini : {{$tgl}} bertempat di {{$lok}} telah dilangsukan {{$acara}} dengan tema {{$tema}} dengan mengundang pembicara yaitu {{$guest}}. Acara ini diikuti oleh seluruh civitas akademika UKDW dan perwakilan dari beberapa mitra kerjasama Fakultas Teknologi Informasi UKDW.
                </p>
                <p style="padding-top:5px">{{$ket}}</p>
                <p style="padding-top:5px">Demikian Berita Acara ini dibuat dengan sebenarnya, untuk dapat dipergunakan sebagaimana mestinya.</p>
        </div>
    </div>
    <div style="padding-top:80px;padding-left:70px;padding-right:70px;text-align:center;">
        <label for="ttd">Yogyakarta, {{$tglA." ".$bln." ".$tglY}}</label><br>
        <label for="mengetahui"><b>Mengetahui</b> <br></label>
        <table style="width:100%;text-align:center">
            <tr>
                <td >Dekan,</td>
                <td >Perwakilan<br>{{$cmp}}</td>
            </tr>
            <tr>
                <td style="width:50%">
                    <img src="data:image/png;base64, {!! $qrcode !!}">
                </td>
                <td></td>
            </tr>
            <tr>
                <td>( {{$ttddek}} )</td>
                <td>( {{$ttdgs}} )</td>
            </tr>
        </table>
    </div>
</body>
</html>