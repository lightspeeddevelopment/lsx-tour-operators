<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


define( 'TO_BANNERS_PATH', LSX_TO_PATH . 'vendor/lsx-banners/' );
define( 'TO_BANNERS_CORE', LSX_TO_PATH . 'vendor/lsx-banners/lsx-banners.php' );
define( 'TO_BANNERS_URL', LSX_TO_URL . 'vendor/lsx-banners/' );
define( 'TO_BANNERS_VER', '1.2.5' );


/* ======================= Below is the Plugin Class init ========================= */

require_once( TO_BANNERS_PATH . 'class-lsx-banners.php' );
$lsx_banners = new TO_Banners();
