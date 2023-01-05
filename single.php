<?php
// ===== Показ ошибок =====
include_once 'includes/display_errors.php';

$current_order = get_post();
$current_order->meta = get_post_meta($current_order->ID);
$current_order_manager = get_user_by('id', $current_order->post_author);
?>

<?php get_header(); ?>
<form class="container" method="post" action="/alert">
  <div class="row pt-3">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <b>Статус заказа:</b>
      <?php foreach ($order_statuses_arr as $key => $value): ?>
        <?php
        if ($key == $current_order->meta['order_status'][0]) {
          $bg_color = 'border border-'.$value['color'];
          $checked = 'checked';
          $text_color = 'text-dark';
        } else {
          $checked = '';
          $bg_color = '';
          $text_color = 'text-secondary';
        }
        ?>
        <span class="form-check <?php echo $bg_color.' '.$text_color; ?>">
          <label class="form-check-label p-1">
            <?php if ($stock_user->manager_access): ?>
              <input value="<?php echo $key; ?>" <?php echo $checked;?> class="form-check-input" type="radio" name="order_status">
            <?php endif ?>
            <?php echo $value['title']; ?>
          </label>
        </span>
      <?php endforeach ?>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <b>Ответственный менеджер:</b><br>
      <?php echo $current_order_manager->display_name; ?><br>
      <?php echo $current_order_manager->user_email; ?>
    </div>
  </div>
  <?php if ($stock_user->manager_access): ?>
    <div class="row pt-2">
    <div class="col">
      <input type="hidden" value="<?php echo $current_order->ID ?>" name="order_id">
      <button class="btn btn-outline-info" name="order_update" value="Y">
        <i class="fa fa-floppy-o" aria-hidden="true"></i>
        Сохранить изменения
      </button>
    </div>
  </div>
  <?php endif ?>
  
</form>
  <pre><?php print_r($current_order->meta); ?></pre>
<?php get_footer(); ?>