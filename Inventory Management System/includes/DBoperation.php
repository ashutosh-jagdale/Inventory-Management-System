<?php
    class DBoperation{
        private $con;
        function __construct()
        {
            include_once("../database/db.php");
            $db = new Database();
            $this->con = $db->connect();
        }
        public function addCategory($cat){
            $pre_stmt = $this->con->prepare("INSERT INTO `categories`( `category_name`, `status`) 
            VALUES (?,?)");
            $status = 1;
            $pre_stmt->bind_param("si",$cat,$status); //category name-> string and status->0/1
            $result = $pre_stmt->execute() or die($this->con->error);
            if($result){
                return "CATEGORY_ADDED";
            }
            else {
                return 0;
            }
            //$pre_stmt->close();
        }
        public function getAllRecord($table){
            $pre_stmt = $this->con->prepare("SELECT * FROM ".$table); //Here space after the query is necessary else the stat dies...
            $pre_stmt->execute() or die($this->con->error);
            $result = $pre_stmt->get_result();
            $rows = array();
            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                    //$pre_stmt->close();
                }
                return $rows;
            }
            return "NO_DATA";
        }
        public function addComponent($cid,$component_name,$component_quantity){
            $pre_stmt = $this->con->prepare("INSERT INTO `components`(`cid`, `component_name`, `component_quantity`, `component_status`) 
            VALUES (?,?,?,?)");
            $status = 1;
            $pre_stmt->bind_param("isii",$cid,$component_name,$component_quantity,$status); //category name-> string and status->0/1
            $result = $pre_stmt->execute() or die($this->con->error);
            if($result){
                return "COMPONENT_ADDED";
            }
            else {
                return 0;
            }
            //$pre_stmt->close();
        }
    }
    //$opr = new DBoperation();
    //echo "<pre>";
    //echo $opr->addComponent("2","pultra","5");  
    //print_r($opr->getAllRecord("categories"));
?>