<?php
$navbar = true;
$title = 'Buy Medicine';

session_start();

require_once "core/init.php";

if(Input::exists("GET"))
{

	$medName = Input::get("medName","GET");
	$db = new DB();
	$db->getAllFrom("*","medicine","WHERE Name = ?",array($medName));

?>
<div class="container">
	<form action="action.php?medName=<?php echo $medName;?>" method="POST">
		  		<h1 style="margin-top: -100px;font-weight: bold" class="text-center" style="font-weight: bold">Buy <?php echo $medName ?></h1>
		  		
		  		<div class="form-group">
		  			<label for="Name">Name</label>
		  			<input type="text" class="form-control" required id= "Name" name="Name" placeholder="Name">
		  		</div>

		  		<div class="form-group">
		  			<label for="Address">Address</label>
		  			<input type="text" class="form-control" required id= "Address" name="Address" placeholder="Address">
		  		</div>
		  		
		  		<div class="form-group">
		  			<label for="Phone">Phone No</label>
		  			<input type="number" class="form-control phone-num" required id= "Phone" name="PhoneNo" placeholder="Phone Number">
		  		</div>

		  		<div class="form-group">
		  			<label for="Quantity">Quantity</label>
		  			<input type="number" required min="1" max="<?php echo $db->getFirstResult()['Quantity']?>" class="form-control" id= "Quantity" name="Quantity" placeholder="Quantity">
		  		</div>
		
		  		
		
		  		<input type="submit" class="btn btn-success pull-right" value="Buy">	
		  		<a class="btn btn-default pull-left" href="index.php">Cancle</a>

		  	</form>
</div>

<?php
}
else
{
	echo "<div class='alert alert-danger'>You are not allowed to be here !</div>";
}
require_once $tempRoute . "footer.php";