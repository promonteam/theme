<!-- jQuery -->
<script src="<?php echo get_template_directory_uri() ?>/js/jquery.min.js"></script>
<!-- jQuery Easing -->
<script src="<?php echo get_template_directory_uri() ?>/js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="<?php echo get_template_directory_uri() ?>/js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="<?php echo get_template_directory_uri() ?>/js/jquery.waypoints.min.js"></script>
<!-- Flexslider -->
<script src="<?php echo get_template_directory_uri() ?>/js/jquery.flexslider-min.js"></script>
<!-- Magnific Popup -->
<script src="<?php echo get_template_directory_uri() ?>/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/magnific-popup-options.js"></script>

<!-- For demo purposes only styleswitcher ( You may delete this anytime ) -->
<script src="<?php echo get_template_directory_uri() ?>/js/jquery.style.switcher.js"></script>
<script>
    $(function(){
        $('#colour-variations ul').styleSwitcher({
            defaultThemeId: 'theme-switch',
            hasPreview: false,
            cookie: {
                expires: 30,
                isManagingLoad: true
            }
        });
        $('.option-toggle').click(function() {
            $('#colour-variations').toggleClass('sleep');
        });
    });
</script>
<!-- End demo purposes only -->

<!-- Main JS (Do not remove) -->
<script src="<?php echo get_template_directory_uri() ?>/js/main.js"></script>

<!--
INFO:
jQuery Cookie for Demo Purposes Only.
The code below is to toggle the layout to boxed or wide
-->
<script src="<?php echo get_template_directory_uri() ?>/js/jquery.cookie.js"></script>
<script>
    $(function(){

        if ( $.cookie('layoutCookie') != '' ) {
            $('body').addClass($.cookie('layoutCookie'));
        }

        $('a[data-layout="boxed"]').click(function(event){
            event.preventDefault();
            $.cookie('layoutCookie', 'boxed', { expires: 7, path: '/'});
            $('body').addClass($.cookie('layoutCookie')); // the value is boxed.
        });

        $('a[data-layout="wide"]').click(function(event){
            event.preventDefault();
            $('body').removeClass($.cookie('layoutCookie')); // the value is boxed.
            $.removeCookie('layoutCookie', { path: '/' }); // remove the value of our cookie 'layoutCookie'
        });
    });
</script>

<?php wp_footer() ?>
</body>
</html>