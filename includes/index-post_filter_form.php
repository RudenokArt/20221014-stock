<?php 
$managers_list = get_users([
  'role' => 'author',
]);
$contractors_list = get_users([
  'role' => 'subscriber',
])
?>

<div class="row justify-content-end pb-2">
     <div class="col-12 col-lg-3 col-md-4 col-sm-6" id="post_filter_form-slide">
      <button class="btn btn-outline-info">
        Фильтр/Поиск 
        <i class="fa fa-chevron-down post_filter_form-slide-icon" aria-hidden="true"></i>
        <i class="fa fa-chevron-up post_filter_form-slide-icon invisible_node" aria-hidden="true"></i>
      </button>
    </div>
  </div>


<div class="row pb-3 justify-content-start" id="post_filter_form">
	<div class="col-lg-6 col-md-6 col-sm-12 col-12">
		<form method="get" action="" class="container card p-2">
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
					<select name="order_manager_filter" class="form-select">
            <option value="">...</option>
            <?php foreach ($managers_list as $key => $value): ?>
             <option
             <?php if (isset($_GET['order_manager_filter']) and $value->data->ID == $_GET['order_manager_filter']): ?>
               selected="selected"
               <?php endif ?> value="<?php echo $value->data->ID; ?>">
               <?php echo $value->data->display_name; ?>
               <?php echo $value->data->user_email; ?>
             </option>
           <?php endforeach ?>
         </select>
       </div>
     </div>
     <div class="row pt-2">
      <div class="col-lg-4 col-md-6 col-sm-12 col-12">
       по подрядчику:
     </div>
     <div class="col-lg-8 col-md-6 col-sm-12 col-12">
       <select name="order_contractor_filter" class="form-select">
        <option value="">...</option>
        <?php foreach ($contractors_list as $key => $value): ?>
         <option
         <?php if (isset($_GET['order_contractor_filter']) and $value->data->ID == $_GET['order_contractor_filter']): ?>
           selected="selected"
           <?php endif ?> value="<?php echo $value->data->ID; ?>">
           <?php echo $value->data->display_name; ?>
           <?php echo $value->data->user_email; ?>
         </option>
       <?php endforeach ?>     
     </select>
   </div>
 </div>
 <div class="row pt-2">
  <div class="col-lg-4 col-md-6 col-sm-12 col-12">
   по статусу:
 </div>
 <div class="col-lg-8 col-md-6 col-sm-12 col-12">
   <select name="order_status_filter" class="form-select">
    <option value="">...</option>
    <?php foreach ($order_statuses_arr as $key => $value): ?>
     <option <?php if (
      isset($_GET['order_status_filter'])
      and
      $_GET['order_status_filter'] !=''
      and
      $key == $_GET['order_status_filter']
    ): ?>
    selected="selected"
    <?php endif ?> value="<?php echo $key; ?>">
    <?php echo $value['title']; ?>
  </option>
<?php endforeach; ?>
</select>
</div>
</div>
<div class="row pt-2">
  <div class="col-lg-4 col-md-6 col-sm-12 col-12">
   по дате:
 </div>
 <div class="col-lg-8 col-md-6 col-sm-12 col-12">
 <div class="row">
      <div class="col-5">
        <input type="text" <?php if (isset($_GET['order_date_from'])): ?>
          value="<?php echo $_GET['order_date_from']; ?>"
        <?php endif ?> name="order_date_from" class="form-control">
      </div>
      <div class="col-1">-</div>
       <div class="col-5">
        <input type="text" <?php if (isset($_GET['order_date_to'])): ?>
          value="<?php echo $_GET['order_date_to']; ?>"
        <?php endif ?> name="order_date_to"  class="form-control">
      </div>
    </div>
 </div>
</div>
<div class="row justify-content-center">
  <div class="col-6 pt-2">
   <button name="order_filter" value="Y" class="btn btn-outline-success w-100" title="Поиск">
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

<script>
  $(function () {
    $('select[name="order_contractor_filter"]').change(function () {
      $('select[name="order_status_filter"]').prop('value','');
    });
    $('select[name="order_status_filter"]').change(function () {
      $('select[name="order_contractor_filter"]').prop('value','');
    });
  });

  $( function() {
    $('input[name="order_date_from"], input[name="order_date_to"]').datepicker({
      dateFormat: "yy-mm-dd",
    });

    $(function () {
    $('#post_filter_form').hide();
    $('#post_filter_form-slide').click(function () {
      $('#post_filter_form').slideToggle();
      $('.post_filter_form-slide-icon').toggle();
    });
    
  });

  } );
</script>