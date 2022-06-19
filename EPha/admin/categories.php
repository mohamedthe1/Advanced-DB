<?php


session_start();
$navbar = true;
$title = "Categories";

require_once "core/init.php";

$admin = new Admin();
if(!$admin->IsLoggedIn())
{
	Redirect::to("login.php");
}
else
{
	$db = new DB();
	$action = Input::get("action","GET");

?>
<div class="container">

	<?php
		if($action === "manage")
		{
			$med = new DB();
			$med->getAllFrom("SUM(Quantity)","medicine","GROUP BY CatName");

			$db->getAllFrom("*","categories","ORDER BY ID ASC");
			if($db->getCount() <= 0)
			{
				echo "<div class='alert alert-danger'>There's no Categories!!!</div>";
				echo "<a class='btn btn-primary' href='categories.php?action=add'><i class='fa fa-plus'></i> Add New Category</a>";

			}
			else
			{
	?>
				<h1 class="text-center" style="font-weight: bold">Categories Information</h1>
				<a class="btn btn-primary" href="categories.php?action=add"><i class="fa fa-plus"></i> Add New Category</a>
			  	<div class="box">
			    	<div class="box-body table-responsive no-padding">
			      		<table class="table table-hover">
					        <tbody>
					        	<tr>
						          <th>ID</th>
						          <th>Name</th>
						          <th>Medicine Quantity</th>
						          <th>Opitions</th>
						        </tr>
							<?php
								$x = 0;

								foreach($db->getResult() as $res)
								{

							?>
					        	<tr>
						          <td><?php echo $res['ID'] ?></td>
						          <td><?php echo $res['Name'] ?></td>
						          <td><?php echo isset($med->getResult()[$x]['SUM(Quantity)']) ? $med->getResult()[$x]['SUM(Quantity)'] : 0; $x++; ?></td>
						          <td>
						          	<a href="categories.php?action=update&tab=categories&id=<?php echo $res['ID']?>&name=<?php echo $res['Name']?>" class="btn btn-xs btn-success  "><i class="fa fa-edit "></i></a>
						          	<a href="actions.php?action=delete&tab=categories&id=<?php echo $res['ID']?>" class="confirm btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></i></a>
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
		else if($action === "add")
		{
	?>

		  	<form action="actions.php?action=add&tab=categories" method="POST">
		  		<h1 style="margin-top: -100px;font-weight: bold" class="text-center" style="font-weight: bold">Add Category</h1>

		  		<div class="form-group">
		  			<label for="medid">Category ID</label>
		  			<input type="text" class="form-control" required id= "medid" name="ID" placeholder="Category ID">
		  		</div>

		  		<div class="form-group">
		  			<label for="medname">Category Name</label>
		  			<input type="text" class="form-control" required id= "medname" name="Name" placeholder="Category Name">
		  		</div>

		  		<div class="form-group">
		  			<label for="salesprice">Description</label>
		  			<textarea class="form-control" id= "salesprice" name="Description" placeholder="Description"></textarea>
		  		</div>


		  		<input type="submit" class="btn btn-success pull-right" value="Add Category">
		  		<a class="btn btn-default pull-left" href="medicine.php?action=manage">Cancle</a>

		  	</form>

  	<?php

  		}
  		else if($action === "update")
	  	{
	  		$data = $_GET;
	  		$cats = new DB();
	  		$cats->getAllFrom("*","{$data['tab']}","WHERE ID = ?",array("{$data['id']}"));

	  	?>

		  	<form action="actions.php?action=update&tab=categories&id=<?php echo $data['id']?>&name=<?php echo $data['name']?>" method="POST">
		  		<h1 style="margin-top: -100px;font-weight: bold" class="text-center" style="font-weight: bold">Update Category</h1>

		  		<div class="form-group">
		  			<label for="medid">Category ID</label>
		  			<input type="text" class="form-control" required id= "medid" name="ID" value="<?php echo $cats->getFirstResult()['ID']?>" placeholder="Category Name">
		  		</div>

		  		<div class="form-group">
		  			<label for="medname">Category Name</label>
		  			<input type="text" class="form-control" required id= "medname" name="Name" value="<?php echo $cats->getFirstResult()['Name']?>" placeholder="Category Name">
		  		</div>

		  		<div class="form-group">
		  			<label for="salesprice">Description</label>
		  			<textarea class="form-control" id= "salesprice" name="Description" placeholder="Description"><?php echo $cats->getFirstResult()['Description']?></textarea>
		  		</div>



		  		<input type="submit" class="btn btn-success pull-right" value="Update Category">
		  		<a class="btn btn-default pull-left" href="medicine.php?action=manage">Cancle</a>
		  	</form>

	  	<?php
	  	}
	  	?>

</div>

<?php
}
require_once $tempRoute . "footer.php";
