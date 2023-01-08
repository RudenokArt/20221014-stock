<?php
// ===== Показ ошибок =====
include_once 'includes/display_errors.php';

$current_order = get_post();
$current_order->meta = get_post_meta($current_order->ID);
$current_order_manager = get_user_by('id', $current_order->post_author);
if ($current_order->meta['order_contractor'][0]) {
  $current_order_contractor = get_user_by('id', $current_order->meta['order_contractor'][0]);
}
?>

<?php get_header(); ?>
<form class="container" method="post" action="/alert">
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 h4 pt-5">
      Заказ № 
      <?php echo $current_order->ID; ?>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 h4 pt-5">
      <?php echo $current_order->post_title; ?>
    </div>
  </div>
  <hr>
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

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <b>Заказчик:</b><br>
      ФИО: <?php echo $current_order->customer_name; ?><br>
      тел.: <?php echo $current_order->customer_phone; ?><br>
      Email: <?php echo $current_order->customer_email; ?><br>
      Адрес: <?php echo $current_order->customer_address; ?><br>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <b>Подрядчик:</b><br>
      <?php if ($current_order->meta['order_contractor'][0]): ?>
        <?php echo $current_order_contractor->data->display_name; ?><br>
        <?php echo $current_order_contractor->data->user_email; ?>
      <?php else: ?>
        <?php if ($stock_user->contractor_access and $current_order->meta['order_status'][0] == 0): ?>        
          <a href="/alert?&order_contractor=<?php echo $stock_user->current_user->ID;?>&ID=<?php echo $current_order->ID;?>" class="btn btn-outline-info">
            <i class="fa fa-handshake-o" aria-hidden="true"></i>
            Стать исполнителем
          </a><br>
        <?php endif ?>
      <?php endif ?>      
    </div>

  </div>

  <hr>

  <div class="row">
    <div class="col-12">
      <b>Комментарий к заказу: </b><br>
      <?php if ($stock_user->manager_access): ?>
        <textarea name="post_content" class="form-control"><?php echo $current_order->post_content; ?></textarea>
      <?php else: ?>
        <?php echo $current_order->post_content; ?>
      <?php endif ?>
    </div>
  </div>
  <hr>

  <?php if ($current_order->order_attachment): ?>
    <div class="row">
      <div class="col-12">
        <a href="/wp-content/uploads/orders/<?php echo $current_order->order_attachment; ?>" download>
          <i class="fa fa-cloud-download" aria-hidden="true"></i>
          Приложение
        </a>
      </div>
    </div>
  <?php endif ?>
  

  <?php if ($stock_user->manager_access): ?>
    <div class="row pt-4">
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
<pre><?php print_r($current_order); ?></pre>
<?php get_footer(); ?>