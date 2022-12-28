<?php get_header(); ?>
<div class="container">
  <?php if (
    $GLOBALS['current_user']->roles[0] == 'administrator'
    or
    $GLOBALS['current_user']->roles[0] == 'author'
  ): ?>
  <div class="row">
    <div class="col pt-3" id="post_add_form-slide">
      <a href="#" class="smart_link">
        <span class="h5">
          Добавить заказ
        </span>        
        <i class="fa fa-chevron-down post_add_form-slide-icon" aria-hidden="true"></i>
        <i class="fa fa-chevron-up post_add_form-slide-icon invisible_node" aria-hidden="true"></i>
      </a>
    </div>
  </div>
  <form action="" method="post" id="post_add_form" class="row justify-content-center border-bottom pb-3">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 pt-2">
      Заказчик:
      <input type="text" class="form-control" name="customer_name" required>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 pt-2">
      Email:
      <input type="email" class="form-control" name="customer_mail">
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 pt-2">
      тел.:
      <input type="text" class="form-control" name="customer_phone" required>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 pt-2">
      Адрес:
      <input type="text" class="form-control" name="customer_address" required>
    </div>
    <div class="col-12 pt-2">
      <textarea name="order_description" class="form-control" rows="2" placeholder="Комментарий"></textarea>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 pt-2">
      <button class="btn btn-outline-info">
        <i class="fa fa-floppy-o" aria-hidden="true"></i>
        Сохранить заказ
      </button>
    </div>
  </form>
<?php endif ?>
</div>
<pre><?php print_r($_POST);?></pre>
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