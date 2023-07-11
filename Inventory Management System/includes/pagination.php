<!DOCTYPE html>
<html>
<head>
	<title>PHP Pagination Tutorial</title>
	<style type="text/css">
		.pagination{
			list-style: none;
		}
		.pagination li{
			float: left;
			margin: 5px;
		}
		.pagination li a{
			text-decoration: none;
		}
		.paragraph{
			width: 960px;
			height: auto;
			overflow: hidden;
			background: #eee;
			margin: 0 auto;
			font-size: 20px;
			font-family: arial;
		}
		.pages{
			font-size: 20px;
			margin: 0 auto;
			width: 500px;
			overflow: hidden;
			margin: 0 auto;

		}
	</style>
</head>
<body>

	<?php


$con = mysqli_connect("localhost","root","","test");

function pagination($con,$table,$pno,$n){
	$query = $con->query("SELECT COUNT(*) as rows FROM ".$table);
	$row = mysqli_fetch_assoc($query);
	//$totalRecords = 100000;
	$pageno = $pno;
	$numberOfRecordsPerPage = $n;

	$last = ceil($row["rows"]/$numberOfRecordsPerPage);

	$pagination = "<ul class='pagination'>";

	if ($last != 1) {
		if ($pageno > 1) {
			$previous = "";
			$previous = $pageno - 1;
			$pagination .= "<li class='page-item'><a class='page-link' href='pagination.php?pageno=".$previous."' style='color:#333;'> Previous </a></li>";
		}
		for($i=$pageno - 5;$i< $pageno ;$i++){
			if ($i > 0) {
				$pagination .= "<li class='page-item'><a class='page-link' href='pagination.php?pageno=".$i."'> ".$i." </a></li>";
			}
			
		}
		$pagination .= "<li class='page-item'><a class='page-link' href='pagination.php?pageno=".$pageno."' style='color:#333;'> $pageno </a></li>";
		for ($i=$pageno + 1; $i <= $last; $i++) { 
			$pagination .= "<li class='page-item'><a class='page-link' href='pagination.php?pageno=".$i."'> ".$i." </a></li>";
			if ($i > $pageno + 4) {
				break;
			}
		}
		if ($last > $pageno) {
			$next = $pageno + 1;
			$pagination .= "<li class='page-item'><a class='page-link' href='pagination.php?pageno=".$next."' style='color:#333;'> Next </a></li></ul>";
		}
	}
//LIMIT 0,10
	//LIMIT 20,10
	$limit = "LIMIT ".($pageno - 1) * $numberOfRecordsPerPage.",".$numberOfRecordsPerPage;

	return ["pagination"=>$pagination,"limit"=>$limit];
}

if (isset($_GET["pageno"])) {
	$pageno = $_GET["pageno"];

	$table = "paragraph";

	$array = pagination($con,$table,$pageno,10);

	$sql = "SELECT * FROM ".$table." ".$array["limit"];

	$query = $con->query($sql);

	while ($row = mysqli_fetch_assoc($query)) {
		echo "<div class='paragraph'><b>".$row["pid"]."</b> ".$row["p_description"]."</div>";
	}
	echo "<div class='pages'>".$array["pagination"]."</div>";

}else{
	$pageno = 1;

	$table = "paragraph";

	$array = pagination($con,$table,$pageno,10);

	$sql = "SELECT * FROM ".$table." ".$array["limit"];

	$query = $con->query($sql);

	while ($row = mysqli_fetch_assoc($query)) {
		echo "<div class='paragraph'><b>".$row["pid"]."</b> ".$row["p_description"]."</div>";
	}
	echo "<div class='pages'>".$array["pagination"]."</div>";
}


?>

</body>
</html>

