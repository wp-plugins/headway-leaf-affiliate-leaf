<?php
/*
Plugin Name: Headway Leaf: Affiliate Leaf
Plugin URI: http://headwaythemes.com
Description: A leaf to help you promote Headway
Author: AJ Morris
Version: 1.0
Author URI: http://ajmorris.org
*/

function aff_leaf_options($leaf) {
	if($leaf['new']) {
		$leaf['config']['show-title'] = true;
	}
	
	HeadwayLeafsHelper::create_tabs(array('options' => 'Options', 'miscellaneous' => 'Miscellaneous'), $leaf['id']);
	
	//////
	
	HeadwayLeafsHelper::open_tab('options', $leaf['id']) ;
		
		$aff_options = array(
				'affiliate-box-opt-1' => 'Style 1',
				'affiliate-box-opt-2' => 'Style 2',
				'affiliate-box-opt-3' => 'Style 3',
				'affiliate-box-opt-4' => 'Style 4',
				'affiliate-box-opt-5' => 'Style 5'
			);
			
		HeadwayLeafsHelper::create_select(array(
			'name' => 'aff-select', 
			'value' => $leaf['options']['aff-select'], 
			'label' => 'Style Select', 
			'options' => $aff_options, 
			'no-border' => true), $leaf['id']);
		
				
	HeadwayLeafsHelper::close_tab();
	
	//////
	HeadwayLeafsHelper::open_tab('miscellaneous', $leaf['id']);
	
		HeadwayLeafsHelper::create_show_title_checkbox($leaf['id'], $leaf['config']['show-title']);
		HeadwayLeafsHelper::create_title_link_input($leaf['id'], $leaf['config']['leaf-title-link']);
		HeadwayLeafsHelper::create_classes_input($leaf['id'], $leaf['config']['custom-css-classes'], true);
		
	HeadwayLeafsHelper::close_tab();
	
}

function aff_leaf_content($leaf) {
	$plugin_url = WP_PLUGIN_URL.'/'.str_replace(basename(__FILE__), '', plugin_basename(__FILE__));
	
?>
  <?php echo '<div id="'.$leaf['options']['aff-select'].'">'; ?>
	  <h3><?php bloginfo('name'); ?> is powered by Headway</h3>
	  <a href="<?php echo headway_get_option('affiliate-link'); ?>"><?php echo '<img src="'.$plugin_url.'large_hw.png" width="300" height="250" alt="Get Headway Themes" />'; ?></a>
	  <p>The <a href="<?php echo headway_get_option('affiliate-link'); ?>">Headway WordPress theme framework</a> gives you total control over the appearance of your WordPress site <strong>without writing any code</strong>.</p>
	    <ul class="reasons">
	      <li>Create a color scheme "automatically" based on your header image colors with Headway's Quick Start Wizard</li>
	      <li>Headway's Visual Editor lets you build your site live and watch it happen</li>
	      <li>Everything managed easily via drag &amp; drop</li>
	      <li>Use, create & save your own style sets and templates to easily change the look of your site without code</li>
	      <li>Social media integration and search engine optimization built-in</li>
	      <li>Friendly Headway user community with active forums and outstanding support</li>
	      <li>"Plain English" documentation (including lots of screenshots and videos)</li>
	      <li>Automatic updates</li>
	      <li>100% GPL-compliant</li>
	    </ul>
	    <p>Headway lets you design your site your way. It's about control, not code.</p>
	    <p><a href="<?php echo headway_get_option('affiliate-link'); ?>">Check out Headway</a> now to see the full list of features and showcase gallery.</p>  
  </div>

<?
}

function add_my_stylesheet() {	
        $affStyleURL = WP_PLUGIN_URL.'/'.str_replace(basename(__FILE__), '', plugin_basename(__FILE__)) . 'styles.css';
        $affStyleFile = WP_PLUGIN_DIR.'/'.str_replace(basename(__FILE__), '', plugin_basename(__FILE__)) . 'styles.css';
        if ( file_exists($affStyleFile) ) {
            wp_register_style('affStyleSheets', $affStyleUrl);
            wp_enqueue_style( 'affStyleSheets');
        }
}

add_action('wp_print_styles', 'add_my_stylesheet');

function register_aff_leaf() {
	$options = array(
			'id' => 'affiliate-leaf',
			'name' => 'Affiliate Leaf',
			'options_callback' => 'aff_leaf_options',
			'content_callback' => 'aff_leaf_content'
	);
	
	if(class_exists('HeadwayLeaf')) $aff_leaf = new HeadwayLeaf($options);
	wp_enqueue_style('affStyleShtte', WP_PLUGIN_URL.'/'.str_replace(basename(__FILE__), '', plugin_basename(__FILE__)) . 'styles.css');
}

add_action('init', 'register_aff_leaf');
