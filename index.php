<?php 
/*
 Plugin Name: VW Personal Trainer Pro Posttype
 lugin URI: https://www.vwthemes.com/
 Description: Creating new post type for VW Personal Trainer Pro Theme.
 Author: VW Themes
 Version: 1.0
 Author URI: https://www.vwthemes.com/
*/

define( 'VW_PERSONAL_TRAINER_PRO_POSTTYPE_VERSION', '1.0' );
add_action( 'init', 'vw_personal_trainer_pro_posttype_create_post_type' );
add_action( 'init', 'coursescategory');

function vw_personal_trainer_pro_posttype_create_post_type() {

  register_post_type( 'courses',
    array(
        'labels' => array(
            'name' => __( 'Courses','vw-personal-trainer-pro-posttype' ),
            'singular_name' => __( 'Courses','vw-personal-trainer-pro-posttype' )
        ),
        'capability_type' =>  'post',
        'menu_icon'  => 'dashicons-welcome-learn-more',
        'public' => true,
        'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'page-attributes',
        'comments'
        )
    )
  );
  
  register_post_type( 'testimonials',
    array(
      'labels' => array(
        'name' => __( 'Testimonial','vw-personal-trainer-pro-posttype' ),
        'singular_name' => __( 'Testimonial','vw-personal-trainer-pro-posttype' )
      ),
      'capability_type' => 'post',
      'menu_icon'  => 'dashicons-businessman',
      'public' => true,
      'supports' => array(
        'title',
        'editor',
        'thumbnail'
      )
    )
  );
  register_post_type( 'trainers',
    array(
      'labels' => array(
        'name' => __( 'Trainers','vw-personal-trainer-pro-posttype' ),
        'singular_name' => __( 'Trainers','vw-personal-trainer-pro-posttype' )
      ),
        'capability_type' => 'post',
        'menu_icon'  => 'dashicons-businessman',
        'public' => true,
        'supports' => array( 
          'title',
          'editor',
          'thumbnail'
      )
    )
  );
}

// ------------------ courses --------------------


function coursescategory() {
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => __( 'Categories', 'vw-personal-trainer-pro-posttype' ),
    'singular_name'     => __( 'Categories', 'vw-personal-trainer-pro-posttype' ),
    'search_items'      => __( 'Search cats', 'vw-personal-trainer-pro-posttype' ),
    'all_items'         => __( 'All Categories', 'vw-personal-trainer-pro-posttype' ),
    'parent_item'       => __( 'Parent Categories', 'vw-personal-trainer-pro-posttype' ),
    'parent_item_colon' => __( 'Parent Categories:', 'vw-personal-trainer-pro-posttype' ),
    'edit_item'         => __( 'Edit Categories', 'vw-personal-trainer-pro-posttype' ),
    'update_item'       => __( 'Update Categories', 'vw-personal-trainer-pro-posttype' ),
    'add_new_item'      => __( 'Add New Categories', 'vw-personal-trainer-pro-posttype' ),
    'new_item_name'     => __( 'New Categories Name', 'vw-personal-trainer-pro-posttype' ),
    'menu_name'         => __( 'Categories', 'vw-personal-trainer-pro-posttype' ),
  );
  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'coursescategory' ),
  );
  register_taxonomy( 'coursescategory', array( 'courses' ), $args );
}

