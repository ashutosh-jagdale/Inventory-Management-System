<?php 
     session_start();
     $host="localhost";
     $username="root";
     $pass="";
     $db="project_inv";
      
     $conn=mysqli_connect($host,$username,$pass,$db);
     if(!$conn){
      die("Database connection error");
     }
     include_once("../pdf/fpdf.php");

    class PDF extends FPDF
    {
    function Header()
    { 
        $this->SetFont('Arial','B',24);
        $this->Cell(80);
        $this->Cell(30,10,'Electronics Inventory',0,0,'C');
        $this->Ln(20);
        $this->Ln(20);
    }
    
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    }    
    $display_heading = array('component_name'=>'Component Name', 'component_quantity'=> 'Available Quantity', 'component_status'=> 'Status**');
    
    $result = mysqli_query($conn, "SELECT component_name, component_quantity, component_status FROM components") or die("database error:". mysqli_error($conn));
    $header = mysqli_query($conn, "SHOW columns FROM components WHERE field != 'cid' and field != 'coid'");
    
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->AliasNbPages();
    $pdf->SetFont('Arial','B',16);
    foreach($header as $heading) {
    $pdf->Cell(63,15,$display_heading[$heading['Field']],1,0,'C');
    }
    foreach($result as $row) {
    $pdf->SetFont('Arial','',10);
    $pdf->Ln();
    foreach($row as $column)
    $pdf->Cell(63,10,$column,1,0,'C');
    }
    $pdf->Ln(10);
    $pdf->SetFont('Arial','I',8);
    $pdf->Cell(10,5,'** 1 for Status denotes that the component is available in Inventory , 0 for unavailable. ',0,0,'L');
    $pdf->Ln(90);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(180,5,'Piyush Bobade',0,0,'L');
    $pdf->Cell(10,5,'Akash Bagade',0,0,'R');
    $pdf->Ln(5);
    $pdf->SetFont('Arial','I',10);
    $pdf->Cell(180,5,'ENTC head',0,0,'L');
    $pdf->Cell(10,5,'Team Captain',0,0,'R');
    $pdf->Output();     
?>