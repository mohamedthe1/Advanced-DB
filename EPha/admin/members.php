<?php

session_start();
$navbar = true;
$title = "Members";

require_once "core/init.php";
$admin = new Admin();
if(!$admin->IsLoggedIn())
{
	Redirect::to("login.php");
}
else
{
	$db = new DB();
	$db->getAllFrom("*","admins");
	$action = Input::get("action","GET");

?>



<div class="container">

	<?php
		if($action === "manage")
		{
			if($db->getCount() <= 0)
			{
				echo "<div class='alert alert-danger'>There's no Members!!!</div>";
			}
			else
			{

	?>
				<h1 class="text-center" style="font-weight: bold">Members Information</h1>

				<?php
				 	if($admin->data()['permission'] == 1)
				 	{
				 ?>
				<a class="btn btn-primary" href="members.php?action=add"><i class="fa fa-plus"></i> Add New Member</a>

				<?php
					}
				?>

			  	<div class="box">
			    	<div class="box-body table-responsive no-padding">
			      		<table class="table table-hover">
					        <tbody>
					        	<tr>
						          <th>ID</th>
						          <th>Username</th>
						          <th>Email</th>
						          <th>FullName</th>
						          <th>Permission</th>
						          <th>Options</th>

						        </tr>
							<?php

								foreach($db->getResult() as $res)
								{

							?>
					        	<tr>
								<td><?php echo $res['ID'] ?></td>
						          <td><?php echo $res['Username'] ?></td>
						          <td><?php echo $res['Email'	] ?></td>
						          <td><?php echo $res['FullName'] ?></td>
						          <td><?php echo $res['permission'] == '0'? 'Assistant':'Admin' ?></td>
						          <td>
						          	<?php
						          		if($admin->data()['permission'] == '1') {
						          			if($res['permission'] !== '1' && $admin->data()['ID'] !== $res['ID']) {
						          	?>
											<a title="Delete" class="btn btn-xs btn-danger confirm" href="actions.php?action=delete&tab=admins&id=<?php echo $res['ID'] ?>">
												<i class="fa fa-trash"></i>
											</a>
									<?php

							          		}
										}
									?>
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

		  	<form action="actions.php?action=add&tab=admins" method="POST">
		  		<h1 style="margin-top: -100px;font-weight: bold" class="text-center" style="font-weight: bold">Add Member</h1>

		  		<div class="form-group">
		  			<label for="Username">Username</label>
		  			<input type="text" class="form-control" required id= "Username" name="Username" placeholder="Username">
		  		</div>

		  		<div class="form-group">
		  			<label for="email">Email</label>
		  			<input type="email" class="form-control" required id= "email" name="Email" placeholder="Email">
		  		</div>

		  		<div class="form-group">
		  			<label for="fullname">Full Name</label>
		  			<input class="form-control" id= "fullname" name="FullName" placeholder="Full Name">
		  		</div>

		  		<div class="form-group">
		  			<label for="password">Password</label>
		  			<input class="form-control" id= "password" name="Password" placeholder="Password">
		  		</div>

				<div class="form-group">
		  			<label for="medname">Permissions</label>
		  			<select class="form-control" required name="permission">
		  				<option value="0">Assistant</option>
		  				<option value="1">Admin</option>
		  			</select>
	  			</div>




		  		<input type="submit" class="btn btn-success pull-right" value="Add Member">
		  		<a class="btn btn-default pull-left" href="members.php?action=manage">Cancle</a>

		  	</form>

  	<?php
  		}

?>
</div>



<?php
}


require_once $tempRoute . "footer.php";
