<?php
/*
Plugin Name: UM Dashboard
Plugin URL: http://remicorson.com/sweet-custom-dashboard
Description: Plugin basado en https://www.wpexplorer.com/how-to-wordpress-custom-dashboard/
Version: 0.1
*/

/*
|--------------------------------------------------------------------------
| CONSTANTS
|--------------------------------------------------------------------------
*/

// plugin folder url
if(!defined('RC_SCD_PLUGIN_URL')) {
	define('RC_SCD_PLUGIN_URL', plugin_dir_url( __FILE__ ));
}

/*
|--------------------------------------------------------------------------
| MAIN CLASS
|--------------------------------------------------------------------------
*/

class rc_sweet_custom_dashboard {
 
	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/
 
	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {
	
		add_action('admin_menu', array( &$this,'rc_scd_register_menu') );
		add_action('load-index.php', array( &$this,'rc_scd_redirect_dashboard') );
 
	} // end constructor
 
	function rc_scd_redirect_dashboard() {
	
		if( is_admin() ) {
			$screen = get_current_screen();
			
			if( $screen->base == 'dashboard' ) {

				wp_redirect( admin_url( 'index.php?page=custom-dashboard' ) );
				
			}
		}

	}
	
	
	
	function rc_scd_register_menu() {
		add_dashboard_page( 'Custom Dashboard', 'Custom Dashboard', 'read', 'custom-dashboard', array( &$this,'rc_scd_create_dashboard') );
	}
	
	function rc_scd_create_dashboard() {
		include_once( 'custom_dashboard.php'  );
	}

 
}
 
// instantiate plugin's class
$GLOBALS['sweet_custom_dashboard'] = new rc_sweet_custom_dashboard();

/**
 * CSS de la pantalla de login
 */
function my_login_logo() { ?>
    <style type="text/css">
	    
	    body {
		    background-color: #003366 !important;
	    }
	    
	    .login #backtoblog a, .login #nav a {
		    color: #fff !important;
	    }
	    
	    input[type="checkbox"]:focus, input[type="color"]:focus, input[type="date"]:focus, input[type="datetime-local"]:focus, input[type="datetime"]:focus, input[type="email"]:focus, input[type="month"]:focus, input[type="number"]:focus, input[type="password"]:focus, input[type="radio"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="text"]:focus, input[type="time"]:focus, input[type="url"]:focus, input[type="week"]:focus, select:focus, textarea:focus {

			border-color: #003366 !important;
    		box-shadow: none !important;

		}
		
		.login #login_error, 
		.login .message, .login .success {
			border-left-color: #009999 !important;
		}
	    
	    .login #backtoblog a:hover, 
	    .login #nav a:hover, 
	    .login h1 a:hover {
		    color: #009999 !important;
	    }
	    
        #login h1 a, .login h1 a {
            background-image: url(<?php echo plugin_dir_url( __FILE__ ); ?>img/logo-um.png);
		height:120px;
		width: 120px;
		background-size: 100% auto;
		background-repeat: no-repeat;
        	margin-bottom: 30px;
        }
        
        .wp-core-ui .button-group.button-large .button, 
		.wp-core-ui .button.button-large {
			background-color: #003366 !important;
			border: none;
			border-radius: 0;
			box-shadow: none;
			font-weight: 300;
			letter-spacing: 2.4px;
			padding: 0 24px;
			text-shadow: none;
			text-transform: uppercase;
			transition: all .25s ease;
		}
		
		.wp-core-ui .button-group.button-large .button:hover, 
		.wp-core-ui .button.button-large:hover {
			background: #009999 !important;
		}
		
		#wpadminbar {
			background-color: #003366 !important;
		}
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

// change logo url

function my_login_logo_url() {
    return 'https://um.edu.ar/';
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Universidad de Mendoza';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

/**
 * CSS de frontend para adminbar
 */
add_action('wp_head', 'um_admin_bar');

function um_admin_bar() {
	echo '<style>
		#wpadminbar {
    		background: #003366;
		}

		.ab-sub-wrapper, #wpadminbar .shortlink-input {
			background: #000033;
		}

		#wpadminbar .ab-top-menu>li.hover>.ab-item, #wpadminbar.nojq .quicklinks .ab-top-menu>li>.ab-item:focus, #wpadminbar:not(.mobile) .ab-top-menu>li:hover>.ab-item, #wpadminbar:not(.mobile) .ab-top-menu>li>.ab-item:focus {
			background: #000033;
			color: #009999;
		}
	</style>';
};

/**
 * CSS de backend
 */
add_action('admin_head', 'um_style');

