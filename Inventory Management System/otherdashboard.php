<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script type="text/javascript" src="./js/main.js"></script>

<body>

<?php include_once("./templates/otherheader.php"); ?>
  <br> <br>
  <div class="container">
      <div class="row">
          <div class="col-md-4">
            <div class="card mx-auto">
                <img  class="card-img-top mx-auto" style="70%"; src="./images/login_img.png"  alt="...">
                <div class="card-body">
                    <h5 class="card-title">Profile Information</h5>
                    <p class="card-text" style="font-size:1.2rem;"><i class="fa fa-user-circle" aria-hidden="true">&nbsp;</i><strong>Atharva Jadhav</strong></p>
                    <p class="card-text"><i class="fa fa-id-card" aria-hidden="true">&nbsp;</i>Admin</p>                
                    <a href="#" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i>Edit Profile</a>
                </div>
                </div>
          </div>
          <div class="col-md-8 ">
              <div class="jumbotron" style="width:100%;height:100%;text-align:center;">
                <h1 style="margin-bottom:20px;">Welcome Admin</h1>
                <div class="row">
                    <div class="col-md-12" style="margin:10px;">
                    <iframe src="http://free.timeanddate.com/clock/i6xc8a66/n505/fn10/fs26/tce9ecef/pce9ecef/ahl/pd2/tt0/tw0/tm1/ts1/ta1/tb4" frameborder="0" width="157" height="62"></iframe>
                    </div>
                    <div class="col-md-12" style="margin:10px;">
                        <div class="card" style="height:110%;">
                            <div class="card-body" style="text-align:center;">
                                <h5 class="card-title" style="margin-top:20px;">Electronics Inventory</h5>
                                <p class="card-text" style="text-align:left;" >Here you can view the material in the inventory. A way to print the list of available material can be done via this tab.</p>
                                <a href="otherview_inv.php" class="btn btn-primary">View the Inventory</a>
                                <a href="#" class="btn btn-success">Print the list</a>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
          </div>
 </div>

</body>
</html>