function vw_personal_trainer_pro_posttype_bn_courses_meta() {
    add_meta_box( 'vw_personal_trainer_pro_posttype_bn_meta', __( 'Enter Courses Details','vw-personal-trainer-pro-posttype' ), 'vw_personal_trainer_pro_posttype_bn_meta_courses', 'courses', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'vw_personal_trainer_pro_posttype_bn_courses_meta');
}
/* Adds a meta box for custom post */
function vw_personal_trainer_pro_posttype_bn_meta_courses( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'vw_personal_trainer_pro_posttype_bn_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );
    $class_price = get_post_meta( $post->ID, 'meta-class-price', true );
    $class_size = get_post_meta( $post->ID, 'meta-class-size', true );
    $class_duration = get_post_meta( $post->ID, 'meta-class-durations', true );
    $class_instuctor = get_post_meta( $post->ID, 'meta-class-instructor', true );
    $class_time = get_post_meta( $post->ID, 'meta-class_time', true );
    ?>
    <div id="courses_custom_stuff">
        <table id="list-table">         
            <tbody id="the-list" data-wp-lists="list:meta">
                <tr id="meta-1">
                  <td class="left">
                      <?php esc_html_e( 'Price', 'vw-personal-trainer-pro-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="number" name="meta-class-price" id="meta-class-price" value="<?php echo esc_html($class_price); ?>" />
                  </td>
                </tr> 
                <tr id="meta-2">
                  <td class="left">
                    <?php esc_html_e( 'No Of Seats', 'vw-personal-trainer-pro-posttype' )?>
                  </td>
                  <td class="left" >
                     <input type="text" name="meta-class-size" id="meta-class-size" value="<?php echo esc_html($class_size); ?>" />
                  </td>
                </tr>
                <tr id="meta-3">
                    <td class="left">
                        <?php esc_html_e( 'Duration', 'vw-personal-trainer-pro-posttype' )?>
                    </td>
                    <td class="left" >
                        <input type="text" name="meta-class-durations" id="meta-class-durations" value="<?php echo esc_html($class_duration); ?>" />
                    </td>
                </tr>              
                <tr id="meta-4">
                    <td class="left">
                        <?php esc_html_e( 'Instructor', 'vw-personal-trainer-pro-posttype' )?>
                    </td>
                    <td class="left" >
                        <input type="text" name="meta-class-instructor" id="meta-class-instructor" value="<?php echo esc_html($class_instuctor); ?>" />
                    </td>
                </tr> 
                <tr id="meta-6">
                    <td class="left">
                        <?php esc_html_e( 'Class Time', 'vw-personal-trainer-pro-posttype' )?>
                    </td>
                    <td class="left" >
                        <input type="text" name="meta-class_time" id="meta-class_time" value="<?php echo esc_html($class_time); ?>" />
                    </td>
                </tr>     
            </tbody>
        </table>
    </div>
    <?php
}
/* Saves the custom fields meta input */
function vw_personal_trainer_pro_posttype_bn_metadesig_courses_save( $post_id ) {
  
    if( isset( $_POST[ 'meta-class-price' ] ) ) {
        update_post_meta( $post_id, 'meta-class-price', sanitize_text_field($_POST[ 'meta-class-price' ]) );
    }
    
    if( isset( $_POST[ 'meta-class-size' ] ) ) {
        update_post_meta( $post_id, 'meta-class-size', sanitize_text_field($_POST[ 'meta-class-size' ]) );
    }
    if( isset( $_POST[ 'meta-class-durations' ] ) ) {
        update_post_meta( $post_id, 'meta-class-durations', sanitize_text_field($_POST[ 'meta-class-durations' ]) );
    }
    if( isset( $_POST[ 'meta-class-instructor' ] ) ) {
        update_post_meta( $post_id, 'meta-class-instructor', sanitize_text_field($_POST[ 'meta-class-instructor' ]) );
    }
    if( isset( $_POST[ 'meta-class_time' ] ) ) {
        update_post_meta( $post_id, 'meta-class_time', sanitize_text_field($_POST[ 'meta-class_time' ]) );
    }
    
}
add_action( 'save_post', 'vw_personal_trainer_pro_posttype_bn_metadesig_courses_save' );

/* courses shortcode */
function vw_personal_trainer_pro_posttype_courses_func( $atts ) {
  $courses = '';
  $courses = '<div class="row all-courses">';
  $query = new WP_Query( array( 'post_type' => 'courses') );

    if ( $query->have_posts() ) :

  $k=1;
  $new = new WP_Query('post_type=courses');
  while ($new->have_posts()) : $new->the_post();

        $post_id = get_the_ID();
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'large' );
        if(has_post_thumbnail()) { $thumb_url = $thumb['0']; }
        $url = $thumb['0'];
        $custom_url ='';
        $excerpt = wp_trim_words(get_the_excerpt(),10);
        $size= get_post_meta($post_id,'meta-class-size',true);
        $duration= get_post_meta($post_id,'meta-class-durations',true);
        $time= get_post_meta($post_id,'meta-class_time',true);
        $price= get_post_meta($post_id,'meta-class-price',true);
        
        if(get_post_meta($post_id,'meta-courses-url',true !='')){$custom_url =get_post_meta($post_id,'meta-courses-url',true); } else{ $custom_url = get_permalink(); }
        $courses .= '

            <div class="col-lg-6 col-md-6 our_courses_outer">
              <div class="row hover_border">
                <div class="col-lg-6 courses-img-box">
                  <img class="courses-img" src="'.esc_url($thumb_url).'" alt="attorney-thumbnail" />
                </div>
                <div class="col-lg-6">
                  <h4><a href="'.esc_url($custom_url).'">'.esc_html(get_the_title()) .'</a></h4>
                  <div class="short_text">'.$excerpt.'</div>
                  <div class="course-meta">
                    <span>
                      <i class="far fa-calendar-alt"></i>
                      '.$duration.'
                    </span>
                    <span>
                      <i class="fas fa-user"></i>
                      '.$size.'
                    </span>
                    <span>
                      <i class="far fa-clock"></i>
                      '.$time.'
                    </span>
                  </div>
                </div>
              </div>
            </div>';
    if($k%2 == 0){
      $courses.= '<div class="clearfix"></div>';
    }
      $k++;
  endwhile;
  else :
    $courses = '<h2 class="center">'.esc_html__('Post Not Found','vw_personal_trainer_pro_posttype').'</h2>';
  endif;
  return $courses;
}

