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
        
        <script type="text/javascript" src="./js/use_component.js"></script>

    <body>

    <?php include_once("./templates/header.php"); ?>
    <br> <br>
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="card" style="box-shadow:0 0 25px 0 lightgrey;">
                        <div class="card-header">
                            <h4>Use Component</h4>
                        </div>
                        <div class="card-body">
                            <form id="use_component_form" onsubmit="return false">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Choose the component</h5>
                                        <table align="center" style="width:800px;">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="text-align:center;">Component Name</th>
                                                <!--<th style="text-align:center;">Category Name</th>-->
                                                <th style="text-align:center;">Avaialble Quantity</th>
                                                <th style="text-align:center;">Quantity</th>
                                            </tr>
                                            </thead>
                                            <tbody id="use_component">
                                            <!--<tr>
                                                <td><b id="number">1</b></td>
                                                <td>
                                                    <select name="pid[]" class="form-control form-control-sm" required>
                                                        <option>Washing Machine</option>
                                                    </select>
                                                </td>
                                                <td><input name="tqty[]" readonly type="text" class="form-control form-control-sm"></td>   
                                                <td><input name="qty[]" type="text" class="form-control form-control-sm" required></td>
                                                <td><input name="price[]" type="text" class="form-control form-control-sm" readonly></td>
                                                <td>Rs.1540</td>
                                            </tr>-->
                                            </tbody>
                                        </table> <!--Table Ends-->
                                        <center style="padding:10px;">
                                            <button id="use" style="width:150px;" class="btn btn-success btn-sm">Add component</button>
                                            <button id="remove" style="width:150px;" class="btn btn-danger btn-sm">Remove</button>
                                        </center> 
                                    </div> <!--Crad Body Ends-->
                                </div> <!-- Order List Crad Ends-->
                                <center style="padding:10px;">
                                            <button id="final_use" style="width:150px;" class="btn btn-success">Use</button>
                                </center>        
                            </form>     
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
