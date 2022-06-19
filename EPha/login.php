<?php
session_start();
$title = 'Log In/Sign Up';

require_once 'core/init.php';

if (Input::exists('POST')) {
    $username = Input::get('username');
    $password = Input::get('password');
    $remember = false;
    if (Input::get('remember') === 'on') {
        $remember = true;
    }

    $admin = new Admin();

    if ($admin->login($username, $password, $remember)) {
        Redirect::to('index.php');
    } else {
        $error = 'Username or Password is incorrect';
    }
}

/*
$db->getAllFrom("*","admins","WHERE username = {")

*/
?>
	<div class="container">
		<div class="login-form"><!--login form-->
			<h1 class="text-center">Admin Login</h1>
			<form class="login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<input required class="form-control" type="text" name="username" placeholder="Username" autocomplete="off" />
				<input required class="form-control" type="password" name="password" placeholder="Password" autocomplete="off"  />
				<span>
					<input type="checkbox" id="remember" name="remember" class="checkbox"> 
					<label for="remember">Remember Me</label>
				</span>
				<button type="submit" class="btn btn-default">Login</button>
				<br>
				<?php if (isset($error)) {
        echo "<div class='alert alert-danger'>" . $error . '</div>';
    } ?>
			</form>
		</div>



	</div>
<?php require_once $tempRoute . 'footer.php';

?>
