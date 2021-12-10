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
                <label for="univ" style="font-size:13pt;font-family:arial;word-spacing: 10pt"><b>FAKULTAS TEKNOLOGI INFORMASI</b></label>
                <ul>
                    <li style="font-size:11pt;">PROGRAM STUDI INFORMATIKA</li>
                    <li style="font-size:11pt;">PROGRAM STUDI SISTEM INFORMASI</li>
                </ul>
                </section>
            </section>
        </div>
    </div>
    <div style="padding-top:50px" >
        <div style="padding-left:70px;padding-right:70px;padding-top:50px">
            <table style="padding-top:10px">
                <tr>
                    <td>Nomor</td>
                    <td>:</td>
                    <td>{{$nosurat}}/A/FTI2021</td>
                    <td></td>
                    <td></td>
                    <td><?php $tg = date_create($tgl); echo date_format($tg, 'd F Y'); ?></td>
                </tr>
                <tr>
                    <td>Hal</td>
                    <td>:</td>
                    <td style="width:350px">{{$hal}}</td>
                </tr>
                <tr>
                    <td>Lamp</td>
                    <td>: </td>
                </tr>
            </table>
            <div style="padding-top:30px">
                <tr>
                    <b>
                    <td>Kepada Yth. :</td><br>
                    <td>{{$nmitra}}</td><br>
                    <td>{{$almitra}}</td><br>
                    </b>
                </tr>
            </div>
            <div style="padding-top:30px">
                <p>Salam Sejahtera,</p>
            </div>
            <div style="padding-top:10px">
                <p>{{$isi}}</p>
                <p style="padding-top:30px">Demikian surat ini kami sampaikan, Atas perhatian dan kerjasama yang diberikan, kami mengucapkan terimakasih.</p>
            </div>
            <div style="padding-top:60px">
            <label for="jabatan"><b>Dekan,</b></label>
            <div style="padding-top:60px;padding-bottom:15px">
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