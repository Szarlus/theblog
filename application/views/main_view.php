    <?php include('header.php');?>
    <!-- Main body -->
    <div id="content" class="container">
        <main class="row" >
            <!-- here starts the sidebar -->
            <?php include('sidebar.php'); ?>
            <!-- here starts the main blog area -->
            <div class="col-lg-8"><?php $_SESSION['var']='set' ;?>
                <?php include 'partials/posts_list.phtml'; ?>
            </div>
        </main>
    </div>
    <?php include('footer.php'); ?>
