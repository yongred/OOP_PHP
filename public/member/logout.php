<?php
require_once('../../private/initialize.php');

// Log out member
$session->logout();

redirect_to(url_for('/member/login.php'));

?>
