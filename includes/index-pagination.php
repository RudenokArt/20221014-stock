<?php $query_arr = $_GET; ?>

<div class="text-center pt-5">
  <?php foreach ($stock_orders->pagination as $key => $value): ?>
    <?php
    if (($key + 1) == $stock_orders->current_page) {
      $link_color = 'danger';
    } else {
      $link_color = 'secondary';
    }
    $query_arr['page'] = $key + 1;
    ?>
    <a class="btn btn-outline-<?php echo $link_color; ?> btn-sm" href="?<?php echo http_build_query($query_arr); ?>">
      <?php echo $key + 1; ?>
    </a>
  <?php endforeach ?>
</div>