add_shortcode( 'vw-personal-trainer-courses', 'vw_personal_trainer_pro_posttype_courses_func' );



/*---------------------------------- Testimonial section -------------------------------------*/
/* Adds a meta box to the Testimonial editing screen */
function vw_personal_trainer_pro_posttype_bn_testimonial_meta_box() {
  add_meta_box( 'vw-personal-trainer-pro-posttype-testimonial-meta', __( 'Enter Details', 'vw-personal-trainer-pro-posttype' ), 'vw_personal_trainer_pro_posttype_bn_testimonial_meta_callback', 'testimonials', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'vw_personal_trainer_pro_posttype_bn_testimonial_meta_box');
}

/* Adds a meta box for custom post */
function vw_personal_trainer_pro_posttype_bn_testimonial_meta_callback( $post ) {
  wp_nonce_field( basename( __FILE__ ), 'vw_personal_trainer_pro_posttype_posttype_testimonial_meta_nonce' );
  $bn_stored_meta = get_post_meta( $post->ID );
  $desigstory = get_post_meta( $post->ID, 'vw_personal_trainer_pro_posttype_testimonial_desigstory', true );
  ?>
  <div id="testimonials_custom_stuff">
    <table id="list">
      <tbody id="the-list" data-wp-lists="list:meta">
        <tr id="meta-1">
          <td class="left">
            <?php _e( 'Designation', 'vw-personal-trainer-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="vw_personal_trainer_pro_posttype_testimonial_desigstory" id="vw_personal_trainer_pro_posttype_testimonial_desigstory" value="<?php echo esc_attr( $desigstory ); ?>" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <?php
}

/* Saves the custom meta input */
function vw_personal_trainer_pro_posttype_bn_metadesig_save( $post_id ) {
  if (!isset($_POST['vw_personal_trainer_pro_posttype_posttype_testimonial_meta_nonce']) || !wp_verify_nonce($_POST['vw_personal_trainer_pro_posttype_posttype_testimonial_meta_nonce'], basename(__FILE__))) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  // Save desig.
  if( isset( $_POST[ 'vw_personal_trainer_pro_posttype_testimonial_desigstory' ] ) ) {
    update_post_meta( $post_id, 'vw_personal_trainer_pro_posttype_testimonial_desigstory', sanitize_text_field($_POST[ 'vw_personal_trainer_pro_posttype_testimonial_desigstory']) );
  }

}

add_action( 'save_post', 'vw_personal_trainer_pro_posttype_bn_metadesig_save' );

/*---------------------------------- testimonials shortcode --------------------------------------*/
function vw_personal_trainer_pro_posttype_testimonial_func( $atts ) {
  $testimonial = '';
  $testimonial = '<div class="row all-testimonial">';
  $query = new WP_Query( array( 'post_type' => 'testimonials') );

    if ( $query->have_posts() ) :

  $k=1;
  $new = new WP_Query('post_type=testimonials');
  while ($new->have_posts()) : $new->the_post();

        $post_id = get_the_ID();
         $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'large' );
        if(has_post_thumbnail()) { $thumb_url = $thumb['0']; }
        $url = $thumb['0'];
        $custom_url ='';
        
        $excerpt = wp_trim_words(get_the_excerpt(),25);
        $tdegignation= get_post_meta($post_id,'vw_personal_trainer_pro_posttype_testimonial_desigstory',true);
        if(get_post_meta($post_id,'meta-testimonial-url',true !='')){$custom_url =get_post_meta($post_id,'meta-testimonial-url',true); } else{ $custom_url = get_permalink(); }
        $testimonial .= '

            <div class="our_testimonial_outer col-lg-4 col-md-4 col-sm-6">
              <div class="testimonial_inner">
                <div class="row hover_border">
                  <div class="col-md-12">
                     <img class="classes-img" src="'.esc_url($thumb_url).'" alt="attorney-thumbnail" />
                    <h4><a href="'.esc_url($custom_url).'">'.esc_html(get_the_title()) .'</a></h4>
                    <div class="tdesig">'.$tdegignation.'</div>
                    <div class="short_text">'.$excerpt.'</div>
                  </div>
                </div>
              </div>
            </div>';
    if($k%2 == 0){
      $testimonial.= '<div class="clearfix"></div>';
    }
      $k++;
  endwhile;
  else :
    $testimonial = '<h2 class="center">'.esc_html__('Post Not Found','vw_personal_trainer_pro_posttype').'</h2>';
  endif;
  return $testimonial;
}

