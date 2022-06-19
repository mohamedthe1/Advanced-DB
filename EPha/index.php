<?php

session_start();
$navbar = true;
$title  = "Home";
$var = "Hello world";
require_once "core/init.php";

$medicines = new DB();

$medicines->getAllFrom("*","medicine");

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
				echo "<div class='alert alert-danger text-center'><h2>There Is No Items To Show !</h2></div>";
			}
	    ?>
    </div>
</div>

<?php
require_once $tempRoute . "footer.php";