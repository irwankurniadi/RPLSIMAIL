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
        padding-left: 44px;
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
    <title>Review Mail | <?php echo strtoupper($_SESSION['role']) ?></title>
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
                <li class="nav-item">
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
                    <button class="dropdown-btn ml-3">
                        <i class="fas fa-paper-plane mr-2"></i>
                        <caption>Create</caption>
                        <i class="fa fa-caret-left rotate"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="/create?type=<?php echo md5("sp") ?>" class="ml-5">
                            <caption>Personal Mail</caption>
                        </a>
                        <a href="/create?type=<?php echo md5("sk") ?>" class="ml-5">
                            <caption>Activity Mail</caption>
                        </a>
                        <a href="/create?type=<?php echo md5("dft") ?>" class="ml-5">
                            <caption>Attendance Mail</caption>
                        </a>
                        </a>
                        <a href="/create?type=<?php echo md5("st") ?>" class="ml-5">
                            <caption>Assignment Mail</caption>
                        </a>
                        <a href="/create?type=<?php echo md5("ba") ?>" class="ml-5">
                            <caption>News Mail</caption>
                        </a>
                    </div>
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
            if($rev=="s_person"){
            ?>
                @foreach ($cont as $c)
                <?php 
                $nos = $c->no_surat;
                $ids = $c->id_user;
                $tgl = $c->tgl;
                $ev = $c->hal;  
                $nm = $c->n_mitra;
                $am = $c->al_mitra;
                $ntd = $c->nama_ttd;
                $stat = $c->status;
                $al = $c->alasan;
                ?>
                @endforeach
                <table class="table table-sm" style="font-family:michroma">
                <tr>
                    <td width="140px">No.</td>
                    <td>: 
                        <?php if(!empty($nos)){
                            echo $nos."A/FTI/2021";
                        } else {
                            if($stat!="Declined"){
                                echo "Mail has not been checked by Admin";
                            }else {
                                echo "Your Mail was Declined by Admin";
                            }
                        }
                        if($stat=="On Process"){
                            $txt = "text-warning";
                        }else if($stat=="Accepted"){
                            $txt = "text-success";
                        }else if($stat=="Declined"){
                            $txt = "text-danger";
                        }
                        ?></td>
                    <td align="right">Status : <label class="<?php echo $txt ?>"><?php echo $stat ?></label></td>
                </tr>
                    <tr>
                        <td>Applicant ID</td>
                        <td>: <?php echo $ids ?></td>
                        <td></td>
                    </tr>
                <tr>
                    <td>Mail Type</td>
                    <td>: Personal Mail</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>: <?php $tg = date_create($tgl); echo date_format($tg, 'd F Y'); ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Event</td>
                    <td>: <?php echo $ev ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Addressed to</td>
                    <td>: <?php echo $nm." ".$am ?></td>
                    <td></td>
                </tr>
                <?php if(!empty($ntd)){?>
                        <tr>
                            <td>Signer</td>
                            <td>: <?php echo $ntd ?></td>
                            <td></td>
                        </tr>
                <?php }
                    if($stat=="Declined"){?>
                        <tr>
                            <td>Decline Statement</td>
                            <td>: <?php echo $al ?></td>
                            <td></td>
                        </tr>
                <?php
                    }
                } else if($rev=="dft_hadir"){
                ?>
                @foreach ($cont as $c)
                <?php 
                $nos = $c->no_surat;
                $ids = $c->id_user;
                $tgl = $c->tgl;
                $ev = $c->nama_acara;
                $time = $c->jam;
                $lok = $c->tempat;
                $pem = $c->pembicara;
                $ntd = $c->nama_ttd;
                $stat = $c->status;
                $al = $c->alasan;
                ?>
                @endforeach
                <table class="table table-sm" style="font-family:michroma">
                <tr>
                    <td width="140px">No.</td>
                    <td>: 
                        <?php if(!empty($nos)){
                            echo $nos."/C/FTI/2021";
                        } else {
                            if($stat!="Declined"){
                                echo "Mail has not been checked by Admin";
                            }else {
                                echo "Your Mail was Declined by Admin";
                            }
                        }
                        if($stat=="On Process"){
                            $txt = "text-warning";
                        }else if($stat=="Accepted"){
                            $txt = "text-success";
                        }else if($stat=="Declined"){
                            $txt = "text-danger";
                        }
                        ?></td>
                    <td align="right">Status : <label class="<?php echo $txt ?>"><?php echo $stat ?></label></td>
                </tr>
                    <tr>
                        <td>Applicant ID</td>
                        <td>: <?php echo $ids ?></td>
                        <td></td>
                    </tr>
                <tr>
                    <td>Mail Type</td>
                    <td>: Attendance Mail</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Event</td>
                    <td>: <?php echo $ev ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>: <?php $tg = date_create($tgl); echo date_format($tg, 'd F Y'); ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Time</td>
                    <td>: <?php echo $time." WIB"?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Guest</td>
                    <td>: <?php echo $pem ?></td>
                    <td></td>
                </tr>
            <?php if(!empty($ntd)){?>
                <tr>
                    <td>Signer</td>
                    <td>: <?php echo $ntd ?></td>
                    <td></td>
                </tr>
            <?php 
                }
            if($stat=="Declined"){?>
                <tr>
                    <td>Decline Statement</td>
                    <td>: <?php echo $al ?></td>
                    <td></td>
                </tr>
            <?php
                }
            } else if($rev=="s_ket"){
            ?>
                @foreach ($cont as $c)
                <?php 
                $nos = $c->no_surat;
                $ids = $c->id_user;
                $tgl = $c->tgl;
                $sem = $c->semester;
                $pro = $c->prodi;
                $fak = $c->fakult;
                $ntd = $c->nama_ttd;
                $stat = $c->status;
                $al = $c->alasan;
                ?>
                @endforeach
                <table class="table table-sm" style="font-family:michroma">
                <tr>
                    <td width="140px">No.</td>
                    <td>: 
                        <?php if(!empty($nos)){
                            echo $nos."/B/FTI/2021";
                        } else {
                            if($stat!="Declined"){
                                echo "Mail has not been checked by Admin";
                            }else {
                                echo "Your Mail was Declined by Admin";
                            }
                        }
                        if($stat=="On Process"){
                            $txt = "text-warning";
                        }else if($stat=="Accepted"){
                            $txt = "text-success";
                        }else if($stat=="Declined"){
                            $txt = "text-danger";
                        }
                        ?></td>
                    <td align="right">Status : <label class="<?php echo $txt ?>"><?php echo $stat ?></label></td>
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
                    <td>: <?php $tg = date_create($tgl); echo date_format($tg, 'd F Y'); ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Major</td>
                    <td>: <?php echo $pro ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Faculty</td>
                    <td>: <?php echo $fak ?></td>
                    <td></td>
                </tr>
                <?php if(!empty($ntd)){?>
                    <tr>
                        <td>Signer</td>
                        <td>: <?php echo $ntd ?></td>
                        <td></td>
                    </tr>
                <?php 
                    }
                    if($stat=="Declined"){?>
                        <tr>
                            <td>Decline Statement</td>
                            <td>: <?php echo $al ?></td>
                            <td></td>
                        </tr>
                <?php
                    }
                } else if($rev=="b_acara"){
                ?>
                    @foreach ($cont as $c)
                    <?php 
                    $nos = $c->no_surat;
                    $ids = $c->id_user;
                    $tgl = $c->tgl;
                    $tem = $c->tema;
                    $na = $c->nama_acara;
                    $lok = $c->tempat;
                    $ket = $c->keterangan;
                    $ntd = $c->nama_ttd;
                    $ntd2 = $c->nama_ttd_2;
                    $stat = $c->status;
                    $al = $c->alasan;
                    ?>
                    @endforeach
                    <table class="table table-sm" style="font-family:michroma">
                    <tr>
                        <td width="140px">No.</td>
                        <td>: 
                            <?php if(!empty($nos)){
                                echo $nos."/E/FTI/2021";
                            } else {
                                if($stat!="Declined"){
                                    echo "Mail has not been checked by Admin";
                                }else {
                                    echo "Your Mail was Declined by Admin";
                                }
                            }
                            if($stat=="On Process"){
                                $txt = "text-warning";
                            }else if($stat=="Accepted"){
                                $txt = "text-success";
                            }else if($stat=="Declined"){
                                $txt = "text-danger";
                            }
                            ?></td>
                        <td align="right">Status : <label class="<?php echo $txt ?>"><?php echo $stat ?></label></td>
                    </tr>
                        <tr>
                            <td>Applicant ID</td>
                            <td>: <?php echo $ids ?></td>
                            <td></td>
                        </tr>
                    <tr>
                        <td>Mail Type</td>
                        <td>: News Mail</td>
                        <td></td>
                    </tr>
                    
                    <tr>
                        <td>Date</td>
                        <td>: <?php $tg = date_create($tgl); echo date_format($tg, 'd F Y'); ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Theme</td>
                        <td>: <?php echo $tem ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Event</td>
                        <td>: <?php echo $na ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Location</td>
                        <td>: <?php echo $lok ?></td>
                        <td></td>
                    </tr>
                    <?php if(!empty($ntd)){?>
                    <tr>
                        <td>Signer</td>
                        <td>: <?php echo $ntd ?></td>
                        <td></td>
                    </tr>
                    <?php if(!empty($ntd2)){?>
                    <tr>
                        <td>Guest Signer</td>
                        <td>: <?php echo $ntd2 ?></td>
                        <td></td>
                    </tr>
                    
                <?php }
                } 
                if($stat=="Declined"){?>
                    <tr>
                        <td>Decline Statement</td>
                        <td>: <?php echo $al ?></td>
                        <td></td>
                    </tr>
                <?php
                    }
                }else if($rev=="sk_dekan"){
                ?>
                    @foreach ($cont as $c)
                    <?php 
                    $nos = $c->no_surat;
                    $ids = $c->id_user;
                    $tglm = $c->tgl_mulai;
                    $tgls = $c->tgl_sls;
                    $ph = $c->pemohon;
                    $ket = $c->keterangan;
                    $lok = $c->tempat;
                    $acr = $c->acara;
                    $ntd = $c->nama_ttd;
                    $stat = $c->status;
                    $al = $c->alasan;
                    ?>
                    @endforeach
                    <table class="table table-sm" style="font-family:michroma">
                    <tr>
                        <td width="140px">No.</td>
                        <td>: 
                            <?php if(!empty($nos)){
                                echo $nos."/D/FTI/2021";
                            } else {
                                if($stat!="Declined"){
                                    echo "Mail has not been checked by Admin";
                                }else {
                                    echo "Your Mail was Declined by Admin";
                                }
                            }
                            if($stat=="On Process"){
                                $txt = "text-warning";
                            }else if($stat=="Accepted"){
                                $txt = "text-success";
                            }else if($stat=="Declined"){
                                $txt = "text-danger";
                            }
                            ?></td>
                        <td align="right">Status : <label class="<?php echo $txt ?>"><?php echo $stat ?></label></td>
                    </tr>
                    <tr>
                        <td>Applicant</td>
                        <td>: <?php echo $ph ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Assign Task to</td>
                        <td>: <?php echo $ids ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Mail Type</td>
                        <td>: Assignment Mail</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td>: <?php 
                        $tg = date_create($tglm); 
                        $tgs = date_create($tgls); 
                        if($tg==$tgs){
                            echo date_format($tg, 'd F Y'); 
                        }else{
                            echo date_format($tg, 'd')."-".date_format($tgs, 'd F Y'); 
                        }
                        
                        ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>: <?php echo $ket ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Event</td>
                        <td>: <?php echo $acr ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Location</td>
                        <td>: <?php echo $lok ?></td>
                        <td></td>
                    </tr>
                    <?php if(!empty($ntd)){?>
                        <tr>
                            <td>Signer</td>
                            <td>: <?php echo $ntd ?></td>
                            <td></td>
                        </tr>
                    <?php 
                        } 
                    if($stat=="Declined"){?>
                        <tr>
                            <td>Decline Statement</td>
                            <td>: <?php echo $al ?></td>
                            <td></td>
                        </tr>
                    <?php }
                    }
                    ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <div class="mr-2" style="float:right">
                        <a href="javascript:history.go(-1)"  class="btn btn-sm btn-dark">BACK</a>
                        <?php if($stat=="On Process"){ ?>
                            <button type="button" class="btn btn-success btn-sm ml-2 mr-2" title="Accept" data-toggle="modal" data-target="#accModal">
                            <i class="fas fa-check-square"></i>
                            </button>
                            <div class="modal fade" id="accModal" tabindex="-1" role="dialog" aria-labelledby="accModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="accModalLabel">Accept Mail</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="#mod">
                                    <form method="POST" action="/accept?type=<?php echo md5("$rev")?>&id={{ $c->id_surat }}">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <div class="select" style="width:100%">
                                            <select class="custom-select selopt" name="ac">
                                                <option selected>Signer?</option>
                                                <option value="984E249 - Budi Susanto, S.Kom., M.T.">984E249 - Budi Susanto, S.Kom., M.T.</option>
                                                <option value="004E289 - Restyandito, S.Kom., MSIS.,Ph.D.">004E289 - Restyandito, S.Kom., MSIS.,Ph.D.</option>
                                            </select>
                                        </div>
                                        <div class="input-group mt-2 mb-3">
                                            <input type="checkbox" aria-label="Checkbox" name="ceksign" id="ceksign" class="ml-2 mt-2 mr-2">
                                            <label for="guesign">Guest Signer</label>
                                            <div class="form-group signer">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-danger btn-sm" value="Submit">
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm" title="Decline"data-toggle="modal" data-target="#dcModal">
                            <i class="fas fa-times"></i>
                            </button>
                            <div class="modal fade" id="dcModal" tabindex="-1" role="dialog" aria-labelledby="dcModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="dcModalLabel">Decline Mail</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="#mod">
                                    <form method="POST" action="/decline?type=<?php echo md5("$rev")?>&id={{ $c->id_surat }}">
                                    @csrf
                                    <div class="form-group">
                                        <textarea class="input" name="dc" rows="5" cols="55" wrap="soft" style="overflow:hidden; resize:none; border-radius:5px" placeholder="  Enter the reason for decline this mail"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-danger btn-sm" value="Submit">
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>
                        <?php } ?>
                        </div>
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

        $('input:checkbox').click(function() {
            if (!$(this).is(':checked')) {
                $(".guestsign").remove();
                $(".selopt").prop('disabled', false);
            } else {
                $(".signer").append('<div class="form-inline guestsign"><input type="text" class="form-control ml-1" name="sn" id="sn" style="width:222px" placeholder="Signer\'s Name"><input type="text" class="form-control ml-2" name="cmp" id="cmp" style="width:230px" placeholder="Company"></div></div>');
                <?php if($rev=="b_acara"){ ?>
                    $(".selopt").prop('disabled', false);
                <?php }else { ?>
                    $(".selopt").prop('disabled', true);
                <?php } ?>
            }
        });
        
    </script>
</body>
</html>