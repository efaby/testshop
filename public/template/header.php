<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo PATH_CSS; ?>/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo PATH_CSS; ?>/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo PATH_CSS; ?>/google-fonts.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo PATH_CSS; ?>/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo PATH_CSS; ?>/style.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo PATH_IMAGES.'/favicon.ico'?>" />
</head>

<body class="skin-black">
    <header id="header">
        <div class="center">
            <div id="logo">
                <img src="<?php echo PATH_IMAGES; ?>/logo.png" class="logo" alt="logo" />
                <span id="brand">
                    <strong>Faby</strong>Store
                </span>
            </div>
            <nav id="menu">
                <ul>
                    <li>
                        <a href="<?php echo URL_BASE; ?>">Home</a>
                    </li>
                    <li>
                        <?php if(!isset($_SESSION['SESSION_USER'])):?>
                        <a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
                        <?php else: ?>
                        <a href="<?php echo URL_BASE; ?>Security/logout/">Logout</a>
                        <?php endif;?>
                    </li>
                    <?php if(isset($_SESSION['SESSION_USER'])):?>
                    <li>
                        <a href="<?php echo URL_BASE; ?>ShoppingCart/cart/">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="label label-success" id="items">
                                <?php echo (isset($_SESSION['SESSION_USER']))? $_SESSION['SESSION_USER']->numberItems : 0 ;?>
                            </span>
                        </a>
                    </li>
                    <?php endif;?>
                </ul>
            </nav>
            <div class="clearfix"></div>
        </div>
    </header>
    <section class="content">
        <div class="content-wrapper">
            <div class="container">
                <?php if(isset($_SESSION['SESSION_USER'])):?>
                <div id="user-data">
                    <?php echo "Usuario: <strong>".$_SESSION['SESSION_USER']->username."</strong>";?>
                </div>
                <?php endif;?>