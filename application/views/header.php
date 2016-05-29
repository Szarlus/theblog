<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    
    <title>Welcome to theblog</title>
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>static/css/style.css" type="text/css" media="screen" />

    <link rel="icon" type="image/png" href="<?php echo BASE_URL; ?>static/images/myicon.png">

    <!-- Bootstrap -->
    <link href="<?php echo BASE_URL; ?>static/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <div class="container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">theBlog</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?php echo BASE_URL; ?>main">Strona główna</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Wpisy<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Page 1-1</a></li>
                                <li><a href="#">Page 1-2</a></li>
                                <li><a href="#">Page 1-3</a></li>
                            </ul>
                        </li>
                        <li><a href="main">O autorze</a></li>
                        <li><a href="#">Kontakt</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Logowanie </a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Strefa administracyjna</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <header class="row" style="border: solid rebeccapurple">HEADER
            <div class="jumbotron"></div>
        </header>
    </div>

</head>
<body>
