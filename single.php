<?php
$current_order = get_post();
?>

<?php get_header(); ?>
<div class="container">
  <pre><?php print_r($current_order); ?></pre>
</div>
<?php get_footer(); ?>