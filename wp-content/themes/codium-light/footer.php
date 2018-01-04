<?php if ( is_active_sidebar( 'widgetfooterleft' ) OR is_active_sidebar( 'widgetfootercenter' ) OR is_active_sidebar( 'widgetfooterright' ) ) { ?>
	<div class="sixteen columns">
		<div id="footer" class="infocontainer justif dp100 entry-content">
            <?php if ( is_active_sidebar( 'widgetfooterleft' ) ) : ?>
            <div class="dp30 widget">
                <?php dynamic_sidebar( 'widgetfooterleft' ); ?>
            </div>
            <?php endif; // end widgetfooterleft  ?>
            <?php if ( is_active_sidebar( 'widgetfootercenter' ) ) : ?>
            <div class="dp30 widget">
                <?php dynamic_sidebar( 'widgetfootercenter' ); ?>
            </div>
            <?php endif; // end widgetfootercenter  ?>
            <?php if ( is_active_sidebar( 'widgetfooterright' ) ) : ?>
            <div class="dp30 widget">
                <?php dynamic_sidebar( 'widgetfooterright' ); ?>
            </div>
            <?php endif; // end widgetfooterright  ?>
	    </div>
    </div>
<?php }; // end widgetfooterright  ?>
<?php wp_footer() ?>
</div>
</body>
</html>