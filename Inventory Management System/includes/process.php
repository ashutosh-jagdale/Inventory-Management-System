<?php
include_once("../database/constants.php");
include_once("user.php");
include_once("DBoperation.php");
include_once("manage.php");
//This is registration page
if(isset($_POST["username"]) AND isset($_POST["email"])){
    $user =new User();
    $result = $user->createUserAccount($_POST["username"],$_POST["email"],$_POST["password1"],$_POST["usertype"]);
    echo $result;
    exit();
}

//This is login page
if(isset($_POST["log_email"]) AND isset($_POST["log_password"])){
    $user =new User();
    $result = $user->userLogin($_POST["log_email"],$_POST["log_password"]);
    echo $result;
    exit();
}
//This is to category part
if(isset($_POST["getCategory"])){
    $obj =new DBoperation();
    $rows1 = $obj->getAllRecord("categories");
    foreach ($rows1 as $row) {
        echo "<option value='".$row["cid"]."'>".$row["category_name"]."</option>";
    }
    exit();
}
//This is to add category
if(isset($_POST["category_name"])){
    $obj1 = new DBoperation();
    $result = $obj1->addCategory($_POST["category_name"]);
    echo $result;
    exit();
}



/****************************THIS IS ADDING THE COMPONENT******************************/
//This is to get components
if(isset($_POST["component_name"]) AND isset($_POST["select_category"])){
    $obj1 = new DBoperation();
    $result = $obj1->addComponent($_POST["select_category"],$_POST["component_name"],$_POST["component_quantity"] );
    echo $result;
    exit();
}
/****************************THIS IS END OF ADD COMPONENT******************************/



/****************************THIS IS ONLY TO MANAGE CATEGORIES******************************/
//This is to manage categories
if(isset($_POST["manageCategory"])){
    $m = new Manage();
    $result = $m->manageRecordWithPagination("categories",$_POST["pageno"]);
    $rows1 = $result["rows1"];
    $pagination = $result["pagination"];
    if(count($rows1)>0){
        $n = (($_POST["pageno"] - 1)* 5) +1;
        foreach ($rows1 as $row) {
            ?>
            <tr>
              <td><?php echo $n;?></td>
              <td><?php echo $row["category_name"]; ?></td>
              <td>
                <a href="#" did="<?php echo $row['cid']; ?>" class="btn btn-danger btn-sm del_cat">Delete</a>
                <a href="#" eid="<?php echo $row['cid']; ?>" class = "btn btn-info btn-sm edit_cat" data-toggle="modal" data-target="#form_category">Edit</a>
              </td>
              <td>
                <a href="#" class = "btn btn-success btn-sm">Available</a>
              </td>
            </tr>
            <?php
            $n++;
        }
        ?>
            <tr>
                <td colspan= "5"><?php echo $pagination; ?>                
                </td>
            </tr>
        <?php
        
        exit();
    } 
}


/***************************This is to delete the category******************************/
if(isset($_POST["deleteCategory"])){
    $m = new Manage();
    $result = $m->deleteRecord("categories","cid",$_POST["id"]);
    echo json_encode($result);
  
    exit();
}

/*************************************update record ***********************************/

//This  is for show by default name  when user click to edit 
if(isset($_POST["updateCategory"])){
    $m = new Manage();
    $result = $m->getSingleRecord("categories","cid",$_POST["id"]);
    echo json_encode($result);
    exit();
}

// this is to Update record
if(isset($_POST["update_category"])){
    $m = new Manage();
    $id = $_POST["cid"];
    $name = $_POST["update_category"];
    $result = $m->update_record("categories",["cid"=>$id],["category_name"=>$name,"status"=>1]);
    echo $result;
    exit();
}




/****************************THIS IS END OF MANAGE CATEGORIES******************************/


