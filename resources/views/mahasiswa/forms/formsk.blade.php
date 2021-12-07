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
    <title>Activity Mail | <?php echo strtoupper($_SESSION['role']) ?></title>
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
                        <a href="/create?type=<?php echo md5("sk") ?>" class="ml-5">
                            <caption>Activity Mail</caption>
                        </a>
                        <a href="/create?type=<?php echo md5("st") ?>" class="ml-5">
                            <caption>Assignment Mail</caption>
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
        Activity Mail / <?php echo strtoupper($_SESSION['role'])." ".$_SESSION['id'] ?></p>
        <form class="form ml-2 mr-2" style="font-family:michroma" method="POST" action="insert">
            @csrf
            <input type="hidden" name="dbs" id="dbs" value="s_ket">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" name="tgl" id="tgl">
            </div>
            <div class="form-group">
                <label for="date">Location</label>
                <input type="text" class="form-control" name="lok" id="lok" placeholder="Event Location">
            </div>
            <div class="form-group" id="applicant">
                <label for="date">Applicant ID</label>
                <input type="text" class="form-control mb-1" name="id" id="id" placeholder="Student ID">
            </div>
            <button type="button" class="btn-primary btn-sm mb-2" id="addBtn">Add Applicant</button>
            <div class="form-group">
                <label for="date">Addressed to</label>
                <input type="text" class="form-control" name="tujuan" id="tujuan" placeholder="Recipient's Name">
            </div>
            <div class="form-group">
                <label for="date">Description</label>
                <input type="text" class="form-control" name="desc" id="desc" placeholder="Letter Description">
            </div>
            <div class="form-inline mb-5" style="float:right">
                <input type="submit" class="btn btn-success btn-sm" value="Create">
                <a href="/dash" class="btn btn-danger btn-sm text-white ml-2">Cancel</a>
            </div>
        </form>
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

        // Node.js program to demonstrate the
        // Node.js filehandle.read() Method

        // Denotes total number of rows.
        var rowIdx = 0;

        // jQuery button click event to add a row.
        $('#addBtn').on('click', function () {
            // Adding a row inside the tbody.
            $('#applicant').append(`<input type="text" class="form-control mb-1" name="idplus[]" id="id" placeholder="Student ID">`);
        });
    </script>
</body>
</html>