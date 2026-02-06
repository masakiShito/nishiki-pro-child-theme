<?php

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main class="onesta-main">
    <?php get_template_part('components/hero'); ?>
    <?php get_template_part('components/categories'); ?>
    <?php get_template_part('components/footer-cta'); ?>
    <?php get_template_part('components/features'); ?>
    <?php get_template_part('components/highlight'); ?>
</main>

<?php
get_footer();