function um_style() {

  echo '<style>

	body, .about-wrap h1 {
		color: #324B4B;
	}

	.about-wrap {
		margin: 0 auto;
		margin-top: 3rem;
	}

  	b, strong {
		font-weight: 600;
		color: #003366;
	}
  
  	a,
  	.wp-core-ui .button-link:hover,
  	.update-message p::before {
	  	color: #003366 !important;
	}
  
    #wpadminbar {
		background-color: #000033 !important;
	}

	#wp-admin-bar-site-name a.ab-item {
		text-transform: uppercase !important;
		font-weight: 600 !important;
	}

	#adminmenu {
		margin: 0px;
	}

    #adminmenu, 
    #adminmenu .wp-submenu, 
    #adminmenuback, #adminmenuwrap {
	    background-color: #003366 !important;
	}
	
	#wpadminbar .ab-empty-item, 
	#wpadminbar a.ab-item, 
	#wpadminbar > #wp-toolbar span.ab-label, 
	#wpadminbar > #wp-toolbar span.noticon,
	#wpadminbar .quicklinks .ab-sub-wrapper .menupop.hover > a, 
	#wpadminbar .quicklinks .menupop ul li a:focus, 
	#wpadminbar .quicklinks .menupop ul li a:focus strong, 
	#wpadminbar .quicklinks .menupop ul li a:hover, 
	#wpadminbar .quicklinks .menupop ul li a:hover strong, 
	#wpadminbar .quicklinks .menupop.hover ul li a:focus, 
	#wpadminbar .quicklinks .menupop.hover ul li a:hover, 
	#wpadminbar .quicklinks .menupop.hover ul li div[tabindex]:focus, 
	#wpadminbar .quicklinks .menupop.hover ul li div[tabindex]:hover, 
	#wpadminbar li #adminbarsearch.adminbar-focused::before, 
	#wpadminbar li .ab-item:focus .ab-icon::before, 
	#wpadminbar li .ab-item:focus::before, 
	#wpadminbar li a:focus .ab-icon::before, 
	#wpadminbar li.hover .ab-icon::before, 
	#wpadminbar li.hover .ab-item::before, 
	#wpadminbar li:hover #adminbarsearch::before, 
	#wpadminbar li:hover .ab-icon::before, 
	#wpadminbar li:hover .ab-item::before, 
	#wpadminbar.nojs .quicklinks .menupop:hover ul li a:focus, 
	#wpadminbar.nojs .quicklinks .menupop:hover ul li a:hover, 
	#adminmenu li:hover div.wp-menu-image::before,
	#adminmenu a,
	#adminmenu .wp-submenu a,
	#adminmenu li a:focus div.wp-menu-image::before,
	#adminmenu div.wp-menu-image::before,
	#wpadminbar .ab-icon::before,
	#wpadminbar .ab-item::before,
	.acf-tooltip a,
	.acf-tooltip a[data-event="confirm"]:hover {
		color: #fff !important;
	}
	
	a:hover,
	#adminmenu .wp-submenu a:hover,
	.wp-core-ui .button-link,
	.plugin-update .update-message p,
	.acf-tooltip a[data-event="confirm"],
	.acf-tooltip a:hover {
		color: #009999 !important;
	}
	
	#wpadminbar .ab-top-menu > li.hover > .ab-item, 
	#wpadminbar.nojq .quicklinks .ab-top-menu > li > .ab-item:focus, 
	#wpadminbar:not(.mobile) .ab-top-menu > li:hover > .ab-item, 
	#wpadminbar:not(.mobile) .ab-top-menu > li > .ab-item:focus,
	#wpadminbar .menupop .ab-sub-wrapper, 
	#wpadminbar .shortlink-input,
	#adminmenu li.menu-top:hover, 
	#adminmenu li.opensub > a.menu-top, 
	#adminmenu li > a.menu-top:focus,
	#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu {
		background-color: #009999 !important;
		color: #fff !important;
	}
	
	#wpadminbar .quicklinks .menupop ul.ab-sub-secondary, 
	#wpadminbar .quicklinks .menupop ul.ab-sub-secondary .ab-submenu,
	#adminmenu .awaiting-mod, 
	#adminmenu .update-plugins {
		background: #666 !important;
	}
	
	.wp-core-ui .button-primary {
		background-color: #003366 !important;
		border: none;
		border-radius: 0;
		box-shadow: none;
		color: #fff !important;
		font-weight: 300;
		letter-spacing: 2.4px;
		padding: 0 24px;
		text-shadow: none;
		text-transform: uppercase;
		transition: all .25s ease;
	}
	
	.wp-core-ui .button-primary:hover {
		background: #009999 !important;
	}
	
	.notice-warning.notice-alt {
		border-left-color: #003366 !important;
	}
	
	.plugin-update-tr.active td, 
	.plugins .active th.check-column,
	.notice-info {
		border-left-color: #009999 !important;
	}
	
	.plugins .active td, 
	.plugins .active th {
		background: #fff;
	}
	
	.notice-warning.notice-alt {
		background: #eee;
	}

	#adminmenu .wp-submenu {
		background: #000033 !important;
	}

	#adminmenu li.menu-top a {
		border-top: 1px solid #000033;
		padding-top: 0.25rem;
		padding-bottom: 0.25rem;
	}

	#adminmenu li.wp-menu-separator {
		display: none;
	}

	#collapse-button {
		background: #000033;
		color: #009999;
	}
			
  </style>';
};

/**
 * Evitar notificaciones de wordpress
 */
function hide_update_notice_to_all_but_admin_users()
{
    if (!current_user_can('update_core')) {
        remove_action( 'admin_notices', 'update_nag', 3 );
    }
}
add_action( 'admin_head', 'hide_update_notice_to_all_but_admin_users', 1 );


/**
 * Saca el logo del admin bar
 */
// function example_admin_bar_remove_logo() {
//     global $wp_admin_bar;
//     $wp_admin_bar->remove_menu( 'wp-logo' );
// }
// add_action( 'wp_before_admin_bar_render', 'example_admin_bar_remove_logo', 0 );

/**
 * Saca el Full Mode por defecto en gutenberg
 */
if (is_admin()) { 
	function jba_disable_editor_fullscreen_by_default() {
	    $script = "jQuery( window ).load(function() { const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ); if ( isFullscreenMode ) { wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); } });";
	    wp_add_inline_script( 'wp-blocks', $script );
	}
	add_action( 'enqueue_block_editor_assets', 'jba_disable_editor_fullscreen_by_default' );
}

?>
