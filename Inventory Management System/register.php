<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
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
    <div class="card mx-auto" style="width: 28rem;font-size:1rem;">
        <div class="card-body ">
            <h5 class="card-title" style="text-align:center;font-size:1.3rem;">Register</h5>
                <form id="register_form" onsubmit="return false" autocomplete="off">
                    <div class="form-group">
                        <label for="username">Full Name</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter Name">
                        <small id="u_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="email">Enter E-mail Id</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email"placeholder="Enter valid email id">
                        <small id="e_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="usertype">Usertype</label>
                        <select name = "usertype" class="form-control" id="usertype">
                            <option value="">Choose User type</option>
                            <option value="Admin">Admin</option>
                            <option value="Other">Other</option>
                        </select>    
                    </div>
                    <div class="form-group">
                        <label for="Password1">Enter Password</label>
                        <input type="password" class="form-control" id="Password1" name="password1" placeholder="Password">
                        <small id="p1_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="Password2">Re-enter Password</label>
                        <input type="password" class="form-control" id="Password2" name="password2" placeholder="Re-enter Password">
                        <small id="p2_error" class="form-text text-muted"></small>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="index.php" style="font-size:1.1rem;">&nbsp; Login</a>
                </form>
        </div>
    </div>

 </div>

</body>
</html>