<?php
if(!isset($member)) {
  redirect_to(url_for('/index.php'));
}
?>

<dl>
  <dt>First name</dt>
  <dd><input type="text" name="member[first_name]" value="<?php echo h($member->first_name); ?>" /></dd>
</dl>

<dl>
  <dt>Last name</dt>
  <dd><input type="text" name="member[last_name]" value="<?php echo h($member->last_name); ?>" /></dd>
</dl>

<dl>
  <dt>Email</dt>
  <dd><input type="text" name="member[email]" value="<?php echo h($member->email); ?>" /></dd>
</dl>

<dl>
  <dt>Username</dt>
  <dd><input type="text" name="member[username]" value="<?php echo h($member->username); ?>" /></dd>
</dl>

<dl>
  <dt>Password</dt>
  <dd><input type="password" name="member[password]" value="" /></dd>
</dl>

<dl>
  <dt>Confirm Password</dt>
  <dd><input type="password" name="member[confirm_password]" value="" /></dd>
</dl>
