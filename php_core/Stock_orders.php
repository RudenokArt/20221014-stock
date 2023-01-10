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
    AND `wp_term_relationships`.`term_taxonomy_id`='.$this->order_category->term_id.'
    ORDER BY `wp_posts`.`ID` DESC' ;

    // поиск по названию заказа
    if (isset($_GET['order_search_option']) and $_GET['order_search_option'] == 'post_title') {
      $this->sql = 'SELECT `ID` FROM `wp_posts`
      JOIN `wp_term_relationships` 
      ON `wp_posts`.`ID`=`wp_term_relationships`.`object_id`
      WHERE `wp_posts`.`post_status`="publish"
      AND `wp_posts`.`post_title` LIKE "%'.$_GET['order_search_value'].'%"
      AND `wp_posts`.`post_type`="post"
      AND `wp_term_relationships`.`term_taxonomy_id`='.$this->order_category->term_id.'
      ORDER BY `wp_posts`.`ID` DESC' ;
    }

    // поиск по ФИО заказчика, телефону, адресу
    if (
      isset($_GET['order_search_option'])
      and
      (
        $_GET['order_search_option'] == 'customer_name'
        or
        $_GET['order_search_option'] == 'customer_phone'
        or
        $_GET['order_search_option'] == 'customer_address'
      )) {
      $this->sql = 'SELECT * FROM `wp_posts`
      JOIN `wp_term_relationships` 
      ON `wp_posts`.`ID`=`wp_term_relationships`.`object_id`
      JOIN `wp_postmeta`
      ON `wp_posts`.`ID`=`wp_postmeta`.`post_id`
      WHERE `wp_posts`.`post_status`="publish"
      AND `wp_posts`.`post_type`="post"
      AND `wp_term_relationships`.`term_taxonomy_id`='.$this->order_category->term_id.'
      AND `wp_postmeta`.`meta_key`="'.$_GET['order_search_option'].'"
      AND `wp_postmeta`.`meta_value` LIKE "%'.$_GET['order_search_value'].'%"
      ORDER BY `wp_posts`.`ID` DESC';
    }

    if (isset($_GET['order_filter'])) {
      $sql_filter_and = '';
      $sql_filter_join = '';
      if (isset($_GET['order_manager_filter']) and $_GET['order_manager_filter']) {
        $sql_filter_and = $sql_filter_and . ' AND `wp_posts`.`post_author`='.$_GET['order_manager_filter'];
      }
      if (isset($_GET['order_contractor_filter']) and $_GET['order_contractor_filter']) {
        $sql_filter_join = 'JOIN `wp_postmeta` ON `wp_posts`.`ID`=`wp_postmeta`.`post_id`';
        $sql_filter_and = $sql_filter_and .
        ' AND `wp_postmeta`.`meta_key`="order_contractor" AND `wp_postmeta`.`meta_value`='.$_GET['order_contractor_filter'];
      }
      if (isset($_GET['order_status_filter']) and $_GET['order_status_filter'] != '') {
        $sql_filter_join = 'JOIN `wp_postmeta` ON `wp_posts`.`ID`=`wp_postmeta`.`post_id`';
        $sql_filter_and = $sql_filter_and .
        ' AND `wp_postmeta`.`meta_key`="order_status" AND `wp_postmeta`.`meta_value`='.$_GET['order_status_filter'];
      }


      $this->sql = 'SELECT `ID` FROM `wp_posts`
      JOIN `wp_term_relationships` 
      ON `wp_posts`.`ID`=`wp_term_relationships`.`object_id`
      '.$sql_filter_join.'
      WHERE `wp_posts`.`post_status`="publish"
      AND `wp_posts`.`post_type`="post"
      AND `wp_term_relationships`.`term_taxonomy_id`='.$this->order_category->term_id.
      $sql_filter_and.'
      ORDER BY `wp_posts`.`ID` DESC';

      echo $sql_filter_and;
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