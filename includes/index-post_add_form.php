<?php if ($stock_helper->manager_access): ?>
  <div class="row">
    <div class="col" id="post_add_form-slide">
      <a href="#" class="smart_link">
        <span class="h5">
          Добавить заказ
        </span>        
        <i class="fa fa-chevron-down post_add_form-slide-icon" aria-hidden="true"></i>
        <i class="fa fa-chevron-up post_add_form-slide-icon invisible_node" aria-hidden="true"></i>
      </a>
    </div>
  </div>
  <form action="alert" enctype="multipart/form-data" method="post" id="post_add_form" class="row justify-content-center pb-3">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 pt-2">
      Заказ:
      <input type="text" class="form-control" name="order_title" required>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 pt-2">
      Заказчик (ФИО):
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
    <div class="col-lg-9 col-md-6 col-sm-6 col-12 pt-2 pt-2">
      Адрес:
      <input type="text" class="form-control" name="customer_address" required>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 pt-2">
      Приложение:
      <input type="file" class="form-control" name="order_attachment">
    </div>
    <div class="col-12 pt-2">
      <textarea name="order_description" class="form-control" rows="2" placeholder="Комментарий"></textarea>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 pt-2">
      <button class="btn btn-outline-info" name="add_new_order" value="Y">
        <i class="fa fa-floppy-o" aria-hidden="true"></i>
        Сохранить заказ
      </button>
    </div>
  </form>
  <hr>
<?php endif ?>