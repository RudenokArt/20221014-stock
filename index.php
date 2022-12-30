<?php get_header(); ?>
<div class="container">
  <?php 

  include_once 'includes/index-post_add_form.php'; 
  $orders_on_page = 10;
  $order_category = get_category_by_slug('order');
  $pages_count = ceil($order_category->count/$orders_on_page);
  $current_page = 1;
  if ($_GET['page']) {
    $current_page = $_GET['page'];
  }
  if ($_GET['page'] > $pages_count) {
    $current_page = $pages_count;
  }

  $orders_list = get_posts([
    'category' => 'order',
    'numberposts' => $orders_on_page,
    'offset' => ($current_page - 1) * $orders_on_page,
  ]);

  ?>

  <?php foreach ($orders_list as $key => $value): ?>
    <?php $value->meta = get_post_meta($value->ID) ?>
    <a href="<?php echo $value->guid; ?>" class="row border-bottom smart_link pt-1 pb-1 text-body orders_list-item">

      <div class="col-lg-2 col-md-4 col-sm-6 col-12">
        <small class="text-secondary">№</small>
        <?php echo $value->ID; ?>
        <br>
        <small class="text-secondary">Статус заказа:</small>
        <?php echo $value->meta['order_status'][0]; ?>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-12 col-12">
        <small class="text-secondary">Заказ:</small>
        <?php echo $value->post_title; ?>
        <br>
        <small class="text-secondary">Дата заказа:</small>
        <?php echo $value->post_date; ?>
      </div>

      <div class="col-lg-2 col-md-4 cols-sm-6 col-12">
        <small class="text-secondary">Менеджер:</small>
        <?php echo $value->post_author; ?>
        <br>
        <small class="text-secondary">Подрядчик:</small>
        <?php echo $value->meta['order_contractor'][0]; ?>
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

  <?php include_once 'includes/index-pagination.php' ?>


</div>
<script>
  $(function () {
    $('#post_add_form').hide();
    $('#post_add_form-slide').click(function () {
      $('#post_add_form').slideToggle();
      $('.post_add_form-slide-icon').toggle();
    });
    
  });
</script>
<?php get_footer(); ?>