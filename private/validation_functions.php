<?php

  // is_blank('abcd')
  function is_blank($value) {
    return !isset($value) || trim($value) === '';
  }

  // has_presence('abcd')
  function has_presence($value) {
    return !is_blank($value);
  }

  // has_length_greater_than('abcd', 3)
  function has_length_greater_than($value, $min) {
    $length = strlen($value);
    return $length > $min;
  }

  // has_length_less_than('abcd', 5)
  function has_length_less_than($value, $max) {
    $length = strlen($value);
    return $length < $max;
  }

  // has_length_exactly('abcd', 4)
  function has_length_exactly($value, $exact) {
    $length = strlen($value);
    return $length == $exact;
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options) {
    if(isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1)) {
      return false;
    } elseif(isset($options['max']) && !has_length_less_than($value, $options['max'] + 1)) {
      return false;
    } elseif(isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

  // has_inclusion_of( 5, [1,3,5] )
  function has_inclusion_of($value, $set) {
  	return in_array($value, $set);
  }

  // has_exclusion_of( 5, [1,3,5] )
  function has_exclusion_of($value, $set) {
    return !in_array($value, $set);
  }

  // has_string('bababa@babab.com', '.com')
  function has_string($value, $required_string) {
    return strpos($value, $required_string) !== false;
  }

  // has_valid_email_format('lalal@lalal.com')
  function has_valid_email_format($value) {
    return filter_var($value, FILTER_VALIDATE_EMAIL);
  }

  // has_unique_username('johndoe')
  function has_unique_username($username, $current_id = "0") {
    $member = Member::find_by_username($username);
    if($member === false || $member->id == $current_id) {
      // is unique
      return true;
    } else {
      // not unique
      return false;
    }
  }

?>
