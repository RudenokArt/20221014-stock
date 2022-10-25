<?php 

var_dump(add_user_meta( 2, 'tg_id', '123456789', true));

?>
<pre><?php print_r(get_user_meta(2)); ?></pre>
<hr>
<pre><?php print_r(get_users()); ?></pre>