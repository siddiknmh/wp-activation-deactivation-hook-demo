<?php
/*
Plugin Name: WP activation deactivation hook demo
Plugin URI: https://github.com/siddiknmh/wp-activation-deactivation-hook-demo
Description: With a very simple implementation and example are tried here to show how WordPress register_activation_hook and register_deactivation_hook works.
Version: 1.0
Requires at least: 5.8
Requires PHP: 5.6.20
Author: AB Siddik
Author URI: https://github.com/siddiknmh
License: GPLv2 or later
*/


function wprdhd_activation_hook(){
    global $wpdb;

    $table_name = $wpdb->prefix . 'custom_table';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        name tinytext NOT NULL,
        text text NOT NULL,
        url varchar(55) DEFAULT '' NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );
}
register_activation_hook(__FILE__, "wprdhd_activation_hook");



function wprdhd_deactivation_hook(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_table';
    $wpdb->query( "DROP TABLE IF EXISTS $table_name" );
}
register_deactivation_hook(__FILE__, "wprdhd_deactivation_hook");

