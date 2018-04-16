<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<link rel="stylesheet" href=<?php echo asset_url()."css/style.css?v=".time(); ?>>
  <link rel="stylesheet" href=<?php echo asset_url()."css/my-slider.css?v=".time(); ?>>
	<script src="https://use.fontawesome.com/013969aaa2.js"></script>
  <script src=<?php echo asset_url()."js/ism-2.2.min.js" ?>></script>
</head>

<body>

	 <nav class="navbar navbar-expand-md fixed-top navbar-toggleable-xl navbar-white" style="border-bottom: 1px solid #ddd; color:black;">
      <a class="navbar-brand" href=<?php echo site_url('start'); ?> style="padding-left:20%;"><h1 class="display-4">Game-Market.pl</h1></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

        <ul class="navbar-nav" style="margin-left:20%; display:block-inline;">
        <?php 
        if(!isset($user)) {
        ?>
          <li class="nav-item">
            <a class="nav-link no-collapse" href="<?php echo site_url('login'); ?>">Zaloguj się</a>
          </li>
        <?php
    	} else {
    	?>
    		<li class="nav-item dropdown" id="login">
		        <a class="nav-link dropdown-toggle" href="<?php echo site_url('start'); ?>" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		         <i class="fa fa-user" aria-hidden="true"></i> <?php echo $user['login']; ?>
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		          <a class="dropdown-item" href="#">Twoje Ogłoszenia</a>
		          <a class="dropdown-item" href="#">Wiadomości</a>
		          <a class="dropdown-item" href="#">Ustawienia</a>
		          <a class="dropdown-item" href="logout">Wyloguj</a>
		        </div>
	     	 </li>
    	<?php
    	}
    	?>
          <li class="nav-item" style="padding-left:1rem; text-transform:uppercase;">
            <a class="btn btn-warning" href="<?php echo site_url('ad/add'); ?>" role="button" style="color:#ffffff;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Dodaj Ogłoszenie</a>
          </li>
        </ul>
    </nav>
