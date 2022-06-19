<?php

session_start();
$navbar = true;
$title = "Medicines";

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
		$db->getAllFrom("*","medicine");
		if($db->getCount() <= 0 )
		{
			echo "<div class='alert alert-danger'>There's no Medicine!!!</div>";
			echo "<a class='btn btn-primary' href='medicine.php?action=add'><i class='fa fa-plus'></i> Add New Medicine</a>";

		}
		else
		{
	?>

			<h1 class="text-center" style="font-weight: bold">Medicines Information</h1>
			<a class="btn btn-primary" href="medicine.php?action=add"><i class="fa fa-plus"></i> Add New Medicine</a>
			<div class="box">

		    	<div class="box-body table-responsive no-padding">
		      		<table class="table table-hover">
				        <tbody>
				        	<tr>

					          <th>Name</th>
					          <th>Batch No</th>
					          <th>Sales Price</th>
					          <th>Purchase Price</th>
					          <th>Category Name</th>
					          <th>Quantity</th>
					          <th>Opitions</th>


				        	</tr>
			        <?php
						foreach($db->getResult() as $res)
						{
					?>

							<tr>
					          <td><?php echo $res['Name'] ?></td>
					          <td><?php echo $res['BatchNo'] ?></td>
					          <td><?php echo $res['SalesPrice'] ?> L.E </td>
					          <td><?php echo $res['PurchasePrice'] ?> L.E </td>
					          <td><?php echo $res['CatName'] ?></td>
					          <td><?php echo $res['Quantity'] ?></td>
							  
					          
					          <td>
					          	<a href="medicine.php?action=update&tab=medicine&batchno=<?php echo $res['BatchNo']?>" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
					          	<a href="actions.php?action=delete&tab=medicine&batchno=<?php echo $res['BatchNo']?>" class="confirm btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
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

	  	<form action="actions.php?action=add&tab=medicine" method="POST" enctype="multipart/form-data">
	  	<h1 style="margin-top: -100px;font-weight: bold" class="text-center" style="font-weight: bold">Add Medicine</h1>
	  		<div class="form-group">
	  			<label for="medname">Medicine Name</label>
	  			<input type="text" class="form-control" required id= "medname" name="Name" placeholder="Name">
	  		</div>
		 	<div class="form-group">
	  			<label for="batchno">Batch No</label>
	  			<input type="text" class="form-control" required id= "batchno" name="BatchNo" placeholder="Batch Number">
	  		</div>
	  		<div class="form-group">
	  			<label for="salesprice">Sales Price</label>
	  			<input type="text" class="form-control" required id= "salesprice" name="SalesPrice" placeholder="Sales Price">
	  		</div>
	  		<div class="form-group">
	  			<label for="purchaseprice">Purchase Price</label>
	  			<input type="text" class="form-control" required id= "purchaseprice" name="PurchasePrice" placeholder="Purchase Price">
	  		</div>
	  		<div class="form-group">
	  			<label for="quantity">Quantity</label>
	  			<input type="text" class="form-control" required id= "quantity" name="Quantity" placeholder="Quantity">
	  		</div>
	  		<div class="form-group">
	  			<label for="medname">Category</label>
	  			<select class="form-control" required name="CatName">
	  				<option value="0">...</option>
	  				<?php
	  					$db->getAllFrom("*","categories");
	  					if($db->getCount() > 0)
		  					foreach ($db->getResult() as $cat) {
		  						echo "<option value='{$cat['Name']}'>{$cat['Name']}</option>";
		  					}

	  				?>
	  			</select>
	  		</div>
			  
			<div class="form-group">
	  			<label for="image">Image</label>
	  			<input type="file" class="form-control" id= "image" name="image" placeholder="Image">
	  		</div>


	  		<input type="submit" class="btn btn-success pull-right" value="Add Medicine">
	  		<a class="btn btn-default pull-left" href="medicine.php?action=manage">Cancle</a>

	  	</form>

  	<?php
  	}

  	else if($action === "update")
  	{
  		$data = $_GET;
  		$meds = new DB();
  		$meds->getAllFrom("*","{$data['tab']}","WHERE BatchNo = ?",array("{$data['batchno']}"));

  	?>

	  	<form action="actions.php?action=update&tab=medicine&batchno=<?php echo $data['batchno']?>" method="POST" enctype="multipart/form-data">
	  	<h1 style="margin-top: -100px;font-weight: bold" class="text-center" style="font-weight: bold">Update Medicine</h1>
	  		<div class="form-group">
	  			<label for="medname">Medicine Name</label>
	  			<input type="text" class="form-control" required id= "medname" name="Name" value = "<?php echo $meds->getFirstResult()['Name']?>" placeholder="Name">
	  		</div>
		 	<div class="form-group">
	  			<label for="batchno">Batch No</label>
	  			<input type="text" class="form-control" required id= "batchno" name="BatchNo" value = "<?php echo $meds->getFirstResult()['BatchNo']?>" placeholder="Batch Number">
	  		</div>
	  		<div class="form-group">
	  			<label for="salesprice">Sales Price</label>
	  			<input type="text" class="form-control" required id= "salesprice" name="SalesPrice" value = "<?php echo $meds->getFirstResult()['SalesPrice']?>" placeholder="Sales Price">
	  		</div>
	  		<div class="form-group">
	  			<label for="purchaseprice">Purchase Price</label>
	  			<input type="text" class="form-control" required id= "purchaseprice" name="PurchasePrice" value = "<?php echo $meds->getFirstResult()['PurchasePrice']?>" placeholder="Purchase Price">
	  		</div>
	  		<div class="form-group">
	  			<label for="quantity">Quantity</label>
	  			<input type="text" class="form-control" required id= "quantity" name="Quantity" value = "<?php echo $meds->getFirstResult()['Quantity']?>" placeholder="Quantity">
	  		</div>
	  		<div class="form-group">
	  			<label for="medname">Category</label>
	  			<select class="form-control" required name="CatName">
	  				<option value="0">...</option>
	  				<?php
	  					$db->getAllFrom("*","categories");
	  					if($db->getCount() > 0)
		  					foreach ($db->getResult() as $cat) {
		  						echo "<option value='{$cat['Name']}'";
		  						if($meds->getFirstResult()['CatName'] === $cat['Name'])
		  							echo "selected = selected";
		  						echo ">{$cat['Name']}</option>";
		  					}

	  				?>
	  			</select>
	  		</div>
			<img src="uploads/medicines/<?php echo $meds->getFirstResult()['image'] ?>" width="40px;" alt="med_image">
			<div class="form-group">
	  			<label for="image">Image</label>
	  			<input type="file" class="form-control" id= "image" name="image" placeholder="Image">
	  		</div>


	  		<input type="submit" class="btn btn-success pull-right" value="Update Medicine">
	  		<a class="btn btn-default pull-left" href="medicine.php?action=manage">Cancle</a>

	  	</form>

  	<?php
  	}
  	?>
</div>

<?php

}
require_once $tempRoute . "footer.php";
