<?php include('header.php');?>
<!-- Main body -->
<div id="content" class="container">
<!--    <main class="row" >-->
        <!-- here starts the sidebar -->
        <?php //require_once('sidebar.php'); ?>
        <!-- here starts the main ADMIN area -->
        <div class="jumbotron">
            <h2>Witaj, <em><?php echo $_SESSION['username'] ?></em>, w panelu administracyjnym!</h2>
        </div>
<!--    </main>-->
</div>
<?php include(APP_DIR.'views/footer.php'); ?>
