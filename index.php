<?php get_header(); ?>

<div class="container pt-5">
  <?php 
  // ===== Показ ошибок =====
  include_once 'includes/display_errors.php';
  // ===== Форма добавления заказа =====

  include_once 'php_core/Stock_orders.php';
  $stock_orders = new Stock_orders();
  if ($stock_orders->pagination) {
    $orders_list = get_posts([
      'orderby' => 'ID',
      'include' => $stock_orders->pagination[($stock_orders->current_page - 1)],
    ]);
  }
  ?>

  <?php include_once 'includes/index-post_filter_form.php'; ?>
  <?php include_once 'includes/index-post_add_form.php'; ?>
  <?php if (isset($orders_list)): ?>
    <?php foreach ($orders_list as $key => $value): ?>
      <?php $value->meta = get_post_meta($value->ID) ?>
      <a href="<?php echo $value->post_name; ?>"
        class="row border border-<?php echo $order_statuses_arr[$value->meta['order_status'][0]]['color']; ?> smart_link pt-1 mb-1 text-body orders_list-item">

        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
          <small class="text-secondary">№</small>
          <?php echo $value->ID; ?>
          <br>
          <small class="text-secondary">Статус заказа:</small>
          <?php echo $order_statuses_arr[$value->meta['order_status'][0]]['title']; ?>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12 col-12">
          <small class="text-secondary">Заказ:</small>
          <?php echo $value->post_title; ?>
          <br>
          <small class="text-secondary">Дата размещения:</small>
          <?php echo $value->post_date; ?>
        </div>

        <div class="col-lg-2 col-md-4 cols-sm-6 col-12">
          <small class="text-secondary">Менеджер:</small>
          <?php echo get_user_by('id', $value->post_author)->data->display_name; ?>
          <br>
          <small class="text-secondary">Подрядчик:</small>
          <?php if ($value->meta['order_contractor'][0]): ?>
            <?php echo get_user_by('id', $value->meta['order_contractor'][0])->data->display_name; ?>
          <?php endif ?>

        </div>

        <div class="col-lg-2 col-md-4 cols-sm-6 col-12">
          <small class="text-secondary">Заказчик:</small>
          <?php echo $value->meta['customer_name'][0]; ?>
          <br>
          <small class="text-secondary">Тел. заказчика:</small>
          <?php echo $value->meta['customer_phone'][0]; ?>
        </div>

        <div class="col-lg-3 col-md-6 cols-sm-12 col-12">
          <small class="text-secondary">Email заказчика:</small>
          <?php  echo $value->meta['customer_email'][0]; ?>
          <br>
          <small class="text-secondary">Адрес заказчика:</small>
          <?php echo $value->meta['customer_address'][0]; ?>
        </div>

      </a>
    <?php endforeach ?>
  <?php else: ?>
    <div class="alert alert-warning text-center" role="alert">
      Запрос не дал результатов. Измените параметры поиска.
    </div>
  <?php endif ?>


  <?php include_once 'includes/index-pagination.php' ?>
</div>

<pre><?php print_r($stock_orders->pagination) ?></pre>

<?php get_footer(); ?>