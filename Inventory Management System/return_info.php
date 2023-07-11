<?php
class info{
    private $con;
    function __construct()
    {
        
        include_once("./database/db.php");
        $db = new Database();
        $this ->con = $db->connect();
        
    }
  
     public function return_name($id)
     {
        $pre_stmt = $this->con->prepare("SELECT username FROM user WHERE id = ?");
        $pre_stmt->bind_param("i",$id);
        $pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt -> get_result();  //rertutn object 
        $row = $result->fetch_assoc();   //return array of data 
        return $row["username"];
   
            
        }










}
//$user = new User();
//echo $user->return_name(1);
//echo $user->userLogin("omkar@gmail.com","12345");
//echo $_SESSION["username"];
//echo $user->createUserAccount("lol","aaa@gmail.com","12345","Admin");
?>