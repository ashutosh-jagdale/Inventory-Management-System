<!--This is authored by Atharva Jadhav (Email- atharvavjadhav21@gmail.com).
Co-authored by Omkar DOngre.
Initial copy : 02/08/19
Last saved Changes : 10/09/19    
Any changes necessary should be done with discussion.
-->
<?php
include_once("./database/constants.php");
if (isset($_SESSION["userid"]))// this prevent user from directly entering in login page without logout from dashboard
{
  header("location:".DOMAIN."/dashboard.php");//dont allow user to go back to to login page from dashboard

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Team Inventory</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" type="text/css" href="./includes/style.css">
    <script type="text/javascript" src="./js/main.js"></script>

<body>
  <!--This is nav bar template-->
  <?php include_once("./templates/header.php"); ?>
  <br> <br>
  <div class="container">
    <?php
      if (isset($_GET["msg"]) AND !empty($_GET["msg"])) {
        ?>
        <!--Here we imported the bootstrap code for alert hence closing php is important-->
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
          <?php echo $_GET["msg"];?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php
      }
    ?>
    <div class="card mx-auto" style="width: 18rem;">
        <img class="card-img-top mx-auto" style="width:70%;" src="./images/login_img4.png" alt="Login Icon">
        <div class="card-body">
          <form id="login_form" onsubmit="return false">
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
             <input type="email" class="form-control" id="log_email" name="log_email" aria-describedby="emailHelp" placeholder="Enter email">
              <small id="e_error" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="log_password" name="log_password" placeholder="Password">
              <small id="lp_error" class="form-text text-muted"></small>
            </div>          
            <button type="submit" class="btn btn-primary"><i class="fa fa-lock">&nbsp;</i>Login</button>
            <span><a href="register.php">Register</a></span>
          </form>
        </div>
        <div class="card-footer">
          <a href="#">Forget Password?</a>
        </div>
      </div>      
 </div>

</body>
</html>
