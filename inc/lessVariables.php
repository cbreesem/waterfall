<?php

class my_less extends lessc {
	private $defaultVars = array();
	function __construct(){
		parent::__construct();

		// 图片文件路径
		define('CSS_IMAGES_PATH', get_template_directory_uri()."/images/");
		$this->colorSchemesArr = array('al_pacino', 'blue_sky', 'dark_night', 'black_and_white', 'pinkman', 'space', 'grey_clouds', 'almond_milk', 'clear_white', 'sakura', 'mighty_slate', 'retro_orange');
	}

	public function loadDefaults(){
		$scheme_vars = array();
		$colorScheme = $this->getCurrentColorScheme();
		// 载入默认颜色设定
		require_once( get_template_directory() . "/inc/colors/default.php");
		if(!in_array($colorScheme, $this->colorSchemesArr)) $colorScheme = "blue_sky";
		// 载入设定的颜色设定
		require_once( get_template_directory() . "/inc/colors/{$colorScheme}.php" );
		// load custom variables you want to override
		require_once( get_template_directory() . '/res/less/extend/custom_scheme_vars.php' );
		$this->defaultVars = $scheme_vars;
	}

	public static function getCurrentColorScheme(){
		$colorScheme = isset($_SESSION['color_scheme']) ? $_SESSION['color_scheme'] : get_option('wf_color_scheme');
		return $colorScheme;
	}


