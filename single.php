<?php
$current_order = get_post();
$current_order->meta = get_post_meta($current_order->ID);
?>

<?php get_header(); ?>
<div class="container">
  <div class="row pt-3">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <b>Статус заказа:</b>
      <?php foreach ($order_statuses_arr as $key => $value): ?>
        <?php
        if ($key == $current_order->meta->order_status[0]) {
          $bg_color = 'bg-'.$value['color'];
          $text_color = 'text-light';
          $checked = 'checked';
        } else {
          $checked = '';
          $text_color = 'text-dark';
          $bg_color = '';
        }
        ?>
        <span class="form-check <?php echo $bg_color.' '.$text_color; ?>">
          <label class="form-check-label p-1">
            <input value="<?php echo $key; ?>" <?php echo $checked;?> class="form-check-input" type="radio" name="order_status">
            <?php echo $value['title']; ?>
          </label>
        </span>
      <?php endforeach ?>
    </div>
  </div>
  <pre><?php print_r($stock_helper->manager_access); ?></pre>
</div>
<?php get_footer(); ?>