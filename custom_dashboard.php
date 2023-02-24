<?php
/**
 * Our custom dashboard page
 */

/** WordPress Administration Bootstrap */
require_once( ABSPATH . 'wp-load.php' );
require_once( ABSPATH . 'wp-admin/admin.php' );
require_once( ABSPATH . 'wp-admin/admin-header.php' );
?>
<div class="wrap about-wrap">

	

	<?php 
	$current_user = wp_get_current_user();
 
/*
 * @example Safe usage: $current_user = wp_get_current_user();
 * if ( ! ( $current_user instanceof WP_User ) ) {
 *     return;
 * }
 */
//printf( __( 'Username: %s', 'textdomain' ), esc_html( $current_user->user_login ) ) . '<br />';
// printf( __( 'User email: %s', 'textdomain' ), esc_html( $current_user->user_email ) ) . '<br />';
// $nombre = printf( __( 'User first name: %s', 'textdomain' ), esc_html( $current_user->user_firstname ) ) . '<br />';
$nombre = esc_html( $current_user->user_firstname );
// printf( __( 'User last name: %s', 'textdomain' ), esc_html( $current_user->user_lastname ) ) . '<br />';
// printf( __( 'User display name: %s', 'textdomain' ), esc_html( $current_user->display_name ) ) . '<br />';
// printf( __( 'User ID: %s', 'textdomain' ), esc_html( $current_user->ID ) );
?>

<div class="dashboard__welcome-container">
	<img src="<?php echo plugin_dir_url( __FILE__ ) . 'img/logo-um.png'; ?>" alt="Universidad de Mendoza" class="dashboard__logo">
	<h1 class="dashboard__saludo">
		Hola, <strong><?php echo $nombre; ?></strong>
	</h1>
</div>

<style>
	.dashboard__welcome-container {
		width: 100%;
		max-width: 540px;
		text-align: center;
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		margin: 0 auto;
		padding-top: 2rem;
	}

	.dashboard__saludo {
		width: 100% !important;
		margin: 0 auto !important;
		margin-top: 1rem !important;
	}

	.dashboard__logo {
		max-width: 100px;
		margin: 0 auto;
		height: auto;
	}
</style>

	
</div>
<?php include( ABSPATH . 'wp-admin/admin-footer.php' );