<?php

function require_login() {
  global $session;
  if(!$session->is_logged_in()) {
    redirect_to(url_for('/member/login.php'));
  }
}

function display_session_errors() {
  global $session;
  $errors = $session->errors();
  $output = '';
  if(!empty($errors)) {
    $output .= "<div class=\"errors\">";
    $output .= "errors:";
    $output .= "<ul>";
    foreach($errors as $error) {
      $output .= "<li>" . h($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  }
  // clear session errors, only display it once.
  $session->clear_errors();
  return $output;
}

function has_session_errors() {
  global $session;
  $errors = $session->errors();
  return !empty($errors);
}

function display_session_message() {
  global $session;
  $msg = $session->message();
  if(isset($msg) && $msg != '') {
    $session->clear_message();
    return '<div id="message">' . h($msg) . '</div>';
  }
}

?>