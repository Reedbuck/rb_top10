<?php

add_action( 'admin_init', 'true_plugin_init'); 

function true_plugin_init() {
    // подключение стилей
    wp_enqueue_style('uploadrbtop10style', plugins_url('assets/css/uploadrbtop10ystyle.css', __FILE__));
    
}


function rb_top10_db_install () { // функция выполняющеяся при активации
    global $wpdb;                   // подключение системы управления бд wordpress в функцию
    $table_name = $wpdb->prefix . "rb_top10"; // постоянный адресс плагина 
    
}

register_activation_hook(RBGL_PLUGIN,'rb_top10_db_install'); //вызов функции при активации


add_action('admin_menu', 'rb_top10_MenuCreate');

function rb_top10_MenuCreate(){
    if (function_exists('add_menu_page')){
        
        $pl_url = plugins_url('rb_top10/assets/img/icon.png');
        
        add_menu_page( 'RB top10', 'RB top10', 'manage_options', 'rb_top10', 'rb_top10_Home', $pl_url , '20' );
        
        
    }
}

?>