/****************************THIS IS TO VIEW INVENTORY******************************/
//This is to view the inventory
if(isset($_POST["viewInventory"])){
    $m = new Manage();
    $result = $m->manageRecordWithPagination("components",$_POST["pageno"]);
    $rows1 = $result["rows1"];
    $pagination = $result["pagination"];
    if(count($rows1)>0){
        $n = (($_POST["pageno"] - 1)* 5) +1;
        foreach ($rows1 as $row) {
            ?>
            <tr>
              <td><?php echo $n;?></td>
              <td><?php echo $row["component_name"]; ?></td>
              <td>
              <?php echo $row["category_name"]; ?></td>
              </td>
              <td>
                <?php echo $row["component_quantity"]; ?></td>
            </td>
              <td>
                <?php if($row["component_quantity"]>0)
                {
                ?>    
                <a href="#" class = "btn btn-success btn-sm">Available</a>
                <?php
                }
                else
                {
                ?>   
                <a href="#" class = "btn btn-danger btn-sm">NotAvailable</a>
                <?php
                }
                ?>
              </td>
            </tr>
            <?php
            $n++;
        }
        ?>
            <tr><td colspan= "5"><?php echo $pagination; ?></td></tr>
        <?php
        
        exit();
    } 
}
/****************************THIS IS END OF VIEW INVENTORY******************************/



/****************************THIS IS ONLY TO MANAGE COMPONENTS******************************/
//This is for components
if(isset($_POST["manageComponent"])){
    $m = new Manage();
    $result = $m->manageRecordWithPagination("components",$_POST["pageno"]);
    $rows1 = $result["rows1"];
    $pagination = $result["pagination"];
    if(count($rows1)>0){
        $n = (($_POST["pageno"] - 1)* 5) +1;
        foreach ($rows1 as $row) {
            ?>
            <tr>
              <td><?php echo $n;?></td>
              <td><?php echo $row["component_name"]; ?></td>
              <td>
              <?php echo $row["category_name"]; ?></td>
              </td>
              <td>
                <?php echo $row["component_quantity"]; ?></td>
              </td>
              <td>
                <a href="#" did="<?php echo $row['coid']; ?>" class="btn btn-danger btn-sm del_component">Delete</a>
                <a href="#" eid="<?php echo $row['coid']; ?>" class = "btn btn-info btn-sm edit_component" data-toggle="modal" data-target="#form_components">Edit</a>
              </td>
              <td>
                <a href="#" class = "btn btn-success btn-sm">Available</a>
              </td>
            </tr>
            <?php
            $n++;
        }
        ?>
            <tr><td colspan= "5"><?php echo $pagination; ?></td></tr>
        <?php
        
        exit();
    } 
}

/*************************This is to delete the component*************************/
if(isset($_POST["deleteComponent"])){
    $m = new Manage();
    $result = $m->deleteRecord("components","coid",$_POST["id"]);
    echo $result;
    exit();
}

/*************************This is to update the components***********************/
if(isset($_POST["updateComponent"])){
    $m = new Manage();
    $result = $m->getSingleRecord("components","coid",$_POST["id"]);
    echo json_encode($result);
    exit();
}


if(isset($_POST["update_component"])){
    $m = new Manage();
    $id = $_POST["coid"];
    $name = $_POST["update_component"];
    $category = $_POST["select_category"];
    $quantity = $_POST["component_quantity"];
    $result = $m->update_record("components",["coid"=>$id],["cid"=>$category,"component_name"=>$name,"component_quantity"=>$quantity]);
    echo $result;
    exit();
}


