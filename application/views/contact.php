<?php include('header.php');?>
    <!-- Main body -->
    <div id="content" class="container">
        <main class="row" >
            <!-- here starts the sidebar -->
            <?php include('sidebar.php'); ?>
            <!-- here starts the post area -->
            <div class="col-lg-8 contact_me">
                <?php include ('partials/contact_form_logic.php'); ?>
                <?php include('partials/contact_form.phtml'); ?>
            </div>
        </main>
    </div>
<?php include('footer.php'); ?>