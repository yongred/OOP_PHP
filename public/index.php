<?php require_once('../private/initialize.php'); ?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">

  <ul id="menu">
    <li><a href="<?php echo url_for('/member/sign-up.php'); ?>">Sign Up</a></li>
    <li><a href="<?php echo url_for('/report/members.php'); ?>">Report</a></li>
    <?php if(!$session->is_logged_in()) { ?>
    <li><a href="<?php echo url_for('/member/login.php'); ?>">Login</a></li>
    <?php } ?>
  </ul>
    
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
