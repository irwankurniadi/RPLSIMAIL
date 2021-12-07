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
    .input:focus { 
        outline: none !important;
        border-color: #71b5ce;
        box-shadow: 0 0 12px #71b5ce;
    }
}
</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail - In | <?php echo strtoupper($_SESSION['role']) ?></title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
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
                        <a href="/mailin" class="active">
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
        Mail - In / <?php echo strtoupper($_SESSION['role']) . " " . $_SESSION['id'] ?></p>
        <div class="ml-2 mr-2">
            <p style="font-size:20px;font-family:michroma;font-weight: bold;">Mail - In</p>
            <table class="table table-bordered text-center">
                <thead class="thead-dark">
                    <tr>
                        <th style="width:130px">Applicant ID</th>
                        <th>Addressed to</th>
                        <th>Date</th>
                        <th>Event</th>
                        <th>Status</th>
                        <th style="width:150px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sp as $s)
                    <tr>
                        <td>{{ $s->id_user }}</td>
                        <td>{{ $s->n_mitra }} {{ $s->al_mitra }}</td>
                        <td><?php $tgl = date_create($s->tgl);
                                echo date_format( $tgl, 'd/M/Y') ?></td>
                        <td>{{ $s->hal }}</td>
                        <td><a type="button" class="btn 
                            <?php 
                            if($s->status=="Done"){
                                echo "btn-primary text-white";
                            }else if($s->status=="Accepted"){
                                echo "btn-success text-white";
                            }else if($s->status=="Declined"){
                                echo "btn-danger text-white";
                            }else if($s->status=="On Process"){
                                echo "btn-warning";
                            }
                            ?> btn-sm" style="border-radius:25px"><?php echo $s->status ?></td>
                        <td>
                            <a href="/review?type=<?php echo md5('sp')?>&id={{ $s->id_surat }}" class="btn btn-sm btn-warning"><i class="fas fa-eye"></i></a>
                            <a href="/accept?type=<?php echo md5('sp')?>&id={{ $s->id_surat }}" class="btn btn-sm btn-success ml-2 mr-2" title="Accept"><i class="fas fa-check-square"></i></a>
                            <a href="/decline?type=<?php echo md5('sp')?>&id={{ $s->id_surat }}" class="btn btn-sm btn-danger" title="Decline"><i class="fas fa-times"></i></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @foreach ($ba as $b)
                    <tr>
                        <td>{{ $b->id_user }}</td>
                        <td>{{ $b->nama_ttd_1 }} & {{ $b->nama_ttd_2 }}</td>
                        <td><?php $tglba = date_create($b->tgl);
                                echo date_format( $tglba , 'd M Y') ?></td>
                        <td>{{ $b->nama_acara }}</td>
                        <td><a type="button" class="btn 
                            <?php 
                            if($b->status=="Done"){
                                echo "btn-primary text-white";
                            }else if($b->status=="Accepted"){
                                echo "btn-success text-white";
                            }else if($b->status=="Declined"){
                                echo "btn-danger text-white";
                            }else if($b->status=="On Process"){
                                echo "btn-warning";
                            }
                            ?> btn-sm" style="border-radius:25px"><?php echo $b->status ?></td>
                        <td>
                            <a href="/review?type=<?php echo md5('ba')?>&id={{ $b->id_surat }}" class="btn btn-sm btn-warning"><i class="fas fa-eye"></i></a>
                            <a href="/accept?type=<?php echo md5('ba')?>&id={{ $b->id_surat }}" class="btn btn-sm btn-success ml-2 mr-2" title="Accept"><i class="fas fa-check-square"></i></a>
                            <a href="/decline?type=<?php echo md5('ba')?>&id={{ $b->id_surat }}" class="btn btn-sm btn-danger" title="Decline"><i class="fas fa-times"></i></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @foreach ($df as $d)
                    <tr>
                        <td>{{ $d->id_user }}</td>
                        <td>{{ $d->nama_ttd }}</td>
                        <td><?php $tgldf = date_create($d->tgl);
                                echo date_format( $tgldf , 'd M Y') ?></td>
                        <td>{{ $d->nama_acara }}</td>
                        <td><a type="button" class="btn 
                            <?php 
                            if($d->status=="Done"){
                                echo "btn-primary text-white";
                            }else if($d->status=="Accepted"){
                                echo "btn-success text-white";
                            }else if($d->status=="Declined"){
                                echo "btn-danger text-white";
                            }else if($d->status=="On Process"){
                                echo "btn-warning";
                            }
                            ?> btn-sm" style="border-radius:25px"><?php echo $d->status ?></td>
                        <td>
                            <a href="/review?type=<?php echo md5('dft')?>&id={{ $d->id_surat }}" class="btn btn-sm btn-warning"><i class="fas fa-eye"></i></a>
                            <a href="/accept?type=<?php echo md5('dft')?>&id={{ $d->id_surat }}" class="btn btn-sm btn-success ml-2 mr-2" title="Accept"><i class="fas fa-check-square"></i></a>
                            <a href="/decline?type=<?php echo md5('dft')?>&id={{ $d->id_surat }}" class="btn btn-sm btn-danger" title="Decline"><i class="fas fa-times"></i></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @foreach ($sk as $k)
                    <tr>
                        <td>{{ $k->pemohon }}</td>
                        <td>{{ $k->nama_ttd }}</td>
                        <td><?php $tglk = date_create($k->tgl_mulai);
                                echo date_format( $tglk , 'd M Y') ?></td>
                        <td>{{ $k->acara }}</td>
                        <td><a type="button" class="btn 
                            <?php 
                            if($k->status=="Done"){
                                echo "btn-primary text-white";
                            }else if($k->status=="Accepted"){
                                echo "btn-success text-white";
                            }else if($k->status=="Declined"){
                                echo "btn-danger text-white";
                            }else if($k->status=="On Process"){
                                echo "btn-warning";
                            }
                            ?> btn-sm" style="border-radius:25px"><?php echo $k->status ?></td>
                        <td>
                            <a href="/review?type=<?php echo md5('st')?>&id={{ $k->id_surat }}" class="btn btn-sm btn-warning"><i class="fas fa-eye"></i></a>
                            <a href="/accept?type=<?php echo md5('st')?>&id={{ $k->id_surat }}" class="btn btn-sm btn-success ml-2 mr-2" title="Accept"><i class="fas fa-check-square"></i></a>
                            <button type="button" class="btn btn-danger btn-sm" title="Decline"data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-times"></i>
                            </button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Decline Mail</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="/decline?type=<?php echo md5('st')?>&id={{ $k->id_surat }}">
                                    @csrf
                                    <div class="form-group">
                                        <textarea class="input" name="dc" rows="5" cols="60" wrap="soft" style="overflow:hidden; resize:none; border-radius:5px" placeholder="  Enter the reason for decline this mail"></textarea>
                                    </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-danger btn-sm" value="Submit">
                                </div>
                                </div>
                            </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
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