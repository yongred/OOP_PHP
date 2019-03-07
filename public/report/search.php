<?php require_once('../../private/initialize.php'); ?>
<?php

if (is_get_request() && isset($_GET['email'])) {
  $arg = trim($_GET['email']);
  $targetEmail = Member::find_by_email($arg);
  if ($targetEmail) {
    echo json_encode(array("res" => "Email exist"));
  } else {
    echo json_encode(array("res" => "Email Not exist"));
  }
}


?>