<?php require_once('../../private/initialize.php'); ?>
<?php require_login(); ?>

<?php
// Find all members
$members = Member::find_all();

?>
<?php $page_title = 'Report Members'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">

  <div id="page">
    <div class="search-container">
        Search Email Exist: <input type="text" name="email" id="email-search-input" />
        <button id="email-search-btn">submit</button>
    </div>
    <div id="email-search-result"></div>
    <div class="intro">
      <h2>The Members Report</h2>
    </div>

    <table id="members">
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Username</th>
        <th>Email</th>
      </tr>

      <?php foreach($members as $member) { ?>
        <tr>
          <td><?php echo h($member->first_name); ?></td>
          <td><?php echo h($member->last_name); ?></td>
          <td><?php echo h($member->username); ?></td>
          <td><?php echo h($member->email); ?></td>
        </tr>
      <?php } ?>

    </table>
  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
