<?php
class User{
    private $con;
    function __construct(){
        
        include_once("../database/db.php");
        $db = new Database();
        $this ->con = $db->connect();
        
    }
    //to check registration status of user
    private function emailExists($email){
        $pre_stmt = $this ->con->prepare("SELECT id FROM user WHERE email = ?");
        $pre_stmt->bind_param("s",$email);
        $pre_stmt->execute() or die($this ->con->error);
        $result = $pre_stmt->get_result();
        if($result->num_rows > 0){
            return 1;
        }
        else{
            return 0;
        }
    }
    public function createUserAccount($username,$email,$password,$usertype){
        //Protecting app from sql attack use prepare stat...
        if($this ->emailExists($email)){
            return "EMAIL_ALREADY_EXISTS";
        }
        else{
            $pass_hash = password_hash($password,PASSWORD_BCRYPT,["cost"=>8]);
            $date = date("Y-m-d");
            $notes = "";
            $pre_stmt = $this->con->prepare("INSERT INTO `user`( `username`, `email`, `password`, `usertype`, `registration_date`, `notes`) 
            VALUES (?,?,?,?,?,?)");
            $pre_stmt->bind_param("ssssss",$username,$email,$pass_hash,$usertype,$date,$notes);
            $result = $pre_stmt->execute() or die($this->con->error);
            if($result){
                return $this->con->insert_id;
            }
            else{
                return "SOME_ERROR";
            }   
        }
        $pre_stmt =$this ->con->prepare(""); 
    }
    public function userLogin($email,$password){
        $pre_stmt = $this->con->prepare("SELECT id,username,password,usertype FROM user WHERE email = ?");
        $pre_stmt->bind_param("s",$email);
        $pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt -> get_result();

        if($result->num_rows < 1){
            return "NOT_REGISTERED";
        }
        else{
            $row = $result->fetch_assoc();
            if(password_verify($password,$row["password"])){
                $_SESSION["userid"] = $row["id"];
                $_SESSION["username"] = $row["username"]; 
                $_SESSION["autof"] = 1; 
                if($row["usertype"]=="Admin"){
                    return 1;
                }
                elseif ($row["usertype"]=="Other") {
                    return 2;
                }
                   
            }
            else{
                return "PASSWORD_NOT_MATCHED";
            }
        }
    }

     //to show name by default in edit profile
      public function userinfo()
        {
            $pre_stmt = $this->con->prepare("SELECT username,email FROM user WHERE id = ?");
            $pre_stmt->bind_param("i", $_SESSION["userid"]);
            $pre_stmt->execute() or die($this->con->error);
            $result = $pre_stmt -> get_result();  //rertutn object 
            $row = $result->fetch_assoc();   //return array of data 
            return $row;
   
            
        }

        //to edit profile
        public function update_info($name1,$email1)
        {
            $pre_stmt = $this->con->prepare("UPDATE user SET username=?,email=? WHERE  id=?");
            $pre_stmt->bind_param("ssi", $name1,$email1,$_SESSION["userid"]);
            $pre_stmt->execute() or die($this->con->error);
            $result = $pre_stmt -> get_result();  //rertutn object 
           // $row = $result->fetch_assoc();   //return array of data 
        //return $row;
     
        }





}
//$user = new User();
//echo $user->createUserAccount("Omkar","omkar@gmail.com","12345","Admin");
//echo $user->userLogin("omkar@gmail.com","12345");
//echo $_SESSION["username"];
//echo $user->createUserAccount("lol","aaa@gmail.com","12345","Admin");
?>