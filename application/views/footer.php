<div class="navbar-fixed-bottom navbar navbar-default">
    <footer >
        <p>Copyright © Szarlus 2016 | <a href="">Privacy Policy</a> | <a href="">Terms of Use</a></p>
    </footer>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo BASE_URL; ?>static/js/jquery-1.12.3.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo BASE_URL; ?>static/js/bootstrap.min.js"></script>

<!-- include custom js scripts -->
<script src="<?php echo BASE_URL; ?>static/js/scripts.js"></script>

<script>
    $(window).load(function(){
        // $("#post_content > p").first().addClass("lead");
        build_pagination();
    });

</script>

</body>
</html>