<!doctype html>

<html lang="en">
  <head>
    <title>Member List <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/public.css'); ?>" />
  </head>

  <body>

    <header>
      <h1>
        <a href="<?php echo url_for('/index.php'); ?>">Home</a>
      </h1>
      <?php if($session->is_logged_in()) { ?>
      <navigation>
        <ul>
          <li>User: <?php echo $session->username; ?></li>
          <li><a href="<?php echo url_for('/member/logout.php'); ?>">Logout</a></li>
        </ul>
      </navigation>
      <?php } ?>
    </header>
