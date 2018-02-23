<?php
/*
Plugin Name: rb_top10
Plugin URI: http://reedbuck.ru
Description: Плагин добавляет надстройку над плагином top10
Version: 1.0
Author: Vpan
Author URI: http://reedbuck.ru
License: GPL2
*/
?>
<?php 

define( 'RBGL_VERSION', '1.0' );

define( 'RBGL_REQUIRED_WP_VERSION', '4.4' );

define( 'RBGL_PLUGIN', __FILE__ );

define( 'RBGL_PLUGIN_BASENAME', plugin_basename( RBGL_PLUGIN ) );

define( 'RBGL_PLUGIN_NAME', trim( dirname( RBGL_PLUGIN_BASENAME ), '/' ) );

define( 'RBGL_PLUGIN_DIR', untrailingslashit( dirname( RBGL_PLUGIN ) ) );

define( 'RBGL_PLUGIN_MODULES_DIR', RBGL_PLUGIN_DIR . '/modules' );

require_once RBGL_PLUGIN_DIR . '/setting.php';

/*
*
* ГЛАВНАЯ
*
*/

function rb_top10_Home(){
    if(!$_GET["action"]){
        
        global $wpdb;
        $table_name = $wpdb->prefix . "rb_top10";

        $GMId = $wpdb->get_col(
            "
            SELECT id 
            FROM $table_name
            "
        );
        
?>
<h2>Главная страница</h2>
<?php
        $plugin_dir = ABSPATH . 'wp-content/plugins/top-10/';
        $grind = file_exists($plugin_dir . "top-10.php");
        if ( $grind == "" ){
            echo "Плагин вообще не установлен";        
        } else {
            if ( is_plugin_active( "top-10/top-10.php" ) ){
                
                echo "плагин активен";
                echo "<br>";
                
                require_once RBGL_PLUGIN_DIR . '/rb_top10home.php';
            } else {
                echo "Данный плагин работает как надстройка для плагина Top-10. Для начала работы, активируйте данный плагин.";
              
            }    
        }
        
?>
<?php    
    }
}
?>