<?php 

/**
 * 
 */
class Stock_user {
  
  function __construct() {
    $this->current_user = wp_get_current_user();
    $this->manager_access = $this->managerAccess();
    $this->contractor_access = $this->contractorAccess();
  }

  function contractorAccess () {
    return in_array('subscriber', $this->current_user->roles);
  }

  function managerAccess () {
    return (
      in_array('administrator', $this->current_user->roles)
      or
      in_array('author', $this->current_user->roles)
    );
  }


}

?>