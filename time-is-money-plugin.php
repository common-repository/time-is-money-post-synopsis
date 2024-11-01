<?php
/*
Plugin Name: Time is Money Post Synopsis
Plugin URI: http://fixthisface.com/
Description: Please note that this is a beta version. Time is Money Post Synopsis Plugin - This plugin gives the blogger the option to present readers with a synopsized version of their posts. For long posts the author may realize that readers will not want to read the entire post, and might prefer a synopsis. The synopsis may contain a brief version of the article/post, or may contain a bulleted list of the main points within the article or post.

We've all written a few posts that we know readers don't want to dig through for information. Only so much info can go in the introductory paragraph - a bulleted synopsis is often the best solution.

When you add a post synopsis to a particular post (by giving it a custom field called 'timps' and entering the key points of the post) the synopsis will be displayed in the Time is Money Plugin Widget (which is usually placed in the sidebar of your blog) on each of the posts that have a synopsis.

The author/admin will have the option to write the synopsis form scratch, or simple use the post's pre-existing excerpt (if it has one) .
Author: fixthisface.com
Version: 0.1.2
Author URI: http://fixthisface.com/
*/

/*  Copyright 2010  Fix This Face  (email : info@fixthisface.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/////////////////////////////   The code for the actual widget part   \\\\\\\\\\\\\\\\\\\\\\\\\\\\
//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
function timps_widget() {
	global $post;
	
	$post_id = $post->ID;
	
	//echo"<h2>Time Is Money widget</h2></a>";
	$return = "<p><strong>";
	$stored_synopsis = get_post_meta( $post_id, 'timps' ); //grab the 
	 if ( ! empty( $stored_synopsis ) )
	 {
	 	echo "<h3>Time is Money Post Synopsis</h3>";
	 	foreach( $stored_synopsis as $synopsis )
	 	{
        	$return .= $synopsis . '<br> ';
        }
        $return .= "</strong></p>";
        echo $return;
     }
     else
     {
     	//echo "No Post Synopsis for this post";
     }
}
 
function init_timps(){
	register_sidebar_widget("Time Is Money Post Synopsis", "timps_widget");     
}

add_action("plugins_loaded", "init_timps"); //This bit adds runs the init_timps function when the site loads all plugins


//////////////// The components of the plugin that allow it to show up in the ADMIN section of the site \\\\\\\\\\\\\
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Add the Time is Money menu option to the settings menu in the WP backend
function mt_add_pages() {
    // Add a new submenu under Options:
    add_options_page('Time is Money', 'Time is Money', 'administrator', 'testoptions', 'mt_options_page');
    }

// mt_options_page() displays the page content for the Test Options submenu
function mt_options_page() {
    echo "<h2>Options for the Time Is Money Plugin</h2>";
    echo "<p>You can change these options to customize the Funtionality of the plugin</p>";
    echo "<h3>Instructions</h3>";
    echo "<p>In order to use the plugin start by adding the widget to your site (perhaps in the sidebar) Then simply edit one of your posts and add a Custom Field called 'timps' Into this field type the synopsis of your post. When viewers of your site view a post that has a timps value (the synopsis) will be shows in the widget.</p>";
}
add_action('admin_menu', 'mt_add_pages'); //this bit runs the function above, tells WP to put in the menu item when it loads the admin menu

//This chunk modifies the screen where you edit a post, it should (evenutllay) add a way for them to insert a nice numbered list
function mt_timps_editor() {
    // Add a new submenu under Options:
    //add_options_page('Time is Money', 'Time is Money', 'administrator', 'testoptions', 'mt_options_page');
    echo '<div id="postexcerpt" class="postbox " >';
    echo '<div class="handlediv" title="Click to toggle"><br /></div><h3 class=\'hndle\'><span>Time is Money Post Synopsis</span></h3>';

    
    echo "<p> This is where we should put in the option to type out the post synopsis nicely";
    echo "</div>";
    echo "</div>";
}
add_action('edit_form_advanced', 'mt_timps_editor'); //when WordPress loads the edit post page it will run our mt_timps_editor function

?>