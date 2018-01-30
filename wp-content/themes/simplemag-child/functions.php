<?php
/**
 * SimpleMag child theme functions & definitions
**/


/**
 * Parent theme style.css
**/

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
//creating a custom post pledge
function create_post_type() {
  register_post_type( 'pledge',
    array(
      'labels' => array(
        'name' => __( 'pledges' ),
        'singular_name' => __( 'pledge' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}
add_action( 'init', 'create_post_type' );

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}


//code to executed on I PLEDGE
add_action('the_champ_login_user','addPledge',10,4 );
//add_action('wp_footer','addPledge',10,1);
//not used for now
function addPledge($userId, $profileData, $socialId, $update)
{
  //apply_filters( 'wp_redirect', 'http://localhost:800/healthwise-facebook/?page_id=13#', 301  );
  //update_user_meta(1,'test',112233);
  echo '<script type="text/javascript">alert("hello");</script>';

  wp_set_current_user($userId, $user -> user_login);
  wp_set_auth_cookie($userId, true);

   /*$js = <<<JS
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
    echo $js;*/

  /*wp_register_script('my_amazing_script', get_template_directory_uri() . '/removeArrows.js', array('jquery'),'1.1', true);
    wp_enqueue_script('my_amazing_script');
  */
  /*global $post;
   update_user_meta(1,'test123', $post->ID);
  global $wpdb;
    $current_user = wp_get_current_user();
    $user=$current_user->ID;
    $x=$post;
    echo "<script>alert(".$user.$x.")</script>";
    if ($user != 0 && $post!=0) {
      //if a user is logged in insert him into the database
       echo "<script>alert('".$user.".".$post."')</script>";
        $wpdb->insert( 'wp_pledged_users',array(
        'user_id' => $user,
        'post_id' => $post)
        ,array('%d','%d'));
        $wpdb->show_errors();

      }*/}
    
//just to test
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




//changed the facebook login button to I PLEDGE
add_filter('the_champ_login_interface_filter', 'change_login_button',10,2);
function change_login_button($theChampLoginOptions, $widget)
{?>
  <style>
.btn1{
 background-color: black; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
}
.btn1:hover{
  opacity: 0.6;
}
</style>
  <?php
  global $theChampLoginOptions;
  $html = '';
   $widget = false;
    $html = the_champ_login_notifications($theChampLoginOptions);
    if(!$widget){
      $html .= '<div class="the_champ_outer_login_container">';
      if(isset($theChampLoginOptions['title']) && $theChampLoginOptions['title'] != ''){
        $html .= '<div class="the_champ_social_login_title">'. $theChampLoginOptions['title'] .'</div>';
      }
    }
    $html .= '<div class="the_champ_login_container"><ul class="the_champ_login_ul">';
    if(isset($theChampLoginOptions['providers']) && is_array($theChampLoginOptions['providers']) && count($theChampLoginOptions['providers']) > 0){
        foreach($theChampLoginOptions['providers'] as $provider){
          $html .= '<li><i class="btn1"';
          // id
          if( $provider == 'google' ){
            $html .= 'id="theChamp'. ucfirst($provider) .'Button" ';
          }
          // class
          $html .= 'class="theChampLogin theChamp'. ucfirst($provider) .'Background theChamp'. ucfirst($provider) .'Login" ';
          $html .= 'alt="Login with ';
          $html .= ucfirst($provider);
          $html .= '" title="Login with ';
          $html .= ucfirst($provider);
          if(current_filter() == 'comment_form_top' || current_filter() == 'comment_form_must_log_in_after'){
             $html .= '" onclick="theChampCommentFormLogin = true; theChampInitiateLogin(this)" >';
          }else{
              $html .= '" onclick="theChampInitiateLogin(this)" >';
          }
          $html .= '<div>I PLEDGE</div></i></li>';
        }
    }
    $html .= '</ul></div>';
    if(!$widget){
    $html .= '</div><div style="clear:both; margin-bottom: 6px"></div>';
    }
    return $html;
}
?>