add_shortcode( 'vw-personal-trainer-testimonials', 'vw_personal_trainer_pro_posttype_testimonial_func' );

/*-------------------------------------- Teacher-------------------------------------------*/
/* Adds a meta box for Designation */
function vw_personal_trainer_pro_posttype_bn_trainers_meta() {
    add_meta_box( 'vw_personal_trainer_pro_posttype_bn_meta', __( 'Enter Details','vw-personal-trainer-pro-posttype' ), 'vw_personal_trainer_pro_posttype_ex_bn_meta_callback', 'trainers', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'vw_personal_trainer_pro_posttype_bn_trainers_meta');
}
/* Adds a meta box for custom post */
function vw_personal_trainer_pro_posttype_ex_bn_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'vw_personal_trainer_pro_posttype_bn_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );
    $teacher_email = get_post_meta( $post->ID, 'meta-teacher-email', true );
    $teacher_phone = get_post_meta( $post->ID, 'meta-teacher-phone', true );
    $teacher_facebook = get_post_meta( $post->ID, 'meta-tfacebookurl', true );
    $teacher_linkedin = get_post_meta( $post->ID, 'meta-tlinkdenurl', true );
    $teacher_twitter = get_post_meta( $post->ID, 'meta-ttwitterurl', true );
    $teacher_gplus = get_post_meta( $post->ID, 'meta-tgoogleplusurl', true );
    $teacher_desig = get_post_meta( $post->ID, 'meta-designation', true );
    $teacher_instagram = get_post_meta( $post->ID, 'meta-tinstagram', true );
    $teacher_pinterest = get_post_meta( $post->ID, 'meta-pinterest', true );
    ?>
  
    <div id="agent_custom_stuff">
        <table id="list-table">         
            <tbody id="the-list" data-wp-lists="list:meta">
                <tr id="meta-1">
                  <td class="left">
                      <?php _e( 'Email', 'vw-personal-trainer-pro-posttype' )?>
                  </td>
                  <td class="left" >
                      <input type="text" name="meta-teacher-email" id="meta-teacher-email" value="<?php echo esc_html($teacher_email); ?>" />
                  </td>
                </tr>
                <tr id="meta-1">
                  <td class="left">
                      <?php _e( 'Phone', 'vw-personal-trainer-pro-posttype' )?>
                  </td>
                  <td class="left" >
                      <input type="text" name="meta-teacher-phone" id="meta-teacher-phone" value="<?php echo esc_html($teacher_phone); ?>" />
                  </td>
                </tr>
                <tr id="meta-3">
                  <td class="left">
                    <?php _e( 'Facebook Url', 'vw-personal-trainer-pro-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-tfacebookurl" id="meta-tfacebookurl" value="<?php echo esc_html($teacher_facebook); ?>" />
                  </td>
                </tr>
                <tr id="meta-4">
                  <td class="left">
                    <?php _e( 'Linkedin Url', 'vw-personal-trainer-pro-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-tlinkdenurl" id="meta-tlinkdenurl" value="<?php echo esc_html($teacher_linkedin); ?>" />
                  </td>
                </tr>
                <tr id="meta-5">
                  <td class="left">
                    <?php _e( 'Twitter Url', 'vw-personal-trainer-pro-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-ttwitterurl" id="meta-ttwitterurl" value="<?php echo esc_html($teacher_twitter); ?>" />
                  </td>
                </tr>
                <tr id="meta-6">
                  <td class="left">
                    <?php _e( 'GooglePlus Url', 'vw-personal-trainer-pro-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-tgoogleplusurl" id="meta-tgoogleplusurl" value="<?php echo esc_html($teacher_gplus); ?>" />
                  </td>
                </tr>
                <tr id="meta-7">
                  <td class="left">
                    <?php _e( 'Instagram Url', 'vw-personal-trainer-pro-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-tinstagram" id="meta-tinstagram" value="<?php echo esc_html($teacher_instagram); ?>" />
                  </td>
                </tr>
                <tr id="meta-8">
                  <td class="left">
                    <?php _e( 'Pinterest Url', 'vw-personal-trainer-pro-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-pinterest" id="meta-pinterest" value="<?php echo esc_html($teacher_pinterest); ?>" />
                  </td>
                </tr>
                <tr id="meta-9">
                  <td class="left">
                    <?php _e( 'Designation', 'vw-personal-trainer-pro-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="text" name="meta-designation" id="meta-designation" value="<?php echo esc_html($teacher_desig); ?>" />
                  </td>
                </tr>

            </tbody>
        </table>
    </div>
    <?php
}
/* Saves the custom Designation meta input */
function vw_personal_trainer_pro_posttype_ex_bn_metadesig_save( $post_id ) {

  
    if( isset( $_POST[ 'meta-teacher-email' ] ) ) {
        update_post_meta( $post_id, 'meta-teacher-email', esc_html($_POST[ 'meta-teacher-email' ]) );
    }
    if( isset( $_POST[ 'meta-teacher-phone' ] ) ) {
        update_post_meta( $post_id, 'meta-teacher-phone', esc_html($_POST[ 'meta-teacher-phone' ]) );
    }
    
    // Save facebookurl
    if( isset( $_POST[ 'meta-tfacebookurl' ] ) ) {
        update_post_meta( $post_id, 'meta-tfacebookurl', esc_url($_POST[ 'meta-tfacebookurl' ]) );
    }
    // Save linkdenurl
    if( isset( $_POST[ 'meta-tlinkdenurl' ] ) ) {
        update_post_meta( $post_id, 'meta-tlinkdenurl', esc_url($_POST[ 'meta-tlinkdenurl' ]) );
    }
    if( isset( $_POST[ 'meta-ttwitterurl' ] ) ) {
        update_post_meta( $post_id, 'meta-ttwitterurl', esc_url($_POST[ 'meta-ttwitterurl' ]) );
    }
    // Save googleplusurl
    if( isset( $_POST[ 'meta-tgoogleplusurl' ] ) ) {
        update_post_meta( $post_id, 'meta-tgoogleplusurl', esc_url($_POST[ 'meta-tgoogleplusurl' ]) );
    }

    // Save Instagram
    if( isset( $_POST[ 'meta-tinstagram' ] ) ) {
        update_post_meta( $post_id, 'meta-tinstagram', esc_url($_POST[ 'meta-tinstagram' ]) );
    }

    // Save Pinterest
    if( isset( $_POST[ 'meta-pinterest' ] ) ) {
        update_post_meta( $post_id, 'meta-pinterest', esc_url($_POST[ 'meta-pinterest' ]) );
    }
    // Save designation
    if( isset( $_POST[ 'meta-designation' ] ) ) {
        update_post_meta( $post_id, 'meta-designation', esc_html($_POST[ 'meta-designation' ]) );
    }
}
add_action( 'save_post', 'vw_personal_trainer_pro_posttype_ex_bn_metadesig_save' );

add_action( 'save_post', 'bn_meta_save' );
/* Saves the custom meta input */
function bn_meta_save( $post_id ) {
  if( isset( $_POST[ 'vw_personal_trainer_pro_posttype_trainers_featured' ] )) {
      update_post_meta( $post_id, 'vw_personal_trainer_pro_posttype_trainers_featured', esc_attr(1));
  }else{
    update_post_meta( $post_id, 'vw_personal_trainer_pro_posttype_trainers_featured', esc_attr(0));
  }
}
/*------------------------------------- SHORTCODES -------------------------------------*/

/*------------------------------------- trainers Shorthcode -------------------------------------*/
function vw_personal_trainer_pro_posttype_trainers_func( $atts ) {
  $trainers = '';
  $trainers = '<div class="row all-trainers">';
  $query = new WP_Query( array( 'post_type' => 'trainers') );

    if ( $query->have_posts() ) :

  $k=1;
  $new = new WP_Query('post_type=trainers');
  while ($new->have_posts()) : $new->the_post();
        $post_id = get_the_ID();
         $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'large' );
        if(has_post_thumbnail()) { $thumb_url = $thumb['0']; }
        $url = $thumb['0'];
        $custom_url ='';
        $excerpt = wp_trim_words(get_the_excerpt(),10);
        $trainers_desig= get_post_meta($post_id,'meta-designation',true);
        $facebookurl= get_post_meta($post_id,'meta-tfacebookurl',true);
        $linkedin=get_post_meta($post_id,'meta-tlinkdenurl',true);
        $twitter=get_post_meta($post_id,'meta-ttwitterurl',true);
        $googleplus=get_post_meta($post_id,'meta-tgoogleplusurl',true);
        if(get_post_meta($post_id,'meta-trainers-url',true !='')){$custom_url =get_post_meta($post_id,'meta-trainers-url',true); } else{ $custom_url = get_permalink(); }
        $trainers .= '

            <div class="our_trainers_outer col-lg-6 col-md-6 col-sm-6">
              <div class="trainers_inner">
                <div class="row hover_border">
                  <div class="col-lg-4 col-md-4">
                    <img class="classes-img" src="'.esc_url($thumb_url).'" alt="attorney-thumbnail" />
                  </div>
                  <div class="col-lg-8 col-md-8"> 
                    <h4><a href="'.esc_url($custom_url).'">'.esc_html(get_the_title()) .'</a></h4>
                    <p class="tdesig">'.$trainers_desig.'</p>
                    <div class="short_text">'.$excerpt.'</div>
                    <div class="att_socialbox">';
                        if($facebookurl != ''){
                          $trainers .= '<a class="" href="'.esc_url($facebookurl).'" target="_blank"><i class="fab fa-facebook-f"></i></a>';
                        } if($twitter != ''){
                          $trainers .= '<a class="" href="'.esc_url($twitter).'" target="_blank"><i class="fab fa-twitter"></i></a>';
                        } if($googleplus != ''){
                          $trainers .= '<a class="" href="'.esc_url($googleplus).'" target="_blank"><i class="fab fa-google-plus-g"></i></a>';
                        } if($linkedin != ''){
                          $trainers .= '<a class="" href="'.esc_url($linkedin).'" target="_blank"><i class="fab fa-linkedin-in"></i></a>';
                        }
                      $trainers .= '</div>
                  </div>
                </div>
              </div>
            </div>';
    if($k%2 == 0){
      $trainers.= '<div class="clearfix"></div>';
    }
      $k++;
  endwhile;
  else :
    $trainers = '<h2 class="center">'.esc_html__('Post Not Found','vw_personal_trainer_pro_posttype').'</h2>';
  endif;
  return $trainers;
}

add_shortcode( 'vw-personal-trainer-trainers', 'vw_personal_trainer_pro_posttype_trainers_func' );
