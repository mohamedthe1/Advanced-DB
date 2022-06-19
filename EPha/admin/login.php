<?php
$title="Login";
session_start();
require_once "core/init.php";
$admin = new Admin();
if($admin->IsLoggedIn())
{
	Redirect::to("index.php",0);
}
else
{
	if(Input::exists("POST"))
	{
		$username = Input::get("username");
		$password = Input::get("password");
		$remember = Input::get("remember");;
		if(Input::get("remember") === "on")
		{
			$remember = true;
		}
		if($admin->login($username,$password,$remember))
		{

			Redirect::to('index.php',0);
		}
		else
		{
			$error = "Username or Password is incorrect";
		}
	}


/*
$db->getAllFrom("*","admins","WHERE username = {")

*/
?>
	<div class="container">
		<div class="login-form"><!--login form-->
			<h1 class="text-center">Admin Login</h1>
			<form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
				<input required class="form-control" type="text" name="username" placeholder="Username" autocomplete="off" />
				<input required class="form-control" type="password" name="password" placeholder="Password" autocomplete="off"  />
				
				<button type="submit" class="btn btn-block btn-default">Login</button>
				<br>
				<?php
					if(isset($error))
					{
						echo "<div class='alert alert-danger'>" . $error . "</div>";
					}
				?>
			</form>
		</div>
	</div>
<?php

require_once $tempRoute . "footer.php";
}
?>
