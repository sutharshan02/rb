<?php
/*
Plugin Name: Google Analytics Plugin
Version: 1.1
Plugin URI: http://improveseo.info/
Description: Optimized Google Analytics Plugin for Wordpress
Author: Adrian Ianculescu
Author URI: http://improveseo.info/
*/

function google_analytics_footer_code() {	
	$google_analytics_options = get_option('google_analytics_options');
	echo "<script>  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');  ga('create', '$google_analytics_options[ua_id]', 'auto');  ga('send', 'pageview');</script>";	
}
function google_analytics_admin_section() {
	$google_analytics_options = get_option('google_analytics_options');
	if (isset($_POST['update_options_submit'])) {
		$google_analytics_options['ua_id'] = $_POST['ua_id'];
		update_option('google_analytics_options', $google_analytics_options);
	}
?>

<div class=wrap>
  <form method="post">
    <h2>Google Analytics</h2>
    <fieldset class="options" name="general">
	<br/>
      <table class="editform">
        <tr>
          <th nowrap valign="top"><?php _e('UA ID(Web Property ID):', 'google-analytics') ?></th>
          <td><input name="ua_id" type="text" id="ua_id" value="<?php echo $google_analytics_options['ua_id']; ?>" size="30" />
            <br />Enter your Google Analytics Web Property ID(UA ID). You can retrieve it from Analytics admin page(Analytics Settings > Profile Settings > Tracking Code) or from the javascript provided by google analytics. It should look like this one: UA-999999-9. 
			You don't have to include the JavaScript code, this plugin will do it for you.
          </td>
        </tr>
      </table>
    </fieldset>
    
    <div class="submit">
      <input type="submit" name="update_options_submit" value="<?php _e('Update options', 'google-analytics') ?>" />
	</div>
  </form>
</div>

<?php
}
function google_analytics_admin_submenu() { add_submenu_page('options-general.php', 'Google Analytics', 'Google Analytics', 8, __FILE__, 'google_analytics_admin_section'); }
add_action('admin_menu', 'google_analytics_admin_submenu');
add_action('wp_footer', 'google_analytics_footer_code');
?>