<?php
  $dbMemb = new DB();
  $dbMemb->getAllFrom("*","admins");

  $dbCat = new DB();
  $dbCat->getAllFrom("*","categories");

  $dbMed = new DB();
  $dbMed->getAllFrom("*","medicine");



?>

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
      <a class="navbar-brand" style="color:#FFF;" href="#">Admin Panel</a>

    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php
           $link =  explode('/', $_SERVER['PHP_SELF'],6);
           $word = $link[count($link) - 1];
           $word = str_split($word,stripos($word,'.'))[0];

        ?>
        <li class="<?php if('index' == $word) echo 'active'?>"><a href="index.php">Homepage</a></li>
        
        <li class="medicine <?php if('medicine' == $word) echo 'active'?>">
            <a href="medicine.php?action=manage" class="">
            Medicines <span  class="badge"><?php echo ($dbMed->getCount() > 0) ? $dbMed->getCount() : 0  ?></span>
            </a>
        </li>

        <li class="category <?php if('categories' == $word) echo 'active'?>">
            <a href="categories.php?action=manage" class="">
             Categories <span class="badge"><?php echo ($dbCat->getCount() > 0) ? $dbCat->getCount() : 0  ?></span>
            </a>
        </li>

        <li class="member <?php if('members' == $word) echo 'active'?>">
            <a href="members.php?action=manage" >
             Members <span class="badge"><?php echo ($dbMemb->getCount() > 0) ? $dbMemb->getCount() : 0  ?></span>
            </a>
        </li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        </li>
        <li class="dropdown">

          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <?php echo $dbMemb->getFirstResult()['FullName'] ?> <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            
            <li style="margin-left: 0" style="background-color:#286090"><a href="../index.php">Show Shop</a></li>
            <li role="separator" class="divider"></li>
            <li style="margin-left: 0" style="background-color:#286090"><a href="logout.php">Log out</a></li>
          </ul>
        </li>
        
      </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!-- 
<div class= "opitionsMed">
  <div class="add">
    <a href="">Add Medicine</a>
  </div>
  <div class="add">
    <a href="">Update Medicine</a>
  </div>
  <div class="add">
    <a href="">Delete Medicine</a>
  </div>
</div>

<div class= "opitionsCat">
  <div class="add">
    <a href="">Add Category</a>
  </div>
  <div class="add">
    <a href="">Update Category</a>
  </div>
  <div class="add">
    <a href="">Delete Category</a>
  </div>
</div>

<div class= "opitionsMemb">
  <div class="add">
    <a href="">Add Member</a>
  </div>
  <div class="add">
    <a href="">Update Member</a>
  </div>
  <div class="add">
    <a href="">Delete Member</a>
  </div>
</div>
-->