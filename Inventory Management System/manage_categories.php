<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!--<script type="text/javascript" src="./js/main.js"></script>-->
    <script type="text/javascript" src="./js/manage.js"></script>

<body>

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
    <!-- This is end of alert box-->
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Category</th>
              <th>Action</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="get_category">
            <!--
            <tr>
              <td>1</td>
              <td>Sensors</td>
              <td>
                <a href="#" class = "btn btn-danger btn-sm">Delete</a>
                <a href="#" class = "btn btn-info btn-sm">Edit</a>
              </td>
              <td>
                <a href="#" class = "btn btn-success btn-sm">Active</a>
              </td>
            </tr>-->
          </tbody>
      </table>
  </div>
  <?php 
    include_once("./templates/update_categories.php");
  ?>
</body>
</html>
