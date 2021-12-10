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
    table, th, td {
        border-collapse: collapse;
    }
</style>
<body>
        <div>
            <section style="float:left;">
                <img src="https://i.ibb.co/qxKhd8f/ukdw.png" style="height:90px;padding-top:30px;padding-left:5px" alt="UKDW">
                <section style="float:right;padding-left:90px">
                <label for="univ" style="font-size:14pt;font-family:Times New Roman;word-spacing: 2pt;padding-bottom:20px"><b>DAFTAR HADIR</b></label><br>
                <label for="prodi" style="font-size:12pt;font-family:Times New Roman;padding-top:40px;">Program Studi SISTEM INFORMASI Fakultas Teknologi Informasi</label><br>
                <label for="ukdw" style="font-size:12pt;font-family:Times New Roman;">Universitas Kristen Duta Wacana</label><br>
                <label for="ukdw" style="font-size:12pt;font-family:Times New Roman;">Jln. Dr. Wahidin Sudirohusodo 5-25 Yogyakarta</label><br>
                <label for="telp" style="font-size:12pt;font-family:Times New Roman;">Telp. 0274563929 ext 321, 322</label>
                </section>
            </section>
        </div>
    <div style="padding-top:50px" >
        <div style="padding-left:5px;padding-right:5px;">
            <div>
                <table>
                    <tr>
                        <td style="width:140px">Nama Kegiatan</td>
                        <td>:</td>
                        <td>ss</td><br>
                    </tr>
                    <tr>
                        <td>Hari, Tanggal</td>
                        <td>:</td>
                        <td>Jumat, 4 Desember 2021</td><br>
                    </tr>
                    <tr>
                        <td>Waktu</td>
                        <td>:</td>
                        <td>10:00 - 12:00 WIB</td><br>
                    </tr>
                    <tr>
                        <td>Tempat</td>
                        <td>:</td>
                        <td>UKDW</td><br>
                    </tr>
                    <tr>
                        <td>Pembicara</td>
                        <td>:</td>
                        <td>Bapak saya</td><br>
                    </tr>
                </table>
            </div>
            <div style="padding-top:30px">
                <table style="border:1px solid black;width:100%">
                    <tr align="center" > 
                        <td style="border:1px solid black">No.</td>
                        <td style="border:1px solid black">NIM</td>
                        <td style="border:1px solid black">Nama Lengkap</td>
                        <td style="border:1px solid black">Tanda Tangan</td>
                    </tr>
                    <?php
                    for ($i=1; $i<11; $i++) {?>
                    <tr>
                        <td style="border:1px solid black;width:30px"><?php echo $i."." ?></td>
                        <td style="border:1px solid black"></td>
                        <td style="border:1px solid black"></td>
                        <td style="border:1px solid black"><?php echo $i ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <div style="padding-top:60px">
            <label for="jabatan"><b>Penanggung Jawab</b></label>
            <div style="padding-top:60px;padding-bottom:15px">
                <label for="sign">
                    ttd
                </label>
            </div>
            <label for="namattd"><b><u>ss</u></b></label><br>
            <label for="idttd">ss</label>
            </div>
        </div>
    </div>
</body>
</html>