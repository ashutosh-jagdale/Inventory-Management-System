<?php

include_once("./database/constants.php"); // to start session once again . Session variable are global so value remain in it permananently 
if(!isset($_SESSION["userid"]))  //this prevent user from directly entering in dashboard without login this block wont excute once login is done 
  {
    header("location:".DOMAIN."/"); 

  }
?>





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

  <?php include_once("./templates/header.php"); ?>
  <br> <br>
  <div class="container">
    <?php
            if (isset($_GET["msg"]) AND !empty($_GET["msg"])) {
                ?>
                <!--Here we imported the bootstrap code for alert hence closing php is important-->
                <div class="alert alert-primary alert-dismissible fade show col-md-6 mx-auto" style="text-align:center;" role="alert">
                <?php echo $_GET["msg"];?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <?php
            }
    ?>




      <div class="row">
          <div class="col-md-4">
            <div class="card mx-auto">
                <img  class="card-img-top mx-auto" style="70%"; src="./images/login_img.png"  alt="...">
                <div class="card-body">

                    <h5 class="card-title">Profile Information</h5>
                  
                    <p class="card-text" style="font-size:1.2rem;"><i class="fa fa-user-circle" aria-hidden="true">&nbsp;</i><strong>
                        <?php 
                        include_once("./database/constants.php");
                        include_once("./return_info.php"); 

                        //  include_once("./includes/constants.php"); 


                        $user = new info();
                        $name=$user->return_name($_SESSION["userid"]);
                        
                        echo $name;

                        ?></strong></p>


              
                    <p class="card-text"><i class="fa fa-id-card" aria-hidden="true">&nbsp;</i>Admin</p>                
                    <a href="#"  id="edit" data-toggle="modal" data-target="#form_editp" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i>Edit Profile</a>

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
                            <div class="card-body" style="text-align:center;margin:20px;">
                                <h5 class="card-title" style="margin-top:20px;">Electronics Inventory</h5>
                                <p class="card-text" style="text-align:left;" >Here you can view the material in the inventory. A way to print the list of available material can be done via this tab.</p>
                                <a href="view_inv.php" class="btn btn-primary">View the Inventory</a>
                                <a href="use_component.php" class="btn btn-info">Use component</a>
                                <a href="includes/generate_pdf.php" class="btn btn-success">Print the list</a>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
          </div>
          <div class="container" style="margin-top:20px;">
          
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body" style="text-align:center;">
                            <h5 class="card-title" style="margin-top:20px;">Categories</h5>
                            <p class="card-text">Manage different categories.</p>
                            <br>
                            <a href="#" data-toggle="modal" data-target="#form_category" class="btn btn-primary">Add</a>
                            <a href="manage_categories.php" class="btn btn-success">Manage</a>
                        </div>
                    </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body" style="text-align:center;">
                            <h5 class="card-title" style="margin-top:20px;">Components</h5>
                            <p class="card-text">Manage various components in the inventory.</p>
                            <br>
                            <a href="#" data-toggle="modal" data-target="#form_components" class="btn btn-primary">Add</a>
                            <a href="manage_components.php" class="btn btn-success">Manage</a>
                    </div>
                </div>
            </div>
            
          </div>
          <br><br>
      </div>
 </div>
<?php   include_once("./templates/category.php");?>
<?php   include_once("./templates/components.php");?>
<?php   include_once("./templates/edit_profile.php");?>
</body>
</html>
