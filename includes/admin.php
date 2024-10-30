<?php

/* No script kiddies */
defined("ABSPATH") or die("Access Denied.");

function gigamediumeditor_settings_page()
{
    add_options_page(
        'Better Editor Settings',
        'Better Editor',
        'manage_options',
        'gigamediumeditor_settings',
        'gigamediumeditor_settings_page_html'
    );
}

function gigamediumeditor_settings_page_html()
{
    // Check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }


    $screen = get_current_screen();
       if ( $screen->id === 'settings_page_gigamediumeditor_settings'){
            wp_enqueue_style('medium-editor-admin', plugins_url('/css/medium-editor-admin.css', __FILE__));
            wp_enqueue_style('medium-editor-admin_page', plugins_url('/css/settings-page.css', __FILE__));
    }

    // Load current theme option
    $current_theme = get_option('gigamediumeditor_theme', 'beagle');

    // Save theme option on form submission
    if (isset($_POST['gigamediumeditor_theme'])) {
        $current_theme = sanitize_text_field($_POST['gigamediumeditor_theme']);
        update_option('gigamediumeditor_theme', $current_theme);
    }
    ?>
    
<div id="pluginsclub-cpanel">
					<div id="pluginsclub-cpanel-header">
			<div id="pluginsclub-cpanel-header-title">
				<div id="pluginsclub-cpanel-header-title-image">
<h1><a href="http://plugins.club/" target="_blank" class="logo"><img src="<?php echo plugins_url('images/pluginsclub_logo_black.png', __FILE__) ?>" style="height:27px"></a></h1></div>

				<div id="pluginsclub-cpanel-header-title-image-sep">
				</div>      
<div id="pluginsclub-cpanel-header-title-nav">
	<?php
// Get our API endpoint and from it build the menu
$plugins_club_api_link = 'https://api.plugins.club/list_of_wp_org_plugins.php';
$remote_data = file_get_contents($plugins_club_api_link);
$menuItems = json_decode($remote_data, true);

foreach ($menuItems as $menuItem) :
    $isActive = isset($_GET['page']) && ($_GET['page'] === $menuItem['page']);
    $activeClass = $isActive ? 'active' : '';
    $isInstalled = function_exists($menuItem['check_function']) && function_exists($menuItem['check_callback']);
    $name = $menuItem['name'];
    if (!$isInstalled) {
        $name = ' <span class="dashicons dashicons-plus-alt"></span> '.$name;
    } else {
        $name .= ' <span class="dashicons dashicons-plugins-checked"></span>';
    }
?>
    <div class="pluginsclub-cpanel-header-nav-item <?php echo $activeClass; ?>">
        <?php if ($isInstalled) : ?>
            <a href="<?php echo $menuItem['url']; ?>" class="tab"><?php echo $name; ?></a>
        <?php else : ?>
            <a href="<?php echo $menuItem['fallback_url']; ?>" target="_blank" class="tab"><?php echo $name; ?></a>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
</div>   
      
			</div>
		</div>
		
		
		  <div class="wrap">

				<div id="pluginsclub-cpanel-admin-wrap" class="wrap">
			<h1 class="pluginsclub-cpanel-hide"><?php echo esc_html(get_admin_page_title()); ?></h1>
			<form id="pluginsclub-cpanel-form" method="post">
				<h2><?php echo esc_html(get_admin_page_title()); ?></h2>
		<p>
			Change front-end theme for the editor tooltip.</p>
			
			
		<div class="pluginsclub-cpanel-sep"></div>
		
    <div class="wrap">

<table class="form-table" role="presentation">
                <tbody>
                    <tr>
                     
                        <td class="gigamediumeditor-themes">
            <label <?php if ($current_theme === 'default') { echo 'class="active"'; } ?>>
              <input type="radio" name="gigamediumeditor_theme" value="default" <?php checked($current_theme, 'default'); ?> />
              <div class="gigamediumeditor-theme-wrapper">
                <img src="<?php echo plugins_url('/images/default.jpg', __FILE__); ?>" alt="Default Theme">
                <span class="gigamediumeditor-theme-label">Default</span>
              </div>
            </label>
            <label <?php if ($current_theme === 'beagle') { echo 'class="active"'; } ?>>
              <input type="radio" name="gigamediumeditor_theme" value="beagle" <?php checked($current_theme, 'beagle'); ?> />
              <div class="gigamediumeditor-theme-wrapper">
                <img src="<?php echo plugins_url('/images/beagle.jpg', __FILE__); ?>" alt="Beagle Theme">
                <span class="gigamediumeditor-theme-label">Beagle</span>
              </div>
            </label>
            <label <?php if ($current_theme === 'flat') { echo 'class="active"'; } ?>>
              <input type="radio" name="gigamediumeditor_theme" value="flat" <?php checked($current_theme, 'flat'); ?> />
              <div class="gigamediumeditor-theme-wrapper">
                <img src="<?php echo plugins_url('/images/flat.jpg', __FILE__); ?>" alt="Flat Theme">
                <span class="gigamediumeditor-theme-label">Flat</span>
              </div>
            </label>
            <label <?php if ($current_theme === 'bootstrap') { echo 'class="active"'; } ?>>
              <input type="radio" name="gigamediumeditor_theme" value="bootstrap" <?php checked($current_theme, 'bootstrap'); ?> />
              <div class="gigamediumeditor-theme-wrapper">
                <img src="<?php echo plugins_url('/images/bootstrap.jpg', __FILE__); ?>" alt="Bootstrap Theme">
                <span class="gigamediumeditor-theme-label">Bootstrap</span>
              </div>
            </label>
            <label <?php if ($current_theme === 'roman') { echo 'class="active"'; } ?>>
              <input type="radio" name="gigamediumeditor_theme" value="roman" <?php checked($current_theme, 'roman'); ?> />
              <div class="gigamediumeditor-theme-wrapper">
                <img src="<?php echo plugins_url('/images/roman.jpg', __FILE__); ?>" alt="Roman Theme">
                <span class="gigamediumeditor-theme-label">Roman</span>
              </div>
            </label>
            <label <?php if ($current_theme === 'mani') { echo 'class="active"'; } ?>>
              <input type="radio" name="gigamediumeditor_theme" value="mani" <?php checked($current_theme, 'mani'); ?> />
              <div class="gigamediumeditor-theme-wrapper">
                <img src="<?php echo plugins_url('/images/mani.jpg', __FILE__); ?>" alt="Mani Theme">
                <span class="gigamediumeditor-theme-label">Mani</span>
              </div>
            </label>
            <label <?php if ($current_theme === 'tim') { echo 'class="active"'; } ?>>
              <input type="radio" name="gigamediumeditor_theme" value="tim" <?php checked($current_theme, 'tim'); ?> />
              <div class="gigamediumeditor-theme-wrapper">
                <img src="<?php echo plugins_url('/images/tim.jpg', __FILE__); ?>" alt="Tim Theme">
                <span class="gigamediumeditor-theme-label">Tim</span>
              </div>
            </label>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

add_action('admin_menu', 'gigamediumeditor_settings_page');
