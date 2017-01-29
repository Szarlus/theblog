<?php
    global $config;

    include(APP_DIR.'views/partials/head_include.phtml');
?>
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
                <a class="navbar-brand" href="<?php echo BASE_URL; ?>main">theBlog</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Edycja<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Wszystkie wpisy</a></li>
                            <li><a href="<?php echo BASE_URL; ?>admin/posts">Nowy wpis</a></li>
                            <li><a href="<?php echo BASE_URL; ?>admin/categories">Kategorie</a></li>
                            <li><a href="#">Tagi</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo BASE_URL; ?>admin/logout"><span class="glyphicon glyphicon-log-in"></span> Wyloguj </a></li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
        if(isset($error_message) && !empty($error_message)) { 
            include(APP_DIR.'views/administrator/partials/error_display.phtml'); 
        }
    ?>