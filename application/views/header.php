<!DOCTYPE html>
<html lang="en">
<?php global $config; ?>
<head>
    <meta charset="utf-8" />
    
    <title>Welcome to theblog</title>
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="stylesheet" href="<?php echo $config['base_url']; ?>static/css/style.css" type="text/css" media="screen" />

    <link rel="icon" type="image/png" href="<?php echo $config['base_url']; ?>static/images/myicon.png">

    <!-- Bootstrap -->
    <link href="<?php echo $config['base_url']; ?>static/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body >
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header ">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">theBlog</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo $config['base_url']; ?>main">Strona główna</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Wpisy<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Page 1-1</a></li>
                            <li><a href="#">Page 1-2</a></li>
                            <li><a href="#">Page 1-3</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo $config['base_url']; ?>main/about">O autorze</a></li>
                    <li><a href="<?php echo $config['base_url']; ?>main/contact">Kontakt</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> Logowanie </a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Strefa administracyjna</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
            <div class="jumbotron"><h1>HEADER</h1></div>
    </div>