/****************************THIS IS END OF MANAGE COMPONENTS******************************/
/****************************THIS IS TO USE COMPONENTS******************************/
if(isset($_POST["useComponent"])){
    $obj = new DBoperation;
    //$obj2 = new Manage;
    $rows1 = $obj->getAllRecord("components");
    //$result = $obj2->getSingleRecord("categories","cid",$_POST["id"]);
    ?>
    <tr>
        <td><b class="number">1</b></td>
        <td>
            <select name="coid[]" class="form-control form-control-sm coid" id="component_name" name="component_name" required  >
                <option value="">Choose Component</option>
                <?php
                    foreach ($rows1 as $row) {
                        ?>
                        <option value ="<?php echo $row['coid']; ?>">
                            <?php echo $row['component_name']; ?>
                        </option>
                        <?php
                    }
                ?>
            </select>
        </td>
        <!--<td>
            <input name="category_name[]" readonly type="text" class="form-control form-control-sm category_name">        
        </td>-->
        <td><input name="tqty[]" readonly type="text" class="form-control form-control-sm tqty"></td>   
        <td><input name="qty[]" type="text" class="form-control form-control-sm qty" required></td>
        <td><input name="component_name[]" type="hidden" class="form-control form-control-sm component_name" required></td>
    <?php
    exit();
}
/*************************To get available quantity********************************/
if (isset($_POST["getQty"])) {
    $m = new Manage();
    $result = $m->getSingleRecord("components","coid",$_POST["id"]);
    echo json_encode($result);
    exit();
}
if (isset($_POST["component_name"])){
    $ar_tqty = $_POST["tqty"];
    $ar_qty = $_POST["qty"];
    $ar_component_name = $_POST["component_name"];
    $m = new Manage();
    $result = $m->use_component($ar_tqty,$ar_qty,$ar_component_name);
    echo $result;
    exit();
}
/****************************THIS IS END OF USE COMPONENTS******************************/



//****************** for search  *********************

if(isset($_POST["serach_c"]))
{
    
    //echo("omkar");
    $m = new Manage();
    $result = $m->searchRecordWithPagination("components",$_POST["search"],$_POST["pageno"]);
    $rows1 = $result["rows1"];
    $pagination = $result["pagination"]; 
    


    $n=1;
    if(count($rows1)>0)
    {
       
         foreach ($rows1 as $row) 
         {
            ?>
            <tr>
              <td><?php echo $n;?></td>
              <td><?php echo $row["component_name"]; ?></td>
              <td>
              <?php echo $row["category_name"]; ?></td>
              </td>
              <td>
                <?php echo $row["component_quantity"]; ?></td>
            </td>
              <td>
                <?php if( $row["component_quantity"] >0)
                    {
                ?>

                     <a href="#" class = "btn btn-success btn-sm">Available</a>

                <?php   
                    } 
                    else
                    {
                ?>   
                    <a href="#" class = "btn btn-danger btn-sm">Not Available</a>
                <?php 
                    }
                ?> 
                    

               
              </td>
            </tr>

            <?php
            $n++;
          
        }
    ?>

         <tr><td colspan= "5"><?php echo $pagination; ?></td></tr>
      
        <?php

     }

     else
     {
        ?>
        <h3> No records Found</h3>
        <?php

     }

    exit();


}

//for edit profile***************

//  to write name automatically initially

if(isset($_POST["val"]))
{

    $user =new User();
    $result = $user->userinfo();  //function in user.php  return name and email
    
    $name=$result["username"];
    $email1=$result["email"];
   

?>
     <div class="form-row">
            <div class="form-group col-md-12">
            <label>Change username</label>
            <input type="text" class="form-control" id="username1" name="username2" value="<?php echo $name ?>" placeholder=" username" required>
            <small id="usern_error" class="form-text text-muted"></small>
            </div>
          </div>


          <div class="form-row">
            <div class="form-group col-md-12">
            <label>Change Email</label>
            <input type="text" class="form-control" id="email1" name="email2" value="<?php echo $email1?>"p laceholder="Enter Email-id">
            <small id="e_error" class="form-text text-muted"></small>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>


<?php


    exit();
}


//for update
if($_POST["username2"] and $_POST["email2"])
{
    $user =new User();
    $result = $user->update_info($_POST["username2"],$_POST["email2"]);   //function in user.php  to update name and email
    
    exit();

}

?>