<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        while (have_posts()): the_post();
            $products = get_post_meta(get_the_ID(), '_look_products', true);
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php the_content(); ?>
                    <?php if ($products): ?>
                        <h2>Products in this look:</h2>
                        <ul>
                            <?php foreach ($products as $product_id): ?>
                                <?php $product = wc_get_product($product_id); ?>
                                <li>
                                    <a href="<?php echo get_permalink($product_id); ?>">
                                        <?php echo $product->get_image(); ?>
                                        <?php echo $product->get_name(); ?>
                                    </a>
                                    <p><?php echo wc_price($product->get_price()); ?></p>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <form method="post" class="cart">
                            <?php foreach ($products as $product_id): ?>
                                <input type="hidden" name="add-to-cart" value="<?php echo $product_id; ?>">
                            <?php endforeach; ?>
                            <button type="submit" class="single_add_to_cart_button button alt">Add all to cart</button>
                        </form>
                    <?php endif; ?>
                </div><!-- .entry-content -->
            </article><!-- #post-## -->
            <?php
        endwhile;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
