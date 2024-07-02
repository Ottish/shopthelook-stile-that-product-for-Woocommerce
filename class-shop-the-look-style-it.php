<?php

class Shop_The_Look_Style_It {
    public function __construct() {
        add_action('init', array($this, 'register_post_type'));
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('save_post', array($this, 'save_meta_boxes'));
        add_action('admin_menu', array($this, 'add_admin_menu'));
    }

    public function register_post_type() {
        register_post_type('look', array(
            'labels' => array(
                'name' => __('Looks'),
                'singular_name' => __('Look'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
        ));
    }

    public function add_meta_boxes() {
        add_meta_box('look_products', __('Look Products'), array($this, 'look_products_meta_box'), 'look', 'side', 'default');
    }

    public function look_products_meta_box($post) {
        $products = wc_get_products(array('limit' => -1));
        $selected_products = get_post_meta($post->ID, '_look_products', true) ?: array();
        ?>
        <div>
            <ul>
                <?php foreach ($products as $product): ?>
                    <li>
                        <label>
                            <input type="checkbox" name="look_products[]" value="<?php echo $product->get_id(); ?>" <?php checked(in_array($product->get_id(), $selected_products)); ?>>
                            <?php echo $product->get_name(); ?>
                        </label>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
    }

    public function save_meta_boxes($post_id) {
        if (isset($_POST['look_products'])) {
            $products = array_map('intval', $_POST['look_products']);
            update_post_meta($post_id, '_look_products', $products);
        } else {
            delete_post_meta($post_id, '_look_products');
        }
    }

    public function add_admin_menu() {
        add_menu_page(
            __('Shop The Look - Style It', 'textdomain'),
            __('Looks', 'textdomain'),
            'manage_options',
            'shop-the-look-style-it',
            array($this, 'admin_page'),
            'dashicons-admin-customizer',
            20
        );
    }

    public function admin_page() {
        ?>
        <div class="wrap">
            <h1><?php _e('Manage Looks', 'textdomain'); ?></h1>
            <p><?php _e('Here you can manage your product looks.', 'textdomain'); ?></p>
            <a href="<?php echo admin_url('edit.php?post_type=look'); ?>" class="button button-primary"><?php _e('Go to Looks', 'textdomain'); ?></a>
        </div>
        <?php
    }
}

new Shop_The_Look_Style_It();
?>
