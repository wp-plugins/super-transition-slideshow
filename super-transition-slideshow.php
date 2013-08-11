<?php

/*
Plugin Name: Super transition slideshow
Plugin URI: http://www.gopiplus.com/work/2010/07/18/super-transition-slideshow/
Description: Don't just display images, showcase them in style using this Super transition slideshow plugin. Randomly chosen 
Transitional effects in IE browsers.  
Author: Gopi.R
Version: 7.1
Author URI: http://www.gopiplus.com/work/2010/07/18/super-transition-slideshow/
Donate link: http://www.gopiplus.com/work/2010/07/18/super-transition-slideshow/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

function sts_show() 
{
	$sts = "";
	$sts_siteurl = get_option('siteurl');
	$sts_dir = get_option('sts_dir');
	$sts_pluginurl = $sts_siteurl . "/wp-content/plugins/super-transition-slideshow/";
	$sts_dirurl = $sts_siteurl . "/" . $sts_dir ;
	
	$sts_dirhandle = opendir($sts_dir);
	while ($sts_file = readdir($sts_dirhandle)) 
	{
	  if(!is_dir($sts_file) && (strpos($sts_file, '.jpg')>0 or strpos($sts_file, '.gif')>0 or strpos($sts_file, '.JPG')>0 or strpos($sts_file, '.GIF')>0))
	  {
		$sts = $sts . '["'.$sts_dirurl . $sts_file.'", "", "", ""],';
	  }
	}
	closedir($sts_dirhandle);
	$sts = substr($sts,0,(strlen($sts)-1));
	?>
	<link rel='stylesheet' href='<?php echo $sts_pluginurl; ?>super-transition-slideshow.css' type='text/css' />
    <script type="text/javascript">

	var flashyshow=new super_transition_slideshow({ 
		wrapperid: "sts_slideshow", 
		wrapperclass: "sts_class", 
		imagearray: [
			<?php echo $sts; ?>
		],
		pause: <?php echo get_option('sts_pause'); ?>, 
		transduration: <?php echo get_option('sts_transduration'); ?> 
	})
	
	</script>
    <?php
}

add_shortcode( 'super-slideshow', 'sts_shortcode' );

function sts_shortcode( $atts ) 
{
	global $wpdb;
	$sts_return = "";
	$sts = "";
	
	//$scode = $matches[1];
	//[SUPER-SLIDESHOW:TYPE=DIR1]
	
	//[super-slideshow dir="DIR1"]
	if ( ! is_array( $atts ) ) { return 'Short code not valid'; }
	$sts_type = $atts['dir'];
	
	$sts_type = strtoupper($sts_type);

	$sts_pause = get_option('sts_pause');
	$sts_transduration = get_option('sts_transduration');
	
	if(!is_numeric($sts_pause)){ $sts_pause =2000;	}
	if(!is_numeric($sts_transduration)){ $sts_transduration = 3000; }
	
	//list($sts_type_main) = split("[:.-]", $scode);
	//list($sts_type_cap, $sts_type) = split('[=.-]', $sts_type_main);
	
	if($sts_type == "DIR1")
	{
		$sts_dir = get_option('sts_dir_1');
	}
	else if($sts_type == "DIR2")
	{
		$sts_dir = get_option('sts_dir_2');
	}
	else if($sts_type == "DIR3")
	{
		$sts_dir = get_option('sts_dir_3');
	}
	else if($sts_type == "DIR4")
	{
		$sts_dir = get_option('sts_dir_4');
	}
	else
	{
		$sts_dir = get_option('sts_dir');
	}
	
	$sts_siteurl = get_option('siteurl');
	$sts_pluginurl = $sts_siteurl . "/wp-content/plugins/super-transition-slideshow/";
	$sts_dirurl = $sts_siteurl . "/" . $sts_dir ;
	
	if($sts_dir == "")
	{
		return 'Short code not valid';
	}
	
	if(is_dir($sts_dir))
	{
		$sts_dirhandle = opendir($sts_dir);
		while ($sts_file = readdir($sts_dirhandle)) 
		{
		  if(!is_dir($sts_file) && (strpos($sts_file, '.jpg')>0 or strpos($sts_file, '.gif')>0 or strpos($sts_file, '.JPG')>0 or strpos($sts_file, '.GIF')>0))
		  {
			$sts = $sts . '["'.$sts_dirurl . $sts_file.'", "", "", ""],';
		  }
		}
		closedir($sts_dirhandle);
		$sts = substr($sts,0,(strlen($sts)-1));
	
		$sts_return = $sts_return . "<link rel='stylesheet' href='".$sts_pluginurl."super-transition-slideshow.css' type='text/css' />";
		$sts_return = $sts_return . "<script type='text/javascript' src='".$sts_pluginurl."super-transition-slideshow.js'></script>";
		$sts_return = $sts_return . "<script type='text/javascript'>";
	
		$sts_return = $sts_return . "var flashyshow=new super_transition_slideshow({ ";
			$sts_return = $sts_return . "wrapperid: 'sts_slideshow_".$sts_type."', ";
			$sts_return = $sts_return . "wrapperclass: 'sts_clas', ";
			$sts_return = $sts_return . "imagearray: [";
				$sts_return = $sts_return . $sts;
			$sts_return = $sts_return . "],";
			$sts_return = $sts_return . "pause: ".$sts_pause." , ";
			$sts_return = $sts_return . "transduration: ".$sts_transduration." ";
		$sts_return = $sts_return . "})";
		$sts_return = $sts_return . "</script>";
	}
	else
	{
		$sts_return = "Folder not found<br />" . $sts_dir;
	}
	return $sts_return;
}

function sts_install() 
{
	add_option('sts_title', "Slideshow");
	add_option('sts_dir', "wp-content/plugins/super-transition-slideshow/images/");
	add_option('sts_title_yes', "YES");
	add_option('sts_pause', "2000");
	add_option('sts_transduration', "1000");
	add_option('sts_dir_1', "");
	add_option('sts_dir_2', "");
	add_option('sts_dir_3', "");
	add_option('sts_dir_4', "");
}

function sts_widget($args) 
{
	extract($args);
	if(get_option('sts_title_yes') == "YES") 
	{
		echo $before_widget . $before_title;
		echo get_option('sts_title');
		echo $after_title;
	}
	else
	{
		echo '<div style="padding-top:5px;padding-bottom:5px;">';
	}
	sts_show();
	if(get_option('sts_title_yes') == "YES") 
	{
		echo $after_widget;
	}
	else
	{
		echo '</div>';
	}
}

function sts_admin_option() 
{
	global $wpdb;
	?>
	<div class="wrap">
	  <div class="form-wrap">
		<div id="icon-edit" class="icon32"></div>
		<h2>Super transition slideshow</h2>
		<?php
		$sts_title = get_option('sts_title');
		$sts_dir = get_option('sts_dir');
		$sts_title_yes = get_option('sts_title_yes');
		$sts_pause = get_option('sts_pause');
		$sts_transduration = get_option('sts_transduration');
		$sts_dir_1 = get_option('sts_dir_1');
		$sts_dir_2 = get_option('sts_dir_2');
		$sts_dir_3 = get_option('sts_dir_3');
		$sts_dir_4 = get_option('sts_dir_4');
		if (isset($_POST['sts_form_submit']) && $_POST['sts_form_submit'] == 'yes')
		{
			check_admin_referer('sts_form_setting');
			$sts_title = stripslashes($_POST['sts_title']);
			$sts_dir = stripslashes($_POST['sts_dir']);
			$sts_title_yes = stripslashes($_POST['sts_title_yes']);
			$sts_pause = stripslashes($_POST['sts_pause']);
			$sts_transduration = stripslashes($_POST['sts_transduration']);
			$sts_dir_1 = stripslashes($_POST['sts_dir_1']);
			$sts_dir_2 = stripslashes($_POST['sts_dir_2']);
			$sts_dir_3 = stripslashes($_POST['sts_dir_3']);
			$sts_dir_4 = stripslashes($_POST['sts_dir_4']);
			update_option('sts_title', $sts_title );
			update_option('sts_dir', $sts_dir );
			update_option('sts_title_yes', $sts_title_yes );
			update_option('sts_pause', $sts_pause );
			update_option('sts_transduration', $sts_transduration );
			update_option('sts_dir_1', $sts_dir_1 );
			update_option('sts_dir_2', $sts_dir_2 );
			update_option('sts_dir_3', $sts_dir_3 );
			update_option('sts_dir_4', $sts_dir_4 );
			?>
			<div class="updated fade">
				<p><strong>Details successfully updated.</strong></p>
			</div>
			<?php
		}
		?>
		<form name="sts_form" method="post" action="">
		    <h3>Widget setting</h3>
			
			<label for="tag-width">Widget title</label>
			<input name="sts_title" type="text" value="<?php echo $sts_title; ?>"  id="sts_title" size="50" maxlength="150">
			<p>Please enter your widget title.</p>
			
			<label for="tag-width">Pause</label>
			<input name="sts_pause" type="text" value="<?php echo $sts_pause; ?>"  id="sts_pause" maxlength="4">
			<p>Pause between slideshow in millisec. (Example: 1000)</p>
			
			<label for="tag-width">Transduration</label>
			<input name="sts_transduration" type="text" value="<?php echo $sts_transduration; ?>"  id="sts_transduration" maxlength="4">
			<p>Please enter duration of transition. (Example: 2000)</p>
			
			<label for="tag-width">Display sidebar title</label>
			<select name="sts_title_yes" id="sts_title_yes">
				<option value='YES' <?php if($sts_title_yes == 'YES') { echo "selected='selected'" ; } ?>>YES</option>
				<option value='NO' <?php if($sts_title_yes == 'NO') { echo "selected='selected'" ; } ?>>NO</option>
			</select>
			<p>Please select YES to display title on sidebar.</p>
			
			<label for="tag-width">Image directory (Default for widget)</label>
			<input name="sts_dir" type="text" value="<?php echo $sts_dir; ?>"  id="sts_dir" size="100" maxlength="500">
			<p>Short code for thos directory: [super-slideshow dir="dir0"]</p>
			
			<label for="tag-width">Image directory 1</label>
			<input name="sts_dir_1" type="text" value="<?php echo $sts_dir_1; ?>"  id="sts_dir_1" size="100" maxlength="500">
			<p>Short code for thos directory: [super-slideshow dir="dir1"]</p>
			
			<label for="tag-width">Image directory 2</label>
			<input name="sts_dir_2" type="text" value="<?php echo $sts_dir_2; ?>"  id="sts_dir_2" size="100" maxlength="500">
			<p>Short code for thos directory: [super-slideshow dir="dir2"]</p>
			
			<label for="tag-width">Image directory 3</label>
			<input name="sts_dir_3" type="text" value="<?php echo $sts_dir_3; ?>"  id="sts_dir_3" size="100" maxlength="500">
			<p>Short code for thos directory: [super-slideshow dir="dir3"]</p>
			
			<label for="tag-width">Image directory 4</label>
			<input name="sts_dir_4" type="text" value="<?php echo $sts_dir_4; ?>"  id="sts_dir_4" size="100" maxlength="500">
			<p>Short code for thos directory: [super-slideshow dir="dir3"]</p>
			
			<div style="height:10px;"></div>
			<input name="sts_submit" id="sts_submit" class="button" value="Submit" type="submit" />&nbsp;
			<a class="button" target="_blank" href="http://www.gopiplus.com/work/2010/07/18/vertical-scroll-recent-post/">Help</a>
			<input type="hidden" name="sts_form_submit" value="yes"/>
			<?php wp_nonce_field('sts_form_setting'); ?>
		</form>
		</div>
		<h3>Plugin configuration option</h3>
		<ol>
			<li>Add directly in to the theme using PHP code.</li>
			<li>Drag and drop the widget to your sidebar.</li>
			<li>Add into specific post or page using short code.</li>
		</ol>
	  <p class="description">Check official website for more information <a target="_blank" href="http://www.gopiplus.com/work/2010/07/18/super-transition-slideshow/">click here</a></p>
	</div>
	<?php
}

function sts_control()
{
	echo '<p>Super transition slideshow.<br> To change the setting goto <b>Super transition slideshow</b> link on <b>Settings</b> menu.';
	echo ' <a href="options-general.php?page=super-transition-slideshow">click here</a></p>';
	?>
	check official website for live demo and more information  <a target="_blank" href='http://www.gopiplus.com/work/2010/07/18/super-transition-slideshow/'>click here</a><br> 
	<?php
}

function sts_widget_init() 
{
	if(function_exists('wp_register_sidebar_widget')) 	
	{
		wp_register_sidebar_widget('Super-transition-slideshow', 'Super transition slideshow', 'sts_widget');
	}
	
	if(function_exists('wp_register_widget_control')) 	
	{
		wp_register_widget_control('Super-transition-slideshow', array('Super transition slideshow', 'widgets'), 'sts_control');
	} 
}

function sts_deactivation() 
{
	// No action required.	
}

function sts_add_to_menu() 
{
	add_options_page('Super transition slideshow', 'Super transition slideshow', 'manage_options', 'super-transition-slideshow', 'sts_admin_option' );
}

if (is_admin()) 
{
	add_action('admin_menu', 'sts_add_to_menu');
}

function sts_add_javascript_files() 
{
	if (!is_admin())
	{
		wp_enqueue_script( 'super-transition-slideshow', get_option('siteurl').'/wp-content/plugins/super-transition-slideshow/super-transition-slideshow.js');
	}	
}

add_action('init', 'sts_add_javascript_files');
add_action("plugins_loaded", "sts_widget_init");
register_activation_hook(__FILE__, 'sts_install');
register_deactivation_hook(__FILE__, 'sts_deactivation');
add_action('init', 'sts_widget_init');
?>