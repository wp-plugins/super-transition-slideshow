=== Super transition slideshow ===
Contributors: Gopi.R 
Donate link: http://gopi.coolpage.biz/demo/2009/09/06/super-transition-slideshow/
Author URI: http://gopi.coolpage.biz/demo/about/
Plugin URI: http://gopi.coolpage.biz/demo/2009/09/06/super-transition-slideshow/
Tags: image, slide show, slideshow, gallery, images, widget, translucent, translucent image, imagegallery, sidebar,Transitional
Requires at least: 2.8
Tested up to: 2.8.4
Stable tag: 1.0
	
Don't just display images, showcase them in style using this Super transition slideshow plugin. Randomly chosen 
Transitional effects in IE browsers.

== Description ==

**Dont forgot to check in IE browser!!!!!!!!!!.**

[Live Demo](http://gopi.coolpage.biz/demo/2009/09/06/super-transition-slideshow/)	
[More info](http://gopi.coolpage.biz/demo/2009/09/06/super-transition-slideshow/)				
[Comments/Suggestion](http://gopi.coolpage.biz/demo/2009/09/06/super-transition-slideshow/)		
[About author](http://gopi.coolpage.biz/demo/about/)			

Don't just display images, showcase them in style using this Super transition slideshow plugin.
This is an image slideshow that brings each image into view using 1 of 15 randomly chosen 
Transitional effects in IE browsers. For other browsers that don't support these built in effects, 
a custom fade transition is used instead!

1. Simple, simple, simple.  
2. Easy installation.  
3. Lovable transition effect on IE beowser & simple fade transition in other browser.

We can use this plug-in in two different way.  
1. Go to widget menu and drag and drop the "Super transition slideshow" widget to your sidebar location. or   
2. Copy and past the below mentioned code to your desired template location.   

<code> <?php if (function_exists (sts_show)) sts_show(); ?> </code> 

**Upload your images to below folder**  
wp-content/plugins/super-transition-slideshow/images/ 
		
See the live demo definitely you like to use!	

[Demo](http://gopi.coolpage.biz/demo/2009/09/06/super-transition-slideshow/)	
[To see my more plugin](http://gopi.coolpage.biz/demo/category/plug-in/)	

Note : To best view all image should be in same size, because this plugin not generate any thumnail to display. 
If you have different size images see FAQ question 2 or visit plugin site for more info.
	
== Installation ==

**Installation Instruction & Configuration**  

*   Unpack the *.zip file and extract the /super-transition-slideshow/ folder.    
*   Drop the 'super-transition-slideshow' folder into your 'wp-content/plugins' folder    
*   In word press administration panels, click on plug-in from the menu.    
*   You should see your new 'Super transition slideshow' plug-in listed under Inactive plug-in tab.    
*   To turn the word presses plug-in on, click activate.    
*   Go to widget link under Appearance tab, Drag & drop 'Super transition slideshow' 
widget to your desired location in the active sidebar or use mentioned code in the desired template location.     

== Frequently Asked Questions ==

**How to arrange the width & height of the slideshow?**  
1. This plug-in will not create any thumbnail of the image.  
2. To change or use the fixed width take "super-transition-slideshow.js" file from plug-in directory and go to line 63 and fix the width, see below.  
<code> slideHTML+='<img src="'+this.imagearray[index][0]+'" />'  </code>
to  
<code> slideHTML+='<img width="200" height="200" src="'+this.imagearray[index][0]+'" />'  </code>
3. And take the "super-transition-slideshow.css" css file from same directory and set the width to "sts_class" class.   
See plugin website, if about code not display properly.
 
  
**How to change the slide delay time**  
Go to 'Super transition slideshow' link under SETTING tab to change these settings.  
  
**Where to upload my image?**  
wp-content/plugins/super-transition-slideshow/images/ 
also you can chage the location via 'Super transition slideshow' setting link.  

**how the slide show manages the order?**  
The file names are returned in the order in which they are stored by the file system.

**More doubt?**  
Please contact.  
[Contact](http://gopi.coolpage.biz/demo/2009/09/06/super-transition-slideshow/)	

== Screenshots ==

1. front page screen.

2. admin screen.

== Changelog ==

1.0		
first version