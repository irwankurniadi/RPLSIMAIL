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
    <div style="padding-top:150px" >
        <div align="center">
            <label for="kop"><b><u>SURAT KETERANGAN <?php echo strtoupper($role) ?></u></b><br></label> 
            <label for="nomer"><b>No. : {{ $nosurat }}/B/FTI/2021</b></label>
        </div>
        <div style="padding-left:70px;padding-right:70px;padding-top:80px">
            <label for="desc">Dengan ini menerangkan bahwa saya :</label><br>
            <table style="padding-left:20px;padding-top:10px">
                <tr>
                    <td style="width:150px">Nama</td>
                    <td>: {{ $nama }}</td>
                </tr>
                <tr>
                    <td>Nomor Induk</td>
                    <td>: {{ $id }}</td>
                </tr>
            </table>
            <div style="padding-top:30px">
                <p>Merupakan <?php echo ucwords($role) ?> Aktif <?php if($role=="mahasiswa"){ echo "pada Semester ".$sem; } ?> Prodi {{ $maj }} {{ $fac }} Universitas Kristen Duta Wacana</p>
                <p>Demikian Surat Keterangan ini dibuat dengan sebenarnya, untuk dapat dipergunakan sebagaimana mestinya</p>
            </div>
            <div style="padding-top:80px">
            <label for="ttd">Yogyakarta, <?php $tg = date_create($tgl); echo date_format($tg, 'd F Y'); ?> </label><br>
            <label for="jabatan"><b>Dekan,</b></label>
            <div style="padding-top:20px;padding-bottom:20px">
                <label for="sign"><img src="data:image/png;base64, {!! $qrcode !!}"></label>
            </div>
            <label for="namattd"><b><u>{{ $namattd }}</u></b></label><br>
            <label for="idttd">{{ $idttd }}</label>
            </div>
        </div>
    </div>
</body>
</html>