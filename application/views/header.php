<?php
    global $config;
    include(APP_DIR.'views/partials/head_include.phtml');
?>
<body >
<!--<?php //var_dump($_SESSION); ?>-->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header ">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo BASE_URL; ?>main">theBlog</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo BASE_URL;; ?>main">Strona główna</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Wpisy<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Page 1-1</a></li>
                            <li><a href="#">Page 1-2</a></li>
                            <li><a href="#">Page 1-3</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo BASE_URL;; ?>main/about">O autorze</a></li>
                    <li><a href="<?php echo BASE_URL;; ?>main/contact">Kontakt</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
<!--                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> Logowanie </a></li>-->
                    <li><a href="<?php echo BASE_URL;; ?>main/admin"><span class="glyphicon glyphicon-log-in"></span> Strefa administracyjna</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
            <div class="jumbotron"><h1>HEADER</h1></div>
    </div>


