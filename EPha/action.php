<?php
$navbar = true;

session_start();

require_once "core/init.php";
?>
<div class="container">

<?php

if(Input::exists("POST"))
{
	$data 	= $_POST;
	$db 	= new DB();
	$med	= new DB();
	$med->getAllFrom("*","medicine","WHERE Name = ?",array(Input::get("medName","GET")));
	
	$data['Name'] 		= filter_var($data['Name'],FILTER_SANITIZE_STRING);
	$data['Address'] 	= filter_var($data['Address'],FILTER_SANITIZE_STRING);
	$data['PhoneNo'] 	= filter_var($data['PhoneNo'],FILTER_SANITIZE_STRING);
	$data['Quantity'] 	= filter_var($data['Quantity'],FILTER_SANITIZE_STRING);
	$data['MedName'] 	= filter_var(Input::get("medName","GET"),FILTER_SANITIZE_STRING);
	$data['TotalPrice'] = $data['Quantity'] * $med->getFirstResult()['SalesPrice'];
	$data['Date']		= date("Y-m-d");

	$quantity = $med->getFirstResult()['Quantity'];
	$new	  = $quantity - $data['Quantity'];
	
	
	if($db->insertIn("customers",$data))
	{
		if($med->updateTable("medicine","WHERE BatchNo = {$med->getFirstResult()['BatchNo']}",array("Quantity" => $new)))
			echo "<div class='alert alert-success'>Your Order Is Taken Please Wait For The Order 15 Minutes</div>";
			Redirect::to("index.php");
	}
	else
	{	
		echo "<div class='alert alert-danger'>Something Wrong Happen,Please Try Again</div>";
		Redirect::to("index.php",2);
	}

}

?>

</div>

<?php

require_once $tempRoute . "footer.php";

?>