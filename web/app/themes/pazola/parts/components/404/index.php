<?php loadStyles(__DIR__,'404'); ?>
<div class="container">
    <h1><?php _e( '404 - Not found.' ); ?></h1>
    <h2>
        <?php _e( 'We\'re sorry, but the page you are looking for cannot be found. What should you do at this point? Here are some options:', 'pazola' ); ?>
    </h2>
    <ul>
        <li><?php _e( 'If you typed in a URL, check that it is typed in correctly.', 'pazola' ); ?></li>
        <li><?php _e( 'Perhaps it was just a fluke, and if you try again by clicking refresh, it\'ll pop right up!', 'pazola' ); ?></li>
        <li><?php _e( 'Or head back to our home page', 'pazola' ); ?> <a
                href="<?php echo esc_url( home_url() ); ?>"><?php echo esc_url( home_url() ); ?></a> <?php _e( 'and navigate from there.', 'pazola' ); ?>
        </li>
    </ul>			
</div>