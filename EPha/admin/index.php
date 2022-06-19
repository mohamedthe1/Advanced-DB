<?php
session_start();
$navbar = true;
$title = "Home";

require_once "core/init.php";

$admin = new Admin();

if(!$admin->IsLoggedIn())
{
	Redirect::to("login.php");
}
else
{
	$db = new DB();


?>

<div class="content">

	<div class="container">
		<h1 class="text-center" style="font-weight: bold;padding-top: 20px;">Admin Dashboard</h1>
		<div class="row">
		   	<div class="col-lg-3 col-xs-6">
		      	<!-- small box -->
		      	<div class="small-box bg-green">
		            <div class="inner">
			            <h3>
			            	<?php
			            		$db->getAllFrom("*","customers","WHERE Approve = ?",array(0));
			            		echo $db->getCount();
			            	?>
			            </h3>
						<p>Pinding Orders</p>
		            </div>
		            <div class="icon">
		              	<i class="fa fa-lock"></i>
		            </div>
		        	<a href="orders.php?type=pending" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		      	</div>
		    </div>
		        <!-- ./col -->
		    <div class="col-lg-3 col-xs-6">
		      <!-- small box -->
		      	<div class="small-box bg-green">
		            <div class="inner">
		              	<h3>
			              	<?php
				              	$db->getAllFrom("*","customers","WHERE Approve = ?",array(1));
				              	echo $db->getCount();
			              	?>
			            </h3>
						<p>Total Orders</p>
		            </div>
		            <div class="icon">
		              	<i class="fa fa-bar-chart"></i>
		            </div>
		            <a href="orders.php?type=total" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		      	</div>

		    </div>
		        <!-- ./col -->
		     <div class="col-lg-3 col-xs-6">
		      	<!-- small box -->
		      	<div class="small-box bg-red">
		            <div class="inner">
			            <h3>
			            	<?php
			            		$db->getAllFrom("*","medicine","WHERE Quantity < ?",array(50));
			            		echo $db->getCount();
			            	?>
			            </h3>
						<p>Low Medicine Quantity</p>
		            </div>
		            <div class="icon">
		              	<i class="fa fa-medkit"></i>
		            </div>
		        	<a href="orders.php?type=lowquantity" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		      	</div>
		    </div>


		      <!-- ./col -->
		    <div class="col-lg-3 col-xs-6">
		      <!-- small box -->
		        <div class="small-box bg-red">
		            <div class="inner">
		              	<h3>
		              		<?php
				          		$db->getAllFrom("SUM(Quantity)","medicine");
				              	echo $db->getFirstResult()['SUM(Quantity)'] > 0 ? $db->getFirstResult()['SUM(Quantity)'] : "0";
			              	?>
		              	</h3>
		              	<p>Medicine Total Quantity</p>
		            </div>
		            <div class="icon">
		              	<i class="fa fa-medkit"></i>
		            </div>
		            <a href="orders.php?type=totalquentity" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		        </div>
		    </div>




		        <!-- ./col -->
		</div>


		  <div class="row">

		   	<!-- ./col -->

		   

		</div>

		</div>


	</div>
</div>
<?php
}
require_once $tempRoute . "footer.php";
