<?php

/*
Plugin Name: Super transition slideshow
Plugin URI: http://gopi.coolpage.biz/demo/2009/09/06/super-transition-slideshow/
Description: Don't just display images, showcase them in style using this Super transition slideshow plugin. Randomly chosen 
Transitional effects in IE browsers.  
Author: Gopi.R
Version: 1.0
Author URI: http://gopi.coolpage.biz/demo/about/
Donate link: http://gopi.coolpage.biz/demo/2009/09/06/super-transition-slideshow/
*/

function sts_show() 
{
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
	$sts = substr($sts,0,(strlen($sts)-1));
	?>
	<link rel='stylesheet' href='<?php echo $sts_pluginurl; ?>super-transition-slideshow.css' type='text/css' />
    <script type="text/javascript" src="<?php echo $sts_pluginurl; ?>super-transition-slideshow.js"></script>
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

function sts_install() 
{
	add_option('sts_title', "Slideshow");
	add_option('sts_dir', "wp-content/plugins/super-transition-slideshow/images/");
	add_option('sts_title_yes', "YES");
	add_option('sts_pause', "2000");
	add_option('sts_transduration', "1000");
}

function sts_widget($args) 
{
	extract($args);
	echo $before_widget . $before_title;
	if(get_option('sts_title_yes') == "YES") 
	{
		echo get_option('sts_title');
	}
	echo $after_title;
	sts_show();
	echo $after_widget;
}

function sts_admin_option() 
{
	include_once("extra.php");
	echo "<div class='wrap'>";
	echo "<h2>"; 
	echo wp_specialchars( "Super transition slideshow" ) ;
	echo "</h2>";
    
	$sts_title = get_option('sts_title');
	$sts_dir = get_option('sts_dir');
	$sts_title_yes = get_option('sts_title_yes');
	$sts_pause = get_option('sts_pause');
	$sts_transduration = get_option('sts_transduration');
	
	
	if ($_POST['sts_submit']) 
	{
		$sts_title = stripslashes($_POST['sts_title']);
		$sts_dir = stripslashes($_POST['sts_dir']);
		$sts_title_yes = stripslashes($_POST['sts_title_yes']);
		$sts_pause = stripslashes($_POST['sts_pause']);
		$sts_transduration = stripslashes($_POST['sts_transduration']);
		
		
		update_option('sts_title', $sts_title );
		update_option('sts_dir', $sts_dir );
		update_option('sts_title_yes', $sts_title_yes );
		update_option('sts_pause', $sts_pause );
		update_option('sts_transduration', $sts_transduration );
	}
	?>
	<form name="form_sts" method="post" action="">
	<table width="100%" border="0" cellspacing="0" cellpadding="3"><tr><td align="left">
	<?php
	echo '<p>Title:<br><input  style="width: 450px;" maxlength="200" type="text" value="';
	echo $sts_title . '" name="sts_title" id="sts_title" /></p>';
	echo '<p>Pause:<br><input  style="width: 100px;" maxlength="4" type="text" value="';
	echo $sts_pause . '" name="sts_pause" id="sts_pause" />Only Number / Pause between content change (millisec)</p>';
	echo '<p>Transduration:<br><input  style="width: 100px;" maxlength="4" type="text" value="';
	echo $sts_transduration . '" name="sts_transduration" id="sts_transduration" />Only Number / Duration of transition (affects only IE users)</p>';
	echo '<p>Display Sidebar Title:<br><input maxlength="3" style="width: 100px;" type="text" value="';
	echo $sts_title_yes . '" name="sts_title_yes" id="sts_title_yes" />(YES/NO)</p>';
	echo '<p>Image directory:<br><input  style="width: 550px;" type="text" value="';
	echo $sts_dir . '" name="sts_dir" id="sts_dir" /></p>';
	echo '<p>Default Image directory:<br>wp-content/plugins/super-transition-slideshow/images/</p>';
	echo '<input name="sts_submit" id="sts_submit" class="button-primary" value="Submit" type="submit" />';
	?>
	</td><td align="center" valign="middle"> <?php if (function_exists (timepass)) timepass(); ?> </td></tr></table>
	</form>
    <hr />
    We can use this plug-in in two different way.<br />
	1.	Go to widget menu and drag and drop the "Super transition slideshow" widget to your sidebar location. or <br />
	2.	Copy and past the below mentioned code to your desired template location.

    <h2><?php echo wp_specialchars( 'Paste the below code to your desired template location!' ); ?></h2>
    <div style="padding-top:7px;padding-bottom:7px;">
    <code style="padding:7px;">
    &lt;?php if (function_exists (sts_show)) sts_show(); ?&gt;
    </code></div>
    <h2><?php echo wp_specialchars( 'About Plugin' ); ?></h2>
	
    Plug-in created by <a target="_blank" href='http://gopi.coolpage.biz/demo/about/'>Gopi</a>. || 
    <a target="_blank" href='http://gopi.coolpage.biz/demo/2009/09/06/super-transition-slideshow/'>click here</a> to post suggestion or comments or how to improve this plugin. || 
    <a target="_blank" href='http://gopi.coolpage.biz/demo/2009/09/06/super-transition-slideshow/'>click here</a> to see LIVE demo. || 
    <a target="_blank" href='http://gopi.coolpage.biz/demo/2009/09/06/super-transition-slideshow/'>click here</a> 
    To download my other plugins. || 
    Clicking the above ad will not affect the site, to remove the ad simply remove this "timepass()" function from page!!<br><br>
	<p style="color:#990000;">
	1. This plug-in will not create any thumbnail of the image.<br>
	2. To change or use the fixed width take "super-transition-slideshow.js" file from plug-in directory and go to line 63 and fix the width, see below.<br>
	<code>
	slideHTML+='&lt;img src=&quot;'+this.imagearray[index][0]+'&quot; /&gt;'<br>
	to<br>
	slideHTML+='&lt;img width=&quot;200&quot; HEIGHT=&quot;150&quot; src=&quot;'+this.imagearray[index][0]+'&quot; /&gt;'</code><br>
	3. And take the "super-transition-slideshow.css" css file from same directory and set the width to "sts_class" class.<br>
	4. in default am using 200 X 150 size images <a target="_blank" href='http://gopi.coolpage.biz/demo/2009/09/06/super-transition-slideshow/'>LIVE DEMO</a>.<br>
    <br></p>
	<?php
	echo "</div>";
}

function sts_control()
{
	echo '<p>Super transition slideshow.<br> To change the setting goto Super transition slideshow link under SETTING tab.';
	echo ' <a href="options-general.php?page=super-transition-slideshow/super-transition-slideshow.php">';
	echo 'click here</a></p>';
}

function sts_widget_init() 
{
  	register_sidebar_widget(__('Super transition slideshow'), 'sts_widget');   
	
	if(function_exists('register_sidebar_widget')) 	
	{
		register_sidebar_widget('Super transition slideshow', 'sts_widget');
	}
	
	if(function_exists('register_widget_control')) 	
	{
		register_widget_control(array('Super transition slideshow', 'widgets'), 'sts_control',400,400);
	} 
}

function sts_deactivation() 
{
	delete_option('sts_title');
	delete_option('sts_dir');
	delete_option('sts_title_yes');
	delete_option('sts_pause');
	delete_option('sts_transduration');
}

function sts_add_to_menu() 
{
	add_options_page('Super transition slideshow', 'Super transition slideshow', 7, __FILE__, 'sts_admin_option' );
}

add_action('admin_menu', 'sts_add_to_menu');
add_action("plugins_loaded", "sts_widget_init");
register_activation_hook(__FILE__, 'sts_install');
register_deactivation_hook(__FILE__, 'sts_deactivation');
add_action('init', 'sts_widget_init');
?>
