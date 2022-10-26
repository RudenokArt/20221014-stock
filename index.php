<?php if (isset($_GET['tg_bot'])): ?>
  <pre><?php var_dump((new Tg_bot())->result); ?></pre>
<?php endif ?>

<hr>
<?php get_header(); ?>
<div>content</div>
<?php get_footer(); ?>