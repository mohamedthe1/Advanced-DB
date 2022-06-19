<?php

session_start();
$navbar = true;
$title = "Search";

require_once "core/init.php";
$admin = new Admin();
if(!$admin->IsLoggedIn())
{
	Redirect::to("login.php");
}
else
{
	if(Input::exists("POST"))
	{
		$medName = Input::get('medicine');

		$catName = Input::get('CatName');

		$db = new DB();
		if($catName == "0")
		{
			if($medName === NULL)
				$db->getAllFrom("*", "medicine");
			else
			{
				$db->getAllFrom("*", "medicine","WHERE Name LIKE '%$medName%'");
				
			}

		}
		else
		{
			if($medName === "")
				$db->getAllFrom("*", "medicine","WHERE CatName = ?",array($catName));
			else
				$db->getAllFrom("*", "medicine","WHERE Name LIKE '%$medName%' AND CatName = '{$catName}'");
		}


?>

<div class="container">

	<?php
		if($db->getCount() > 0)
		{
	?>
			<h1 class="text-center" style="font-weight: bold"><?php echo $medName == "" ? "Medicines" : $medName ?> Information</h1>
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
					          <th>Opitions</th>
				        	</tr>
			        <?php
						foreach($db->getResult() as $res)
						{
					?>

							<tr>

					          <td><?php echo $res['Name'] ?></td>
					          <td><?php echo $res['BatchNo'] ?></td>
					          <td><?php echo $res['SalesPrice'] ?> L.E</td>
					          <td><?php echo $res['PurchasePrice'] ?> L.E</td>
					          <td><?php echo $res['CatName'] ?></td>
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
		else
		{
			echo "<div class='alert alert-danger'>This medicine is not exists!</div>";
			Redirect::to("index.php");
		}
	?>
</div>



<?php

		require_once $tempRoute . "footer.php";
	}
	else
	{
		Redirect::to("404.php");
	}
}


?>
