<?php

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div class="onesta-main">
    <?php get_template_part('components/hero'); ?>
    <?php get_template_part('components/specforge-spotlight'); ?>
    <?php get_template_part('components/categories'); ?>
    <?php get_template_part('components/footer-cta'); ?>
    <?php get_template_part('components/features'); ?>
    <?php get_template_part('components/highlight'); ?>
</div><!-- .onesta-main -->

<?php
get_footer();
