<?php

require_once('../../private/initialize.php');

if(is_post_request()) {

  // Create record using post parameters
  $args = $_POST['member'];
  $member = new Member($args);
  $result = $member->save();

  if($result === true) {
    $new_id = $member->id;
    $_SESSION['message'] = 'The member was created successfully.';
  } else {
    $_SESSION['errors'] = $member->errors;
  }
  redirect_to(url_for('/member/sign-up.php'));
} else {
  // display the form
  $member = new Member;
}

?>

<?php $page_title = 'Create Member'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="content">
  <?php echo display_session_message(); ?>
  <a class="back-link" href="<?php echo url_for('/index.php'); ?>">&laquo; Back</a>

  <div class="member new">
    <h1>Create Member</h1>

    <?php echo display_session_errors(); ?>

    <form action="<?php echo url_for('/member/sign-up.php'); ?>" method="post">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Create Member" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
