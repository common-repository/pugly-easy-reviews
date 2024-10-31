<?php
/**
 * Plugin Name: Pugly Easy Reviews
 * Plugin URI: 
 * Description: Easily showcase reviews on your site in an interactive panel!
 * Version: 1.0.3
 * Author: Pugly Team
 * Author URI:
 */

function pugly_reviews_create_menu() {
	add_menu_page('Pugly Reviews', 'Pugly Reviews', 'administrator', __FILE__, 'pugly_reviews_settings_page' , 'dashicons-star-empty', 12);
	add_action( 'admin_init', 'register_pugly_reviews_settings' );
}
add_action('admin_menu', 'pugly_reviews_create_menu');

function register_pugly_reviews_settings() {
	register_setting( 'pugly-reviews-settings-group', 'pugly_reviewstextcolor');
	register_setting( 'pugly-reviews-settings-group', 'pugly_reviewsbackgroundcolor');
	register_setting( 'pugly-reviews-settings-group', 'pugly_reviewspositionh');
	register_setting( 'pugly-reviews-settings-group', 'pugly_reviewscodehtml');
}

function pugly_reviews_front_enqueue()
{
	wp_register_script( 'pugly-reviews-front-review-script', plugin_dir_url( __FILE__ ) . '/js/review-front.js', array('jquery'), '3.5.1', true );
	wp_enqueue_script( 'pugly-reviews-front-review-script' );
	
    wp_register_style( 'pugly-reviews-front-styles', plugin_dir_url( __FILE__ ) . '/css/front-styles.css' );
	wp_enqueue_style( 'pugly-reviews-front-styles' );
	
    wp_register_style( 'pugly-reviews-front-font', 'https://fonts.googleapis.com/css2?family=Open+Sans&display=swap' );
	wp_enqueue_style( 'pugly-reviews-front-font' );
	
    wp_register_style( 'pugly-reviews-front-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'pugly-reviews-front-fontawesome' );
}
 
add_action( 'wp_enqueue_scripts', 'pugly_reviews_front_enqueue' );

function pugly_reviews_admin_enqueue()
{
	wp_register_script( 'pugly-reviews-admin-color', plugin_dir_url( __FILE__ ) . '/js/jscolor.js', array(), 'null', true );
	wp_enqueue_script( 'pugly-reviews-admin-color' );
	
	wp_register_script( 'pugly-reviews-admin-script', plugin_dir_url( __FILE__ ) . '/js/review-admin.js', array('jquery'), '3.5.1', true );
	wp_enqueue_script( 'pugly-reviews-admin-script' );
	
    wp_register_style( 'pugly-reviews-admin-stylesheet', plugin_dir_url( __FILE__ ) . '/css/admin-styles.css' );
	wp_enqueue_style( 'pugly-reviews-admin-stylesheet' );
	
    wp_register_style( 'pugly-reviews-admin-font', 'https://fonts.googleapis.com/css2?family=Open+Sans&display=swap' );
	wp_enqueue_style( 'pugly-reviews-admin-font' );
	
    wp_register_style( 'pugly-reviews-admin-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'pugly-reviews-admin-fontawesome' );
}
 
add_action( 'admin_enqueue_scripts', 'pugly_reviews_admin_enqueue' );

function pugly_reviews_settings_page() {
?>
<form method="post" action="options.php">
    <?php settings_fields( 'pugly-reviews-settings-group' ); ?>
    <?php do_settings_sections( 'pugly-reviews-settings-group' ); ?>
	
	<textarea name="pugly_reviewscodehtml" id="pugly_reviewscode" style="display:none;">
		<?php $puglyreviewssource = get_option('pugly_reviewscodehtml');
		echo esc_html($puglyreviewssource); ?>
	</textarea>
	
	<div class="pugreviews-reviews">
		<p style="text-align:center;">Insert a review or click on a review to edit</p>
		<div class="pugreviews-insertreview pugreviews-inlinetoolbtn" style="margin:auto; display:block; text-align:center;"><i class="fa fa-plus"></i> Insert New Review</div>
		<div class="pugreviews-reviewsave">
			<?php $puglyreviewssource = get_option('pugly_reviewscodehtml');
					$arr = array(
					'div' => array(
						'class' => array(),
						'style'  => array(),
					),
					'i' => array(
						'class' => array(),
						'style'  => array(),
					),
				);
			echo wp_kses( $puglyreviewssource, $arr ); ?>
		</div>
	</div>

	<div class="pugreviews-settings">
		<div class="pugreviews-toolup pugreviews-inlinetoolbtn"><i class="fa fa-long-arrow-up"></i></div>
		<div class="pugreviews-tooldown pugreviews-inlinetoolbtn"><i class="fa fa-long-arrow-down"></i></div>
		<div class="pugreviews-delete pugreviews-inlinetoolbtn"><i class="fa fa-trash-o"></i></div>
		<label>Review Text</label>
		<textarea class="pugreviews-setting-text"></textarea>
		<label>Reviewer Name / Location</label>
		<textarea class="pugreviews-setting-name"></textarea>
	</div>

	<div class="pugreviews-submitbutton">
		<label style="display:block;">Text Color</label>
		<input name="pugly_reviewstextcolor" id="pugly_reviewstextcolor" style="width:165px; border:1px solid #8c8f94;" value="<?php $puglyreviewstextcolor = get_option('pugly_reviewstextcolor'); if (empty($puglyreviewstextcolor)) { echo '#ffffff'; } else { echo esc_attr($puglyreviewstextcolor); } ?>" data-jscolor="{mode:'HSV', position:'right'}">
		<label style="display:block;">Background Color</label>
		<input name="pugly_reviewsbackgroundcolor" id="pugly_reviewsbackgroundcolor" style="width:165px; border:1px solid #8c8f94;" value="<?php $puglyreviewsbackgroundcolor = get_option('pugly_reviewsbackgroundcolor'); if (empty($puglyreviewsbackgroundcolor)) { echo '#005ba1'; } else { echo esc_attr($puglyreviewsbackgroundcolor); } ?>" data-jscolor="{mode:'HSV', position:'right'}">
		<label style="display:block;">Screen Position</label>
		<select style="width:100%; margin-bottom:10px;" name="pugly_reviewspositionh" id="pugly_reviewspositionh">
			<option value="left" <?php $puglyreviewspositionh = get_option('pugly_reviewspositionh'); if ($puglyreviewspositionh == 'left') { echo "selected"; } ?>>left</option>
			<option value="right" <?php $puglyreviewspositionh = get_option('pugly_reviewspositionh'); if ($puglyreviewspositionh == 'right') { echo "selected"; } ?>>right</option>
		</select>
		<?php submit_button(); ?>
	</div>
</form>
<?php }

function puglyreviews_rootcss() {
   ?>
	<style>
	:root {
		--pugbackgroundcolor: <?php $puglyreviewsbackgroundcolor = get_option('pugly_reviewsbackgroundcolor'); if (empty($puglyreviewsbackgroundcolor)) { echo '#005ba1'; } else { echo esc_attr($puglyreviewsbackgroundcolor); } ?>;
		--pugtextcolor: <?php $puglyreviewstextcolor = get_option('pugly_reviewstextcolor'); if (empty($puglyreviewstextcolor)) { echo '#ffffff'; } else { echo esc_attr($puglyreviewstextcolor); } ?>;
	}
	.pugreviews-button {
		bottom: 20px;
		<?php $puglyreviewspositionh = get_option('pugly_reviewspositionh'); if (empty($puglyreviewspositionh)) { echo 'left'; } else { echo esc_attr($puglyreviewspositionh); } ?>: 20px;
	}
	.pugreviews-reviews {
		bottom: 20px;
		<?php $puglyreviewspositionh = get_option('pugly_reviewspositionh'); if (empty($puglyreviewspositionh)) { echo 'left'; } else { echo esc_attr($puglyreviewspositionh); } ?>: 20px;
	}
	</style>
	
	<div class="pugreviews-button">
		<div class="pugreviews-button-inner">
			<i class="fa fa-star pugreviews-spin"></i><i class="fa fa-star pugreviews-spin"></i><i class="fa fa-star pugreviews-spin"></i><i class="fa fa-star pugreviews-spin"></i><i class="fa fa-star pugreviews-spin"></i> Read Reviews
		</div>
		<div class="pugreviews-review-inner">
			<div class="pugreviews-stars">
			<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
			</div>
			<div class="pugreviews-review-holder">
			<?php $puglyreviewssource = get_option('pugly_reviewscodehtml');
					$arr = array(
					'div' => array(
						'class' => array(),
						'style'  => array(),
					),
					'i' => array(
						'class' => array(),
						'style'  => array(),
					),
				);
			echo wp_kses( $puglyreviewssource, $arr ); ?>
			</div>
			<div class="pugreviews-innerbutton pugreviews-closebutton" style="margin-right:10px;"><i class="fa fa-close"></i></div><div class="pugreviews-innerbutton pugreviews-nextbutton">Next <i class="fa fa-long-arrow-right"></i></div>
		</div>
	</div>
   <?php
}
add_action('wp_head', 'puglyreviews_rootcss');