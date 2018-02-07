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
        'singular_name' => __( 'pledge' ),
    'featured_image'        => __( 'Featured Image', 'text_domain' ),

      ),
      'public' => true,
      'has_archive' => true,
      'taxonomies'  => array( 'category' ),
      'supports' => array('title', 'editor', 'thumbnail')
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
  wp_set_current_user($userId, $user -> user_login);
  wp_set_auth_cookie($userId, true);
}


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




//sidebar
add_action( 'widgets_init', 'my_register_sidebars' );

function my_register_sidebars() {

/* Register dynamic sidebar 'new_sidebar' */

    register_sidebar(
        array(
        'id' => 'new_sidebar',
        'name' => __( 'New Sidebar' ),
        'description' => __( 'A short description of the sidebar.' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    )
    );

/* Repeat the code pattern above for additional sidebars. */

}
function hello_count($count)
  {
     echo "<script>
     document.getElementById('links').innerHTML = $count+1
     </script>";
  }

  function km_get_user_role( $user = null ) {
  $user = $user ? new WP_User( $user ) : wp_get_current_user();
  return $user->roles ? $user->roles[0] : false;
}