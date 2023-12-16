# WP Activation Deactivation hook demo

With a very simple implementation and example are tried here to show how WordPress register_activation_hook and register_deactivation_hook works.




## What will happen when plugin activate
When activating any new plugin the register_activation_hook works in the activation time. So to understand and get a visual view of the tasks of  register_activation_hook is the best way to create a new Database table in the WordPress database. See when we activated the plugin it's implement a new DB table. 

### register_activation_hook Code 
```

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
```
### Screenshot 
![App Screenshot](https://i.postimg.cc/G20xK3Yw/Screenshot-2023-12-16-184929.png)




## What will happen when plugin deactivate
When Deactivating any existing plugin the register_deactivation_hook works during the deactivation time. So to understand and get a visual view of the tasks of  register_deactivation_hook is the best way to remove the existing  Database table in the WordPress database which one added when the plugins were activated. See when we deactivated the plugin it removed the new DB Table 


### register_deactivation_hook Code 
```
function wprdhd_deactivation_hook(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_table';
    $wpdb->query( "DROP TABLE IF EXISTS $table_name" );
}
register_deactivation_hook(__FILE__, "wprdhd_deactivation_hook");
```
### Screenshot 
![App Screenshot](https://i.postimg.cc/wvp2QT8y/Screenshot-2023-12-16-185104.png)