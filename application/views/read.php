    <?php include('header.php');?>
    <!-- Main body -->
    <div id="content" class="container">
        <main class="row" >
            <!-- here starts the sidebar -->
            <?php include('sidebar.php'); ?>
            <!-- here starts the post area -->
            <div class="col-lg-8 post">
                <!-- title section -->
                <section name='post_title'>
                    <h1><a href=<?php echo $config['base_url'].'main/read/'.$post->id; ?> ><?php echo $post->title ?></a></h1>
                    <p class="lead">
                        <i class="fa fa-user"></i> przez <a href=""><?php echo $post->author ?></a>
                    </p>
                    <hr>
                    <p><i class="fa fa-calendar"></i> Utworzono <?php echo $post->created_on ?></p>
                </section>
                <!-- Tags section -->
                <section name="tags_section">
                    <p>
                        <i class="fa fa-tags"></i> Tagi: 
                        <?php //foreach; ?>
                        <a href=""><span class="badge badge-info"> Placeholder </span></a>
                        <?php //endforeach; ?>
                    </p>
                </section>
                <!-- End of tags section -->
                <hr>
                <?php require('partials/post_title_and_content.phtml'); ?>
                <hr>
                </br>
                <!-- the comment box -->
                <?php require('partials/comment_form.phtml'); ?>
                <hr>
                <!-- the comments section -->
                <?php require('partials/comments_section.phtml'); ?>
            </div>
        </main>
    </div>
    <?php include('footer.php'); ?>