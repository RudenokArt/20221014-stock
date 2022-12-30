<?php 

$pagination_arr = [];
for ($i = 1; $i <= $pages_count; $i++) { 
  if (
    $i == $current_page
    or
    $i == $current_page - 1
    or
    $i == $current_page + 1
    or
    $i == $current_page - 2
    or
    $i == $current_page + 2
  ) {
    array_push($pagination_arr, $i);
  }
}
?> 

<div class="row">
  <div class="col text-center p-2">
    <?php if ($current_page > 3): ?>
      <a href="?page=1" class="<?php if ($current_page == 1): ?>
        text-danger
      <?php endif ?> smart_link">1</a>
      ...
    <?php endif ?>
    <?php foreach ($pagination_arr as $key => $value): ?>
      <a href="?page=<?php echo $value; ?>" class="<?php if ($current_page == $value): ?>
        text-danger
      <?php endif ?> smart_link p-2">
        <?php echo $value; ?>
      </a>
    <?php endforeach ?>
    <?php if ($current_page < $pages_count-2): ?>
      ...
      <a href="?page=<?php echo $pages_count; ?>" class="<?php if ($current_page == $pages_count): ?>
        text-danger
      <?php endif ?> smart_link p-2">
        <?php echo $pages_count; ?>
      </a>
    <?php endif ?>
  </div>
</div>