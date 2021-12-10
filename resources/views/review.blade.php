<!DOCTYPE html>
<html lang="en">
<style>
    .icon {
        height: 50px;
        width: 50px;
    }
    .sidenav {
        height: 100%;
        width: 200px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #1DB9C3;
        overflow-x: hidden;
        padding-top: 3px;
    }

    .sidenav a{
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 16px;
        color: black;
        display: block;
    }
    .sidenav label{
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        text-align: center;
        font-size: 25px;
        color: black;
        display: block;
    }

    .sidenav a:hover {
        text-decoration: none;
        color: white;
    }
    .sidenav .dropdown-btn {
        padding: 6px 16px 6px 16px;
        text-decoration: none;
        display: block;
        border: none;
        background: none;
        width:100%;
        text-align: left;
        font-size: 16px;
        cursor: pointer;
        outline: none;
    }

    .main {
        margin-left: 200px; /* Same as the width of the sidenav */
        overflow-x: hidden;
    }

    i {
        width: 15px;
        height: 15px;
    }

    hr.line {
        width: 160px;
        border: 1px solid black;
    }
    .content {
        padding: 6px 8px 6px 20px;
        background-color: #3EDBF0;
        letter-spacing: 2px;
        font-size: 28px;
        width: 100%;
    }
    .active {
        background-color: #3797A4;
    }
    .dropdown-container {
        display: none;
        background-color: #1DB9C3;
    }
    li {
        font-family: michroma;
        font-size: 20px;
    }
    .fa-caret-left {
        float: right;
        padding-top: 5px;
        padding-right: 55px;
        padding-left: 52px;
        padding-bottom: 25px;
    }
    .rotate {
        -moz-transition: all .1s linear;
        -webkit-transition: all .1s linear;
        transition: all .1s linear;
    }
    .rotate.down {
        -moz-transform:rotate(-90deg);
        -webkit-transform:rotate(-90deg);
        transform:rotate(-90deg);
    }
}
</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | <?php echo strtoupper($_SESSION['role']) ?></title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://use.fontawesome.com/a60ed8fcce.js"></script>
<script src="https://kit.fontawesome.com/a583dc1053.js" crossorigin="anonymous"></script>
<body>
    <div class="sidenav">
        <img class="icon ml-2" src="{{ asset('') }}assets/img/mail.png" alt="SI - MAIL">
        <label class="mr-auto" for="title" style="float:right;font-family:michroma">SI - MAIL</label>
        <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="active">
                    <a href="/dash">
                        <i class="far fa-chart-bar mr-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a>
                        <i class="fas fa-bars mr-1"></i>
                        <caption>Menu</caption>
                        <hr class="line" align="left">
                    </a>
                    <a href="/profile">
                        <i class="fas fa-id-card ml-3 mr-2"></i>
                        <caption>Profile</caption>
                    </a>
                    <a href="/compose">
                        <i class="fas fa-paper-plane ml-3 mr-2"></i>
                        <caption>Compose [+]</caption>
                    </a>
                    <button class="dropdown-btn ml-3">
                        <i class="fas fa-envelope-open-text mr-2"></i>
                        <caption>Mail</caption>
                        <i class="fa fa-caret-left rotate"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="/mailin">
                            <i class="fas fa-envelope ml-4 mr-2"></i>
                            <caption>Mail - In</caption>
                        </a>
                        <a href="/mailout">
                            <i class="fas fa-paper-plane ml-4 mr-2"></i>
                            <caption>Mail - Out</caption>
                        </a>
                    </div>
                    <a href="/archive">
                        <i class="fas fa-mail-bulk ml-3 mr-2"></i>
                        <caption>Archive</caption>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <a href="/logout">
                        <i class="fas fa-sign-out-alt mr-2"></i>Log Out
                    </a>
                </li>
            </ul>
    </div>

    <div class="main">
        <p class="content" style="font-size:28px;font-family:michroma">
        Review Mail / <?php echo strtoupper($_SESSION['role'])." ".$_SESSION['id'] ?></p>
        <div class="ml-2 mr-2">
            <?php 
            if($rev=="s_ket"){
            ?>
                @foreach ($cont as $c)
                <?php 
                $nos = $c->no_surat;
                $ids = $c->id_user;
                $tgl = $c->date;
                $sem = $c->sem;
                $prodi = $c->prodi;
                $fak = $c->fakult;
                $ttd = $c->nama_ttd;
                $stat = $c->status;
                ?>
                @endforeach
                <table class="table table-sm" style="font-family:michroma">
                <tr>
                    <td width="140px">No.</td>
                    <td>: 
                        <?php if(!empty($nos)){
                            echo $nos."/B/FTI/2021";
                        } else {
                            echo "Mail has not been checked by Admin";
                        }
                        ?></td>
                    <td align="right">Status : <label class="text-success"><?php echo $stat ?></label></td>
                </tr>
                    <tr>
                        <td>Applicant ID</td>
                        <td>: <?php echo $ids ?></td>
                        <td></td>
                    </tr>
                <tr>
                    <td>Mail Type</td>
                    <td>: Activity Mail</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>: <?php echo $tgl ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Semester</td>
                    <td>: <?php echo $sem ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Major</td>
                    <td>: <?php echo $prodi ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Faculty</td>
                    <td>: <?php echo $fak ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Signer</td>
                    <td>: <?php echo $ttd ?></td>
                    <td></td>
                </tr>
            <?php 
            }
            ?>
            <?php 
            if($rev=="sk_dekan"){
            ?>
                @foreach ($cont as $c)
                <?php 
                $nos = $c->no_surat;
                $ids = $c->id_user;
                $pem = $c->pemohon;
                $ket = $c->keterangan;
                $ev = $c->acara;
                $tgls = $c->tgl_mulai;
                $tgle = $c->tgl_sls;
                $lok = $c->tempat;
                $ttd = $c->nama_ttd;
                $stat = $c->status;
                ?>
                @endforeach
                <table class="table table-sm" style="font-family:michroma">
                <tr>
                    <td width="140px">No.</td>
                    <td>: 
                        <?php if(!empty($nos)){
                            echo $nos."/C/FTI/2021";
                        } else {
                            echo "Mail has not been checked by Admin";
                        }
                        ?></td>
                    <td align="right">Status : <label class="text-success"><?php echo $stat ?></label></td>
                </tr>
                <tr>
                    <td>Applicant ID</td>
                    <td>: <?php echo $ids ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Requester</td>
                    <td>: <?php echo $pem ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Mail Type</td>
                    <td>: Assigment Mail</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Event</td>
                    <td>: <?php echo $ev ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>: <?php $tglm = date_create($tgls); $tglsl = date_create($tgle); 
                    echo date_format($tglm, 'd')." - ".date_format($tglsl, 'd M Y') ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td>: <?php echo $lok ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Signer</td>
                    <td>: <?php echo $ttd ?></td>
                    <td></td>
                </tr>
            <?php 
            }?>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="javascript:history.go(-1)" style="float:right" class="btn btn-sm btn-dark">BACK</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <script>
        /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
        } else {
        dropdownContent.style.display = "block";
        }
        });
        }

        $(".rotate").click(function () {
            $(this).toggleClass("down");
        })
    </script>
</body>
</html>