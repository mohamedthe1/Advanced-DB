<?php
$dbMemb = new DB();
$dbMemb->getAllFrom('*', 'admins');

$dbCat = new DB();
$dbCat->getAllFrom('*', 'categories');

$dbMed = new DB();
$dbMed->getAllFrom('*', 'medicine');

$admin = new Admin();
?>

<nav class="navbar nav-header">
  <div class="container header-info">
    <!-- Brand and toggle get grouped for better mobile display -->

      <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="pull-left"></div>
      <i class="fa fa-phone"> 01116956988 / 01027768442</i>
      <i class="fa fa-envelope"> <a style='color:#777777;' href="https://www.linkedin.com/in/mohamed-mostafa-8aab54214/">My linkedin</a></i>

      </div>
       <div class="pull-right">
          <?php if ($admin->IsLoggedIn()) { ?>
              <a href="admin/index.php"><?php echo $admin->data()[
                  'FullName'
              ]; ?></a>
          <?php } else { ?>
             <a href="admin/login.php">Login As Admin</a>
          <?php } ?>

       </div>

    <!-- Collect the nav links, forms, and other content for toggling -->

  </div><!-- /.container-fluid -->
</nav>


<nav class="navbar navbar-inverse ">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="color:#FFF;" href="#"><i style="margin-top: -5px;" class="fa fa-ambulance fa-2x"></i></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php
        $link = explode('/', $_SERVER['PHP_SELF'], 6);
        $word = $link[count($link) - 1];
        $word = str_split($word, stripos($word, '.'))[0];
        ?>
        <li class="<?php if ('index' == $word) {
            echo 'active';
        } ?>"><a href="index.php">Home</a></li>

      </ul>


      



    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->
</nav>
