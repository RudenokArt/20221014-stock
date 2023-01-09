<?php 

/**
 *  
 */
class Stock_orders {

  function __construct() {

    $this->order_category = get_category_by_slug('order');

    $this->sql = 'SELECT `ID` FROM `wp_posts`
    JOIN `wp_term_relationships` 
    ON `wp_posts`.`ID`=`wp_term_relationships`.`object_id`
    WHERE `wp_posts`.`post_status`="publish"
    AND `wp_posts`.`post_type`="post"
    AND `wp_term_relationships`.`term_taxonomy_id`='.$this->order_category->term_id.' ORDER BY `wp_posts`.`ID` DESC' ;

    // поиск по названию заказа
    if (isset($_GET['order_search_option']) and $_GET['order_search_option'] == 'post_title') {
      $this->sql = 'SELECT `ID` FROM `wp_posts`
      JOIN `wp_term_relationships` 
      ON `wp_posts`.`ID`=`wp_term_relationships`.`object_id`
      WHERE `wp_posts`.`post_status`="publish"
      AND `wp_posts`.`post_title` LIKE "%'.$_GET['order_search_value'].'%"
      AND `wp_posts`.`post_type`="post"
      AND `wp_term_relationships`.`term_taxonomy_id`='.$this->order_category->term_id.' ORDER BY `wp_posts`.`ID` DESC' ;
    }


    $this->orders_arr = $this->sqlRequest($this->sql);
    $this->pagination = array_chunk($this->orders_arr, 10);
    $this->current_page = 1;
    if (isset($_GET['page'])) {
      $this->current_page = $_GET['page'];
    }
  }

  function sqlRequest ($sql) {
    global $wpdb;
    $arr = $wpdb->get_results($sql);
    foreach ($arr as $key => $value) {
      $arr[$key] = $value->ID;
    }
    return $arr;
  }

  

}


?>