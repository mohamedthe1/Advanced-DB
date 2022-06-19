<?php
$navbar = true;
$title = "Search";

session_start();

require_once "core/init.php";
if(Input::exists("POST") || Input::exists("GET"))
{
	if((Input::exists("GET")))
	{
		$medName = "";
		$catName = Input::get('catName',"GET");
	}
	else
	{
		$medName = Input::get('medicine');
		$catName = Input::get('CatName');
	}

	$medicines = new DB();

	if($catName == "0")
	{
		if($medName === NULL)
			$medicines->getAllFrom("*", "medicine");
		else
		{
			$medicines->getAllFrom("*", "medicine","WHERE Name LIKE '%$medName%'");
			
		}

	}
	else
	{
		if($medName === "")
			$medicines->getAllFrom("*", "medicine","WHERE CatName = ?",array($catName));
		else
			$medicines->getAllFrom("*", "medicine","WHERE Name LIKE '%$medName%' AND CatName = '{$catName}'");
	}

}


?>

<div class='container'>
	<div class='row' style='margin-top:10px;'>
		<?php


			if(!empty($medicines->getResult()))
			{
			    foreach($medicines->getResult() as $medicine)
			    {

					echo "<div class='item'>";
						echo "<div class='col-sm-6 col-md-3'>";
							echo "<div class='thumbnail item-box'>";

								echo "<div class='caption'>";

									echo $medicine['Quantity'] == 0 ? "<img class='img-controll' src='sale.png'>" : "";
									echo "<h4 style='height:30px;margin-bottom:15px;' class='text-center'>" . $medicine['Name'] . "</h4>";
									echo '<img class="thumbnail" style="margin:5px; auto" src="admin/uploads/medicines/' . $medicine["image"] . '" width="95%;" alt="med_image">';
									echo "<h3 style='color:#F39C12' class='text-center'> " . $medicine['SalesPrice'] . " L.E</h3>";
									echo "<h4 style='height:30px;'>Category : <a href='search.php?catName={$medicine['CatName']}'>" . $medicine['CatName'] . "</a></h4>";
									if($medicine['Quantity'] == 0)
									{
										echo "<h4>Quantity : " . $medicine['Quantity'] . "</h4>";
										echo "<a disabled class='btn btn-block btn-warning btn-flat'><i class='fa fa-shopping-cart'></i> Buy</a>";
									}
									else
									{
										echo "<h4>Quantity : " . $medicine['Quantity'] . "</h4>";
										echo "<a href='buy.php?medName={$medicine['Name']}' class='btn btn-block btn-warning btn-flat'><i class='fa fa-shopping-cart'></i> Buy</a>";
									}
								echo "</div>";
							echo "</div>";
					    echo "</div>";
					echo "<div>";

				}
			}
			else
			{
				echo "<div class='alert alert-danger text-center'><h2>There Is No Medicines With This Name !</h2></div>";
				Redirect::to("index.php",3);
			}
	    ?>
    </div>
</div>


<?php
require_once $tempRoute . "footer.php";
