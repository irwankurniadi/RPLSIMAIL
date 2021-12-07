<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI - MAIL | Log In</title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<style>
    .card{
        margin: 150px auto;
        width: 400px;
        padding: 10px;
    }
    body {
        background-repeat: no-repeat;
        background-size: cover;
        overflow-y: hidden;
    }
</style>
<body style="background-image: url({{ asset('') }}assets/img/bg-body.png)">
    <div class="card border-dark" style="width: 20rem;">
        <?php
            if(session()->get('error')){?>
                <strong align="center">
                    <label for="alert"  style="color:red">{{session()->get('error') }} !!</label>
                </strong>
            <?php
            }
        ?>
        <div class="card-header bg-dark text-white" style="font-size:25px;font-family:michroma" align="center">SI - MAIL</div>
        <div class="card-body">
            <form method="POST" id="LoginForm" action="/ceklogin">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            Username<br>
            <input type="email" id="email" name="email" style="width:100%;border-radius:9px;border:solid 1px #2E4C6D;box-shadow:2px 3px #888888" placeholder="Masukan Username" required><br>
            Password<br>
            <input type="password" id="pw" name="pw" style="width:100%;border-radius:9px;border:solid 1px #2E4C6D;box-shadow:2px 3px #888888" placeholder="Masukan Password" required><br>
            <input class="btn btn-primary btn-sm text-white mt-2" style="float:right;font-family:michroma" type="submit" value="Log In">      
            </form>
        </div>
        <div class="card-footer bg-light text-muted" align="center" style="font-size:15px;font-family:michroma">
            Correspondence Informatic System | UKDW
        </div>
    </div>
</body>
</html>
