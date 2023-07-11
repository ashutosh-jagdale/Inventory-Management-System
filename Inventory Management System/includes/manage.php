<?php
    class Manage
    {
        private $con;
        function __construct()
        {
            include_once("../database/db.php");
            $db = new Database();
            $this->con = $db->connect();
        }
        public function manageRecordWithPagination($table,$pno){
             $query1="SELECT * FROM ".$table;
          
            $tcount = $this->con->query($query1) or die($this->con->error);
    
            $tcount=$tcount->num_rows;
            $a = $this->pagination($this->con,$tcount,$pno,5);  //return pagination array
            //$tcount="SELECT COUNT(*) FROM ".$table;
            // print_r($a["limit"]); // return-> limit 0,5 string to add in sql statement make valid sql query
            //5 records in a page

            if($table == "categories")//responsible for showing manage cat
            {
                $sql = "select * from ".$table." ".$a["limit"];
            }
            else if($table == "components") //responsible for showing manage compo
            {
                $sql = "SELECT p.component_name,c.category_name,p.component_quantity,p.component_status,p.coid 
                FROM components p,categories c WHERE p.cid = c.cid ".$a["limit"];
            }
            else
            {
                $sql = "select * from ".$table." ".$a["limit"]; //limiting no of query following  sql syntax of limit
            }
            $result = $this->con->query($sql) or die($this->con->error);
            $rows1 = array();   //stores category name array
            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) 
                {
                    $rows1 [] = $row; //automatically new row get appended in $rows1
                }
            }
            else {
                echo "0 results";
            }
            return ["rows1"=>$rows1,"pagination"=>$a["pagination"]]; //where rows1 is $array  and pagination is string  
           
        }
       private function pagination($con,$tcount,$pno,$n)//connection variable,table name,page number we want directly,no of records in 1 page
        {
           // $query = $con->query("SELECT COUNT(*) as rows1 FROM ".$table);//return object containing information 
            //$row = mysqli_fetch_assoc($query); // return array format eg array( rows=>4)
            $pageno = $pno;
            $numberOfRecordsPerPage = $n;
        
            $last = ceil($tcount/$numberOfRecordsPerPage); //total no of pages
    
            $pagination = "<ul class='pagination'>";
    
            if ($last != 1)  // if no. of pages is 1 so no need to do pagination 
            {
                if ($pageno > 1) {
                    $previous = "";
                    $previous = $pageno - 1;
                     ////this all are bootstrap classes for showing pagination in proper way
                    $pagination .= "<li class='page-item'><a class='page-link' pn='".$previous."' href='#' style='color:#333;'> Previous </a></li></li>";  // display previous field on click takes to previous no. 
                }
                for($i=$pageno - 5;$i< $pageno ;$i++) //for show previous 5 pagefrom current page
                {

                    if ($i > 0)//avoid negative number 
                     {
                        $pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ".$i." </a></li>";    //attributes pn value actual page no. if  user select that agin the function get.. will be called with this pageno 
                    }
                    
                }
                //showing current page
                $pagination .= "<li class='page-item'><a class='page-link' pn='".$pageno."' href='#' style='color:#333;'> $pageno </a></li>";

                for ($i=$pageno + 1; $i <= $last; $i++) //just showing 4 pages from current page no.
                 { 
                    $pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ".$i." </a></li>";
                    if ($i > $pageno + 4) {
                        break;
                    }
                }
                // showing "next" 
                if ($last > $pageno)
                 {
                    $next = $pageno + 1;
                    $pagination .= "<li class='page-item'><a class='page-link' pn='".$next."' href='#' style='color:#333;'> Next </a></li></ul>";
                }
            }
        //LIMIT 0,10
            //LIMIT 20,10
            $limit = "LIMIT ".($pageno - 1) * $numberOfRecordsPerPage.",".$numberOfRecordsPerPage; // showing "next" 
    
            return ["pagination"=>$pagination,"limit"=>$limit]; // both pagination and limit is string not array
        }
        public function deleteRecord($table,$pk,$id){
            if($table == "categories")
            {
                $pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
                $pre_stmt->bind_param("i",$id);
                $result = $pre_stmt->execute() or die($this->con->error);
                
                if($result)
                {
                    
                    $qry="select count($pk) as total from ".$table ;  //correct it later instead * count(*)
                    $pre_stmt = $this->con->query($qry) or die($this->con->error);
                  
                    $values=$pre_stmt->fetch_assoc();
                     $values['total'];
              
                    return ["msg"=>"DELETED","values"=>$values['total'] ];
                }
                return[ "msg"=>"" ,"values"=>[-100]]; 
            }
            else if($table == "components"){
                $pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
                $pre_stmt->bind_param("i",$id);
                $result = $pre_stmt->execute() or die($this->con->error);
                if($result){
                    return "DELETED";
                }
            }
        }
        public function getSingleRecord($table,$pk,$id){
            $pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE ".$pk." =?");
            $pre_stmt->bind_param("i",$id);
            $pre_stmt->execute() or die($this->con->error);
            $result=$pre_stmt->get_result();
            if($result->num_rows == 1){
                $row = $result->fetch_assoc();
            }
            return $row;
        }
        public function update_record($table,$where,$fields){
            $sql = "";
            $condition = "";
            foreach ($where as $key => $value) {
                // id = '5' AND m_name = 'something'
                $condition .= $key . "='" . $value . "' AND ";
            }
            $condition = substr($condition, 0, -5);
            foreach ($fields as $key => $value) {
                //UPDATE table SET m_name = '' , qty = '' WHERE id = '';
                $sql .= $key . "='".$value."', ";
            }
            $sql = substr($sql, 0,-2);
            $sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
            if(mysqli_query($this->con,$sql)){
                return "UPDATED";
            }
        }
        public function use_component($ar_tqty,$ar_qty,$ar_component_name){
            //$ar_tqty = $_POST["tqty"];
            //$ar_qty = $_POST["qty"];
            //$ar_component_name = $_POST["component_name"];
            $i = 0;
            for ($i=0; $i < count($ar_component_name); $i++) { 
                $rem_qty = $ar_tqty[$i] - $ar_qty[$i];
                if ($rem_qty < 0 ) {
                    return "OUT_OF_STOCK";
                }
                else{
                    $sql = "UPDATE components SET component_quantity = '$rem_qty' where component_name = '".$ar_component_name[$i]."'";
                    $this->con->query($sql);
                    
                }
            }
            return "COMPONENT_USED";
        }

        public function searchRecordWithPagination($table,$search,$pno)
        {


           // $a = $this->pagination($this->con,$table,$pno,5);     
            $sql1 = "  SELECT p.component_name,c.category_name,p.component_quantity,p.component_status,p.coid FROM components p,categories c WHERE  p.cid = c.cid and p.component_name LIKE '".$search."%'";//$a["limit"];
            $result = $this->con->query($sql1) or die($this->con->error);   
            //print_r($result->num_rows);
            $tcount = $result->num_rows;
    
           //echo $sql;
            $a = $this->pagination($this->con,$tcount,$pno,5);    
            $sql1 = "  SELECT p.component_name,c.category_name,p.component_quantity,p.component_status,p.coid FROM components p,categories c WHERE  p.cid = c.cid and p.component_name LIKE '".$search."%'".$a["limit"];
            $rows1 = array(); 
             //echo $result->num_rows;
              //stores category name array
            if($result->num_rows >0)
            {
                while ($row = $result->fetch_assoc())
                 {
                    $rows1 [] = $row; //automatically new row get appended in $rows1
                }
            }
            else 
            {
                //echo "0 results";
            }

            return ["rows1"=>$rows1,"pagination"=>$a["pagination"]]; //where rows1 is $array  without pagination  string  
        }
    }
//  $obj = new Manage();
  //echo "<pre>";
  //print_r($obj->manageRecordWithPagination("components",1));  
  //echo $obj->deleteRecord("categories","cid",42);
  //print_r($obj->getSingleRecord("components","coid",28));
  //echo $obj->update_record("categories",["cid"=>28],["category_name"=>"Sensors And Stuff","status"=>1]);
  //echo $obj->update_record("components",["coid"=>28],["cid"=>"29","component_name"=>"Arduino Due","component_quantity"=>10,"component_status"=>1]);
  //print_r($obj->deleteRecord("catagories","cid"136));
//  echo $obj->deleteRecord("categories","cid",135)

?>