	function my_less_vars( $vars, $handle ) {
		$this->loadDefaults();
		$vars = $this->defaultVars;
		$vars[ 'plutoFolderPath' ] = "'".get_template_directory_uri()."'";
		$vars[ 'imagesPath' ] = "'".get_template_directory_uri()."/res/img'";
		$vars[ 'fontsPath' ] = "'".get_template_directory_uri()."/res/fonts'";
		$vars[ 'logoImageHeight' ] = $this->customOrDefault('logo_image_height', 'logoImageHeight', '40px');
		$vars[ 'topMenuLogoImageHeight' ] = $this->customOrDefault('top_menu_logo_image_height', 'topMenuLogoImageHeight', '20px');
		$vars[ 'fixedPostHeight' ] = '200px';

		if (get_option('logo_type') == 'text'){
			$vars[ 'logoFontSize' ] = $this->customOrDefault('logo_font_size', 'logoFontSize', '24px');
			$vars[ 'logoPadding' ] = '8px';
		}else{
			$vars[ 'logoFontSize' ] = '24px';
			$vars[ 'logoPadding' ] = '0px';
		}

		if(get_option('wf_no_limit_single_post_width') != true){
			if(get_option('wf_single_post_maximum_width')){
				$vars[ 'singlePostMaxWidth' ] = $this->add_px(get_option('wf_single_post_maximum_width'));
			}else{
				$vars[ 'singlePostMaxWidth' ] = '900px';
			}
		}else{
			$vars[ 'singlePostMaxWidth' ] = 'auto';
		}

		// COLUMNS
		// without sidebar menu left right
		$vars[ 'wosmlr_columns_992_1200' ]  = $this->customOrDefault('wosmlr_columns_992_1200', 'wosmlr_columns_992_1200', 2);
		$vars[ 'wosmlr_columns_1200_1600' ] = $this->customOrDefault('wosmlr_columns_1200_1600', 'wosmlr_columns_1200_1600', 3);
		$vars[ 'wosmlr_columns_1600_1750' ] = $this->customOrDefault('wosmlr_columns_1600_1750', 'wosmlr_columns_1600_1750', 4);
		$vars[ 'wosmlr_columns_1750_5000' ] = $this->customOrDefault('wosmlr_columns_1750_5000', 'wosmlr_columns_1750_5000', 5);

		// without sidebar menu top
		$vars[ 'wosmt_columns_768_992' ]   = $this->customOrDefault('wosmt_columns_768_992', 'wosmt_columns_768_992', 2);
		$vars[ 'wosmt_columns_992_1200' ]  = $this->customOrDefault('wosmt_columns_992_1200', 'wosmt_columns_992_1200', 3);
		$vars[ 'wosmt_columns_1200_1300' ] = $this->customOrDefault('wosmt_columns_1200_1300', 'wosmt_columns_1200_1300', 3);
		$vars[ 'wosmt_columns_1300_1600' ] = $this->customOrDefault('wosmt_columns_1300_1600', 'wosmt_columns_1300_1600', 4);
		$vars[ 'wosmt_columns_1600_5000' ] = $this->customOrDefault('wosmt_columns_1600_5000', 'wosmt_columns_1600_5000', 5);


		// with sidebar menu left right
		$vars[ 'wsmlr_columns_992_1600' ]  = $this->customOrDefault('wsmlr_columns_992_1600', 'wsmlr_columns_992_1600', 2);
		$vars[ 'wsmlr_columns_1600_1750' ] = $this->customOrDefault('wsmlr_columns_1600_1750', 'wsmlr_columns_1600_1750', 3);
		$vars[ 'wsmlr_columns_1750_5000' ] = $this->customOrDefault('wsmlr_columns_1750_5000', 'wsmlr_columns_1750_5000', 4);

		// with sidebar menu top
		$vars[ 'wsmt_columns_992_1300' ]  = $this->customOrDefault('wsmt_columns_992_1300', 'wsmt_columns_992_1300', 2);
		$vars[ 'wsmt_columns_1300_1600' ] = $this->customOrDefault('wsmt_columns_1300_1600', 'wsmt_columns_1300_1600', 3);
		$vars[ 'wsmt_columns_1600_1880' ] = $this->customOrDefault('wsmt_columns_1600_1880', 'wsmt_columns_1600_1880', 4);
		$vars[ 'wsmt_columns_1880_5000' ] = $this->customOrDefault('wsmt_columns_1880_5000', 'wsmt_columns_1880_5000', 5);

		// FONTS
		$vars[ 'baseFontSize' ]           = $this->add_px($this->customOrDefault('base_font_size' , 'baseFontSize'));
		$vars[ 'headingsBaseFontSize' ]   = $this->add_px($this->customOrDefault('headings_base_font_size' , 'headingsBaseFontSize'));
		$vars[ 'mainMenuFontSize' ]       = $this->add_px($this->customOrDefault('main_menu_font_size' , 'mainMenuFontSize'));
		$vars[ 'menuLogoFontSize' ]       = $this->add_px($this->customOrDefault('logo_font_size' , 'menuLogoFontSize'));

		$vars[ 'baseFontFamily' ]         = $this->customOrDefault('text_font_family' , 'baseFontFamily');
		$vars[ 'baseFontWeight' ]         = $this->customOrDefault('text_font_weight' , 'baseFontWeight');
		$vars[ 'headingsFontFamily' ]     = $this->customOrDefault('headings_font_family' , 'headingsFontFamily');
		$vars[ 'headingsFontWeight' ]     = $this->customOrDefault('headings_font_weight' , 'headingsFontWeight');
		$vars[ 'menuFontFamily' ]         = $this->customOrDefault('menu_font_family' , 'menuFontFamily');
		$vars[ 'menuFontWeight' ]         = $this->customOrDefault('menu_links_font_weight' , 'menuFontWeight');

		return $vars;
	}

	public function FunctionName($value=''){
			# code...
	}

	// Convert RGBA color to 6 digit HEX
	public function my_rgba_to_hex($rgba_arr){
		return "#".substr(parent::lib_rgbahex($rgba_arr), -6);
	}

	// Mix 2 colors
	public function my_mix($color1, $color2, $percent){
		return $this->my_rgba_to_hex(parent::lib_mix(array("list", ",", array( array("raw_color", $color1),  array("raw_color", $color2), array("number", $percent, "%")))));
	}


