<?php

class Member extends DatabaseObject {

  static protected $table_name = "members";
  static protected $db_columns = ['id', 'first_name', 'last_name', 'email', 'username', 'hashed_password'];

  public $id;
  public $first_name;
  public $last_name;
  public $email;
  public $username;
  protected $hashed_password;
  public $password;
  public $confirm_password;

  public function __construct($args = []) {
    $this->first_name = $args['first_name'] ?? '';
    $this->last_name = $args['last_name'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->username = $args['username'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->confirm_password = $args['confirm_password'] ?? '';
  }

  static public function find_by_username($username) {
    $sql = "SELECT * FROM members ";
    $sql .= "WHERE username=?";
    // prevent sql injection
    $stmt = self::$database->prepare($sql);
    // bind integer id;
    $stmt->bind_param("s", $username);
    $obj_array = self::find_by_stmt($stmt);

    if (!empty($obj_array)) {
      // just 1 obj for id;
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_by_email($email) {
    $sql = "SELECT * FROM members ";
    $sql .= "WHERE email=?";
    // prevent sql injection
    $stmt = self::$database->prepare($sql);
    // bind integer id;
    $stmt->bind_param("s", $email);
    $obj_array = self::find_by_stmt($stmt);

    if (!empty($obj_array)) {
      // just 1 obj for id;
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public function full_name() {
    return $this->first_name . " " . $this->last_name;
  }

  protected function set_hashed_password() {
    $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
  }

  public function verify_password($password) {
    return password_verify($password, $this->hashed_password);
  }

  protected function create() {
    $this->set_hashed_password();
    return parent::create();
  }

  protected function validate() {
    $this->errors = [];

    if(is_blank($this->first_name)) {
      $this->errors[] = "First name cannot be blank.";
    } elseif (!has_length($this->first_name, array('min' => 2, 'max' => 255))) {
      $this->errors[] = "First name must be between 2 and 255 characters.";
    }

    if(is_blank($this->last_name)) {
      $this->errors[] = "Last name cannot be blank.";
    } elseif (!has_length($this->last_name, array('min' => 2, 'max' => 255))) {
      $this->errors[] = "Last name must be between 2 and 255 characters.";
    }

    if(is_blank($this->email)) {
      $this->errors[] = "Email cannot be blank.";
    } elseif (!has_length($this->email, array('max' => 255))) {
      $this->errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($this->email)) {
      $this->errors[] = "Email must be a valid format.";
    }

    if(is_blank($this->username)) {
      $this->errors[] = "Username cannot be blank.";
    } elseif (!has_length($this->username, array('min' => 3, 'max' => 255))) {
      $this->errors[] = "Username must be between 3 and 255 characters.";
    } elseif (!has_unique_username($this->username, $this->id ?? 0)) {
      $this->errors[] = "Username already exist. Try another.";
    }

    if(is_blank($this->password)) {
      $this->errors[] = "Password cannot be blank.";
    } elseif (!has_length($this->password, array('min' => 6))) {
      $this->errors[] = "Password must contain 6 or more characters";
    }

    if(is_blank($this->confirm_password)) {
      $this->errors[] = "Confirm password cannot be blank.";
    } elseif ($this->password !== $this->confirm_password) {
      $this->errors[] = "Password and confirm password must match.";
    }

    return $this->errors;
  }

}

?>
