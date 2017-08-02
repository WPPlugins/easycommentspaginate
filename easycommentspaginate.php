<?php
/*
Plugin Name: easyCommentsPaginate
Plugin URI: http://www.mushtitude.com
Description: easyCommentsPaginate is a plugin to easily create an animated javascript pagination of your comments. You can choose the animation type, texts etc via the <a href="options-general.php?page=easycommentspaginate/easycommentspaginate.php">the settings page</a>
Version: 1.1.1
Author: st3ph
Author URI: http://www.mushtitude.com
License: GPL2
*/

/*  
	Copyright 2011 easyCommentsPaginate (email : st3phh@gmail.com)

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

register_activation_hook( __FILE__, 'easycommentspaginate_activate' );
add_action('admin_menu', 'easycommentspaginate_menu');
load_plugin_textdomain('easycommentspaginate', plugins_url().'/easycommentspaginate/langs/');

function easycommentspaginate_activate() {
    update_option('easycommentspaginate_paginateContainer', '.commentlist');
    update_option('easycommentspaginate_paginateElement', 'li');    
    update_option('easycommentspaginate_hashPage', 'page');
    update_option('easycommentspaginate_elementsPerPage', '5');
    update_option('easycommentspaginate_effect', 'default');
    update_option('easycommentspaginate_slideOffset', '200');
    update_option('easycommentspaginate_firstButton', 1);
    update_option('easycommentspaginate_firstButtonText', __('&laquo;'));
    update_option('easycommentspaginate_lastButton', 1);
    update_option('easycommentspaginate_lastButtonText', __('&raquo;'));
    update_option('easycommentspaginate_prevButton', 1);
    update_option('easycommentspaginate_prevButtonText', __('&lsaquo;'));
    update_option('easycommentspaginate_nextButton', 1);
    update_option('easycommentspaginate_nextButtonText', __('&rsaquo;'));
    update_option('easycommentspaginate_custom_css', '.easyCommentsPaginateWrapper {}');
}

function easycommentspaginate_menu() {
	add_options_page('ECP Options', 'ECP Options', 'manage_options', __FILE__, 'easycommentspaginate_options');	
}

function easycommentspaginate_options() {
    if(isset($_POST['easycommentspaginate_update'])) {
        check_admin_referer('easycommentspaginate_update_page');
        if(isset($_POST['easycommentspaginate_paginateContainer'])) {
            update_option('easycommentspaginate_paginateContainer', $_POST['easycommentspaginate_paginateContainer']);
        }
        if(isset($_POST['easycommentspaginate_paginateElement'])) {
            update_option('easycommentspaginate_paginateElement', $_POST['easycommentspaginate_paginateElement']);
        }
        if(isset($_POST['easycommentspaginate_hashPage'])) {
            update_option('easycommentspaginate_hashPage', $_POST['easycommentspaginate_hashPage']);
        }
        if(isset($_POST['easycommentspaginate_elementsPerPage'])) {
            update_option('easycommentspaginate_elementsPerPage', $_POST['easycommentspaginate_elementsPerPage']);
        }
        if(isset($_POST['easycommentspaginate_effect'])) {
            update_option('easycommentspaginate_effect', $_POST['easycommentspaginate_effect']);
        }
        if(isset($_POST['easycommentspaginate_slideOffset'])) {
            update_option('easycommentspaginate_slideOffset', $_POST['easycommentspaginate_slideOffset']);
        }
        //if(isset($_POST['easycommentspaginate_firstButton'])) {
            update_option('easycommentspaginate_firstButton', $_POST['easycommentspaginate_firstButton']);
        //}
        if(isset($_POST['easycommentspaginate_firstButtonText'])) {
            update_option('easycommentspaginate_firstButtonText', $_POST['easycommentspaginate_firstButtonText']);
        }
        //if(isset($_POST['easycommentspaginate_lastButton'])) {
            update_option('easycommentspaginate_lastButton', $_POST['easycommentspaginate_lastButton']);
        //}
        if(isset($_POST['easycommentspaginate_lastButtonText'])) {
            update_option('easycommentspaginate_lastButtonText', $_POST['easycommentspaginate_lastButtonText']);
        }
        //if(isset($_POST['easycommentspaginate_prevButton'])) {
            update_option('easycommentspaginate_prevButton', $_POST['easycommentspaginate_prevButton']);
        //}
        if(isset($_POST['easycommentspaginate_prevButtonText'])) {
            update_option('easycommentspaginate_prevButtonText', $_POST['easycommentspaginate_prevButtonText']);
        }
        //if(isset($_POST['easycommentspaginate_nextButton'])) {
            update_option('easycommentspaginate_nextButton', $_POST['easycommentspaginate_nextButton']);
        //}
        if(isset($_POST['easycommentspaginate_nextButtonText'])) {
            update_option('easycommentspaginate_nextButtonText', $_POST['easycommentspaginate_nextButtonText']);
        }
        update_option('easycommentspaginate_custom_css', $_POST['easycommentspaginate_custom_css']);
        update_option('easycommentspaginate_test_mode', $_POST['easycommentspaginate_test_mode']);
        echo "<div class='updated fade'><p><strong>Options saved</strong></p></div>";
    }
	
	?>
	<div class="wrap">
		<h2>easyCommentsPaginate : Settings page</h2>
		<form method="post" action="options-general.php?page=easycommentspaginate/easycommentspaginate.php">
			<?php wp_nonce_field('easycommentspaginate_update_page'); ?>
			<table class="form-table">
				<tr valign="top">
				<th scope="row"><?php _e('DOM comments container');?></th>
					<td><input type="text" name="easycommentspaginate_paginateContainer" value="<?php echo get_option('easycommentspaginate_paginateContainer'); ?>" style="width:400px" /></td>
				</tr>
				<th scope="row"><?php _e('DOM elements to paginate');?></th>
                    <td><input type="text" name="easycommentspaginate_paginateElement" value="<?php echo get_option('easycommentspaginate_paginateElement'); ?>" style="width:400px" /></td>
                </tr>
                <th scope="row"><?php _e('Hash tag to direct access a page (without the #)');?></th>
                    <td><input type="text" name="easycommentspaginate_hashPage" value="<?php echo get_option('easycommentspaginate_hashPage'); ?>" style="width:400px" /></td>
                </tr>
                <th scope="row"><?php _e('Comments per page');?></th>
                    <td><input type="text" name="easycommentspaginate_elementsPerPage" value="<?php echo get_option('easycommentspaginate_elementsPerPage'); ?>" style="width:400px" /></td>
                </tr>
                <th scope="row"><?php _e('Display mode');?></th>
                    <td>
                        <select name="easycommentspaginate_effect">
                            <option value="default" <?php echo get_option('easycommentspaginate_effect') == 'default'?'selected':'';?>>Default</option>
                            <option value="fade" <?php echo get_option('easycommentspaginate_effect') == 'fade'?'selected':'';?>>Fade</option>
                            <option value="slide" <?php echo get_option('easycommentspaginate_effect') == 'slide'?'selected':'';?>>Slide</option>
                            <option value="climb" <?php echo get_option('easycommentspaginate_effect') == 'climb'?'selected':'';?>>Climb</option>
                        </select>
                    </td>
                </tr>
                <th scope="row"><?php _e('Slide / Climb offset');?></th>
                    <td><input type="text" name="easycommentspaginate_slideOffset" value="<?php echo get_option('easycommentspaginate_slideOffset'); ?>" style="width:400px" /></td>
                </tr>
                <th scope="row"><?php _e('Display "first page" button');?></th>
					<td>
						<input type="checkbox" name="easycommentspaginate_firstButton" value="1" <?php echo get_option('easycommentspaginate_firstButton') == '1'?'checked="checked"':'';?> />
					</td>
				</tr>
				<th scope="row"><?php _e('"first button" text');?></th>
                    <td><input type="text" name="easycommentspaginate_firstButtonText" value="<?php echo get_option('easycommentspaginate_firstButtonText'); ?>" style="width:400px" /></td>
                </tr>
                <th scope="row"><?php _e('Display "last page" button');?></th>
					<td>
						<input type="checkbox" name="easycommentspaginate_lastButton" value="1" <?php echo get_option('easycommentspaginate_lastButton') == '1'?'checked="checked"':'';?> />
					</td>
				</tr>
				<th scope="row"><?php _e('"last button" text');?></th>
                    <td><input type="text" name="easycommentspaginate_lastButtonText" value="<?php echo get_option('easycommentspaginate_lastButtonText'); ?>" style="width:400px" /></td>
                </tr>
                <th scope="row"><?php _e('Display "previous page" button');?></th>
					<td>
						<input type="checkbox" name="easycommentspaginate_prevButton" value="1" <?php echo get_option('easycommentspaginate_prevButton') == '1'?'checked="checked"':'';?> />
					</td>
				</tr>
				<th scope="row"><?php _e('"previous button" text');?></th>
                    <td><input type="text" name="easycommentspaginate_prevButtonText" value="<?php echo get_option('easycommentspaginate_prevButtonText'); ?>" style="width:400px" /></td>
                </tr>
                <th scope="row"><?php _e('Display "next page" button');?></th>
					<td>
						<input type="checkbox" name="easycommentspaginate_nextButton" value="1" <?php echo get_option('easycommentspaginate_nextButton') == '1'?'checked="checked"':'';?> />
					</td>
				</tr>
				<th scope="row"><?php _e('"next button" text');?></th>
                    <td><input type="text" name="easycommentspaginate_nextButtonText" value="<?php echo get_option('easycommentspaginate_nextButtonText'); ?>" style="width:400px" /></td>
                </tr>
                <th scope="row"><?php _e('Custom CSS class');?></th>
					<td><input type="text" name="easycommentspaginate_class" value="<?php echo get_option('easycommentspaginate_class');?>" /></td>
				</tr>
				<th scope="row"><?php _e('Custom CSS (will create a new css file "easycommentspaginate_custom.css")');?></th>
					<td>
						<textarea name="easycommentspaginate_custom_css" style="width: 98%; font-size: 12px;" rows="6" cols="50"><?php echo get_option('easycommentspaginate_custom_css'); ?></textarea>
					</td>
				</tr>
                <th scope="row"><?php _e('Test mode (Display easyCommentsPaginate only when you preview a post, usefull to configure safely the plugin)');?></th>
					<td>
						<input type="checkbox" name="easycommentspaginate_test_mode" value="1" <?php echo get_option('easycommentspaginate_test_mode') == '1'?'checked="checked"':'';?> /><?php _e('Enable test mode');?>
					</td>
				</tr>
				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="page_options" value="easycommentspaginate_paginateContainer,easycommentspaginate_paginateElement,easycommentspaginate_hashPage,easycommentspaginate_elementsPerPage,easycommentspaginate_effect,easycommentspaginate_slideOffset,easycommentspaginate_firstButton,easycommentspaginate_firstButtonText,easycommentspaginate_lastButton,easycommentspaginate_lastButtonText,easycommentspaginate_prevButton,easycommentspaginate_prevButtonText,easycommentspaginate_nextButton,easycommentspaginate_nextButtonText,easycommentspaginate_class,easycommentspaginate_custom_css,easycommentspaginate_test_mode" />
			</table>
			<p class="submit">
				<input type="submit" name="easycommentspaginate_update" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>
	</div>
	<?php
}

function setEasyPaginate() {
    $firstButtonStatut = get_option('easycommentspaginate_firstButton');
    $lastButtonStatut = get_option('easycommentspaginate_lastButton');
    $prevButtonStatut = get_option('easycommentspaginate_prevButton');
    $nextButtonStatut = get_option('easycommentspaginate_nextButton');
    
	$output = "jQuery(document).ready(function($) {
				$('".get_option('easycommentspaginate_paginateContainer')."').easyPaginate({
				    paginateElement: '".get_option('easycommentspaginate_paginateElement')."',
                    elementsPerPage: ".get_option('easycommentspaginate_elementsPerPage').",
                    hashPage: '".get_option('easycommentspaginate_hashPage')."',
                    effect: '".get_option('easycommentspaginate_effect')."',
                    slideOffset: ".get_option('easycommentspaginate_slideOffset').",
                    firstButton: ".($firstButtonStatut?'true':'false').",
                    firstButtonText: '".get_option('easycommentspaginate_firstButtonText')."',
                    lastButton: ".($lastButtonStatut?'true':'false').",
                    lastButtonText: '".get_option('easycommentspaginate_lastButtonText')."',        
                    prevButton: ".($prevButtonStatut?'true':'false').",
                    prevButtonText: '".get_option('easycommentspaginate_prevButtonText')."',        
                    nextButton: ".($nextButtonStatut?'true':'false').",
                    nextButtonText: '".get_option('easycommentspaginate_nextButtonText')."'
				});
			});";
	return $output;
}

function setScripts() {
	wp_enqueue_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');	
	wp_enqueue_script('jquery_easycommentspaginate', '/wp-content/plugins/easycommentspaginate/jquery.easyPaginate.js', array('jquery'), '1.0');
}

function setHeader() {
    $display = true;
    
    if(get_option('easycommentspaginate_test_mode')) {
		if(isset($_GET['preview']) && $_GET['preview']) {
			$display = true;
		}else {
			$display = false;
		}
	}

    if($display) {
	    echo '<link rel="stylesheet" type="text/css" media="all" href="/wp-content/plugins/easycommentspaginate/easycommentspaginate.css">';
	    $custom_css = get_option('easycommentspaginate_custom_css');
	    if(!empty($custom_css)) {
		    echo '<style type="text/css">'.$custom_css.'</style>';
	    }
	    echo '<script type="text/javascript">'.setEasyPaginate().'</script>';
	}
}

add_action('wp_print_scripts', 'setScripts');
add_action('wp_head', 'setHeader');
?>