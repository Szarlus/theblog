<?php include('header.php');?>
<!-- Main body -->
<div id="content" class="container">
    <main class="row" >
        <!-- here starts the sidebar -->
        <?php //require_once('sidebar.php'); ?>
        <!-- here starts the main ADMIN area -->
<!--        <div class="col-md-8">-->
            <?php //include APP_DIR.'/views/partials/posts_list.phtml'; ?>
<!--        </div>-->
        <div class="row">
<!--            <div class="col-md-8"></div>-->
        <!--<form id="categories_finder">
            <div class="col-md-4 col-md-offset-8">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="Szukaj..." name="search_name">
                    <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" name="category_search">Wyszukaj kategorię</button>
                            </span>
                </div><!-- /input-group -->
            </div>
        </form>-->
        </div> <!-- row -->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php include 'partials/post_form.phtml' ?>
            </div>
            <!--<div class="col-md-8">-->
                <?php //include 'partials/categories_table.phtml' ?>
            <!--</div>-->
        </div>
    </main>
</div>
<?php include(APP_DIR.'views/footer.php'); ?>
