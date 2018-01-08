<?php
//* Code goes here
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

add_action('the_champ_login_user','wpse38285_wp_footer');
function addPledge()
{

  /*wp_register_script('my_amazing_script', get_template_directory_uri() . '/removeArrows.js', array('jquery'),'1.1', true);
    wp_enqueue_script('my_amazing_script');
	*/


update_user_meta(1,'test',5465487);

   $js = <<<JS
   <script type="text/javascript">
       jQuery('<div />')
           .html('<p>s <strong>$current_user->user_login</strong><br /><small>(click to close)</small></p>')
           .css({
               'width': '300px',
               'position': 'absolute',
               'left': '50%',
               'marginLeft': '-160px',
               'top': '100px',
               'backgroundColor': '#cdcdcd',
               'textAlign': 'center',
               'padding': '10px'
           })
           .appendTo('body')
           .on('click', function() { jQuery(this).remove(); } );
           alert('dsds')
   </script>
JS;
   echo $js;

	
}

function wpse38285_wp_footer() {


   $js = <<<JS
   <script type="text/javascript">
       jQuery('<div />')
           .html('<p>s <strong>$current_user->user_login</strong><br /><small>(click to close)</small></p>')
           .css({
               'width': '300px',
               'position': 'absolute',
               'left': '50%',
               'marginLeft': '-160px',
               'top': '100px',
               'backgroundColor': '#cdcdcd',
               'textAlign': 'center',
               'padding': '10px'
           })
           .appendTo('body')
           .on('click', function() { jQuery(this).remove(); } );
           alert('dsds')
   </script>;

JS;
   echo $js;
}
//add_action( 'wp_footer', 'wpse38285_wp_footer' );

	