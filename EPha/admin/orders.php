<?php


session_start();
$navbar = true;
$title = "Orders";

require_once "core/init.php";

$admin = new Admin();
if(!$admin->IsLoggedIn())
{
	Redirect::to("login.php");
}
else
{
	$db = new DB();
	$action = Input::get("type","GET");

?>
<div class="container">

	<?php
		if($action === "pending")
		{
			$ords = new DB();
			$ords->getAllFrom("*","customers","WHERE Approve = ?",array(0));

			if($ords->getCount() <= 0)
			{
				echo "<div class='alert alert-danger'>There's no Pending Orders!!!</div>";
			}
			else
			{
	?>
				<h1 class="text-center" style="font-weight: bold">Pending Orders</h1>

			  	<div class="box">
			    	<div class="box-body table-responsive no-padding">
			      		<table class="table table-hover">
					        <tbody>
					        	<tr>
						          <th>Customer Name</th>
						          <th>Address</th>
						          <th>Phone Number</th>
						          <th>Required Medicine</th>
						          <th>Quantity Required</th>
						          <th>Date</th>
						          <th>Options</th>
						        </tr>
							<?php
								$x = 1;

								foreach($ords->getResult() as $ord)
								{

							?>
					        	<tr>

						          <td><?php echo $ord['Name'] ?></td>
						          <td><?php echo $ord['Address'] ?></td>
						          <td><?php echo $ord['PhoneNo'] ?></td>
						          <td><?php echo $ord['MedName'] ?></td>
						          <td><?php echo $ord['Quantity'] ?></td>
						          <td><?php echo $ord['Date'] ?></td>

						          <td>
						          	<a href="actions.php?action=approveorder&id=<?php echo $ord['ID']?>" class="btn btn-xs btn-info"><i class="fa fa-check"></i></i></a>
						          </td>
						        </tr>
							<?php
								}
							?>
			      			</tbody>
			      		</table>
			    	</div>
			  	</div>

	<?php
			}
		}
		else if($action === "total")
		{

		  	$ords = new DB();
			$ords->getAllFrom("*","customers","WHERE Approve = ?  AND Date <= ? OR Date >= ? ORDER BY Date ASC",array(1,date('d'),date('d-7')));
			$x = 1;
			if($ords->getCount() <= 0)
			{
				echo "<div class='alert alert-danger'>Empty Orders!!!</div>";
			}
			else
			{
	?>
				<h1 class="text-center" style="font-weight: bold">Total Week Orders</h1>

			  	<div class="box">
			    	<div class="box-body table-responsive no-padding">
			      		<table class="table table-hover">
					        <tbody>
					        	<tr>
					        	  <th>ID</th>
						          <th>Customer Name</th>
						          <th>Address</th>
						          <th>Phone Number</th>
						          <th>Required Medicine</th>
						          <th>Quantity Required</th>
						          <th>Date</th>

						        </tr>
							<?php
								$x = 1;

								foreach($ords->getResult() as $ord)
								{

							?>
					        	<tr>
						          <td><?php echo $x++ ?></td>
						          <td><?php echo $ord['Name'] ?></td>
						          <td><?php echo $ord['Address'] ?></td>
						          <td><?php echo $ord['PhoneNo'] ?></td>
						          <td><?php echo $ord['MedName'] ?></td>
						          <td><?php echo $ord['Quantity'] ?></td>
						          <td><?php echo $ord['Date'] ?></td>


						        </tr>
							<?php
								}
							?>
			      			</tbody>
			      		</table>
			    	</div>
			  	</div>

  	<?php

	  		}

	  	}

	  	else if($action === "dayprofit")
		{

		  	$ords = new DB();
			$ords->getAllFrom("*","customers","WHERE Approve = ? AND Date = ? ORDER BY Date ASC",array(1,date('Y-m-d')));
			$x = 1;
			if($ords->getCount() <= 0)
			{
				echo "<div class='alert alert-danger'>No Day Profit!!!</div>";
			}
			else
			{
	?>
				<h1 class="text-center" style="font-weight: bold">Day Profit</h1>

			  	<div class="box">
			    	<div class="box-body table-responsive no-padding">
			      		<table class="table table-hover">
					        <tbody>
					        	<tr>
					        	  <th>ID</th>
						          <th>Customer Name</th>
						          <th>Required Medicine</th>
						          <th>Quantity Required</th>
						          <th>Payed Price</th>

						        </tr>
							<?php

								foreach($ords->getResult() as $ord)
								{

							?>
					        	<tr>
						          <td><?php echo $x++ ?></td>
						          <td><?php echo $ord['Name'] ?></td>
						          <td><?php echo $ord['MedName'] ?></td>
						          <td><?php echo $ord['Quantity'] ?></td>
						          <td><?php echo $ord['TotalPrice'] ?> L.E</td>

						        </tr>
							<?php
								}
							?>
			      			</tbody>
			      		</table>
			    	</div>
			  	</div>

  	<?php

	  		}
	  	}

	  	else if($action === "weekprofit")
		{

		  	$ords = new DB();
			$ords->getAllFrom("*","customers","WHERE Approve = ? AND Date <= ? OR Date >= ? ORDER BY Date ASC",array(1,date('d'),date('d-7')));
			$x = 1;
			if($ords->getCount() <= 0)
			{
				echo "<div class='alert alert-danger'>Empty Orders!!!</div>";
			}
			else
			{
	?>
				<h1 class="text-center" style="font-weight: bold">Week Profit</h1>

			  	<div class="box">
			    	<div class="box-body table-responsive no-padding">
			      		<table class="table table-hover">
					        <tbody>
					        	<tr>
					        	  <th>ID</th>
						          <th>Customer Name</th>
						          <th>Required Medicine</th>
						          <th>Quantity Required</th>
						          <th>Payed Price</th>
						          <th>Date</th>

						        </tr>
							<?php

								foreach($ords->getResult() as $ord)
								{

							?>
					        	<tr>
						          <td><?php echo $x++ ?></td>
						          <td><?php echo $ord['Name'] ?></td>
						          <td><?php echo $ord['MedName'] ?></td>
						          <td><?php echo $ord['Quantity'] ?></td>
						          <td><?php echo $ord['TotalPrice'] ?> L.E</td>
						          <td><?php echo $ord['Date'] ?></td>
						        </tr>
							<?php
								}
							?>
			      			</tbody>
			      		</table>
			    	</div>
			  	</div>

  	<?php

	  		}
	  	}

	  	else if($action === "totalquentity")
		{

		  	$ords = new DB();
			$ords->getAllFrom("*","medicine ORDER BY Quantity DESC");
			$x = 1;
			if($ords->getCount() <= 0)
			{
				echo "<div class='alert alert-danger'>There is no Medicines To Show</div>";
			}
			else
			{
	?>
				<h1 class="text-center" style="font-weight: bold">Medicine Quentities</h1>

			  	<div class="box">
			    	<div class="box-body table-responsive no-padding">
			      		<table class="table table-hover">
					        <tbody>
					        	<tr>
					        	  <th>ID</th>
						          <th>Name</th>
						          <th>Batch No</th>
						          <th>Category</th>
						          <th>Quantity</th>

						        </tr>
							<?php

								foreach($ords->getResult() as $ord)
								{

							?>
					        	<tr>
						          <td><?php echo $x++ ?></td>
						          <td><?php echo $ord['Name'] ?></td>
						          <td><?php echo $ord['BatchNo'] ?></td>
						          <td><?php echo $ord['CatName'] ?></td>
						          <td><?php echo $ord['Quantity'] ?></td>

						        </tr>
							<?php
								}
							?>
			      			</tbody>
			      		</table>
			    	</div>
			  	</div>

  	<?php

	  		}
	  	}


	  	else if($action === "lowquantity")
		{

		  	$ords = new DB();
			$ords->getAllFrom("*","medicine","WHERE Quantity < ?",array(50));
			$x = 1;
			if($ords->getCount() <= 0)
			{
				echo "<div class='alert alert-danger'>There is no Medicines To Show</div>";
			}
			else
			{
	?>
				<h1 class="text-center" style="font-weight: bold">Medicine Quentities</h1>

			  	<div class="box">
			    	<div class="box-body table-responsive no-padding">
			      		<table class="table table-hover">
					        <tbody>
					        	<tr>
					        	  <th>ID</th>
						          <th>Name</th>
						          <th>Batch No</th>
						          <th>Category</th>
						          <th>Quantity</th>

						        </tr>
							<?php

								foreach($ords->getResult() as $ord)
								{

							?>
					        	<tr>
						          <td><?php echo $x++ ?></td>
						          <td><?php echo $ord['Name'] ?></td>
						          <td><?php echo $ord['BatchNo'] ?></td>
						          <td><?php echo $ord['CatName'] ?></td>
						          <td><?php echo $ord['Quantity'] ?></td>

						        </tr>
							<?php
								}
							?>
			      			</tbody>
			      		</table>
			    	</div>
			  	</div>

  	<?php

	  		}
	  	}

	  	?>

</div>

<?php
}
require_once $tempRoute . "footer.php";
