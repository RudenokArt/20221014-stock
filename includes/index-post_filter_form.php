<pre><?php print_r($_GET); ?></pre>


<div class="row pb-3 justify-content-start">
	<div class="col-lg-6 col-md-6 col-sm-12 col-12">
		<div class="container card p-2">
			<div class="row">
				<div class="col text-center h5">
					Фильтр заказов:
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12 col-12">
					по менеджеру:
				</div>
				<div class="col-lg-8 col-md-6 col-sm-12 col-12">
					<select name="" class="form-select"></select>
				</div>
			</div>
			<div class="row pt-2">
				<div class="col-lg-4 col-md-6 col-sm-12 col-12">
					по подрядчику:
				</div>
				<div class="col-lg-8 col-md-6 col-sm-12 col-12">
					<select name="" class="form-select"></select>
				</div>
			</div>
			<div class="row pt-2">
				<div class="col-lg-4 col-md-6 col-sm-12 col-12">
					по статусу:
				</div>
				<div class="col-lg-8 col-md-6 col-sm-12 col-12">
					<select name="" class="form-select"></select>
				</div>
			</div>
			<div class="row pt-2">
				<div class="col-lg-4 col-md-6 col-sm-12 col-12">
					по дате:
				</div>
				<div class="col-lg-8 col-md-6 col-sm-12 col-12">
					<select name="" class="form-select"></select>
				</div>
			</div>
		</div>
	</div>
  <?php $order_search_options_arr = [
    'post_title' => 'названию',
    'customer_name' => 'ФИО заказчика',
    'customer_phone' => 'телефону',
    'customer_address' => 'адресу',
  ]; ?>
  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
    <form action="" method="get" class="container card p-2">
     <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6 col-sm-12 col-12 h5">
       Поиск заказа по:
     </div>
     <div class="col-lg-8 col-md-6 col-sm-12 col-12">
       <select name="order_search_option" class="form-select">
        <?php foreach ($order_search_options_arr as $key => $value): ?>
          <option <?php if (isset($_GET['order_search_option']) and $_GET['order_search_option'] == $key): ?>
            selected="selected"
          <?php endif ?> value="<?php echo $key; ?>">
            <?php echo $value; ?>
          </option>
        <?php endforeach ?>
      </select>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-12 pt-2">
     <input name="order_search_value" <?php if (isset($_GET['order_search_value'])): ?>
     value="<?php echo $_GET['order_search_value']; ?>"
     <?php endif ?> type="text" class="form-control" required>
   </div>
 </div>
 <div class="row justify-content-center">
  <div class="col-6 pt-2">
   <button class="btn btn-outline-success w-100" title="Поиск">
    <i class="fa fa-search" aria-hidden="true"></i>
  </button>  
</div>
<div class="col-6 pt-2">
 <a href="?" title="Сброс" class="btn btn-outline-warning w-100">
  <i class="fa fa-times" aria-hidden="true"></i>
</a>
</div>
</div>
</form>
</div>
</div>