	function adjustBrightness($hex, $steps){
		$hex = str_replace('#','',$hex);
		// Steps should be between -255 and 255. Negative = darker, positive = lighter
		$steps = max(-255, min(255, $steps));

		// Format the hex color string
		$hex = str_replace('#', '', $hex);
		if (strlen($hex) == 3) {
				$hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
		}

		// Get decimal values
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));

		// Adjust number of steps and keep it inside 0 to 255
		$r = max(0,min(255,$r + $steps));
		$g = max(0,min(255,$g + $steps));
		$b = max(0,min(255,$b + $steps));

		$r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
		$g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
		$b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
		return '#'.$r_hex.$g_hex.$b_hex;
	}

	function getContrastYIQ($hexcolor, $dark='black', $light='white'){
		$r = hexdec(substr($hexcolor,0,2));
		$g = hexdec(substr($hexcolor,2,2));
		$b = hexdec(substr($hexcolor,4,2));
		$yiq = (($r*299)+($g*587)+($b*114))/1000;
		return ($yiq >= 128) ? $dark : $light;
	}
	/* 添加像素单位 */
	function add_px($value = '14')
	{
		$value = str_replace('px', '', $value);
		$value = $value.'px';
		return $value;
	}
	/* 载入自定义或默认值 */
	function customOrDefault($customKey, $defaultKey, $defaultValue='#aaa'){
		$optionValue = get_option($customKey);
		if(!empty($optionValue)){
			return $optionValue;
		}else{
			if(isset($this->defaultVars["{$defaultKey}"]))
				return $this->defaultVars["{$defaultKey}"];
			else
				return $defaultValue;
		}
	}

	function customOrDefaultImageUrl($customKey, $defaultKey, $defaultValue = 'none'){
		$option_value = get_field("{$customKey}", 'option');
		if(!empty($option_value)){
			return $this->wrap_in_url($option_value);
		}else{
			if(isset($this->defaultVars["{$defaultKey}"]))
				return $this->defaultVars["{$defaultKey}"];
			else
				return $defaultValue;
		}
	}

	public function wrap_in_url($value='none'){
		if($value == 'none'){
			return 'none';
		}else{
			return 'url('.$value.')';
		}
	}

	function custom_merged_or_default($customKey, $defaultKey, $merge_string, $defaultValue = "4px solid #fff"){
		$option_value = get_field("{$customKey}", 'option');
		if(!empty($option_value)){
			return $merge_string.$option_value;
		}else{
			if(isset($this->defaultVars["{$defaultKey}"]))
				return $this->defaultVars["{$defaultKey}"];
			else
				return $defaultValue;
		}
	}

	function adjust_custom_or_use_default($customKey, $defaultKey, $steps){
		$option_value = get_field("{$customKey}", 'option');
		if(!empty($option_value)){
			return $this->adjustBrightness($option_value, $steps);
		}else{
			return $this->defaultVars["{$defaultKey}"];
		}
	}

	function adjust_mix_custom_or_use_default($customKey, $defaultKey, $steps, $mix_color, $mix_value){
		$option_value = get_field("{$customKey}", 'option');
		if(!empty($option_value)){
			$adjusted_color = $this->adjustBrightness($option_value, $steps);
			$mixed_color = $this->my_mix($mix_color, $adjusted_color, $mix_value);
			return $mixed_color;
		}else{
			return $this->defaultVars["{$defaultKey}"];
		}
	}

}


// Hook to the ACF and set a variable to recompile a less css if options have been saved
function my_acf_save_post( $post_id ) {
	// stop function if not "options" page
	if( $post_id != "options" ) {
		return;
	}
	// Set a flag to recompile LESS on the next front end request.
	update_option( 'prefix_force_recompile', 'yes' );
}
// run after ACF saves the $_POST['fields'] data
// add_action('acf/save_post', 'my_acf_save_post', 20);

$my_less = new my_less;
// pass variables into all .less files
add_filter( 'less_vars', array($my_less, 'my_less_vars'), 10, 2 );

?>