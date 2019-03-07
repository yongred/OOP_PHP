<?php

class DatabaseObject {

  static protected $database;
  static protected $table_name = "";
  static protected $columns = [];
  public $errors = [];

  static public function set_database($database) {
    self::$database = $database;
  }

  static public function find_by_sql($sql) {
    $result = self::$database->query($sql);
    if(!$result) {
      exit("Database query failed.");
    }

    // results into objects
    $object_array = [];
    while($record = $result->fetch_assoc()) {
      $object_array[] = static::instantiate($record);
    }

    $result->free();

    return $object_array;
  }


  static public function find_by_stmt($stmt) {
    $stmt->execute();
    $result = $stmt->get_result();

    // convert into objs
    $object_array = [];

    while ($record = $result->fetch_assoc()) {
      // this class objs array
      $object_array[] = self::instantiate($record);
    }
    // free
    $result->free();

    return $object_array;
  }

  static public function find_all() {
    $sql = "SELECT * FROM " . static::$table_name;
    return static::find_by_sql($sql);
  }

  static public function count_all() {
    $sql = "SELECT COUNT(*) FROM " . static::$table_name;
    $result_set = self::$database->query($sql);
    $row = $result_set->fetch_array();
    return array_shift($row);
  }

  static public function find_by_id($id) {
    $sql = "SELECT * FROM members ";
    $sql .= "WHERE id=?";
    // prevent sql injection
    $stmt = self::$database->prepare($sql);
    // bind integer id;
    $stmt->bind_param("i", $id);
    $obj_array = self::find_by_stmt($stmt);

    if (!empty($obj_array)) {
      // just 1 obj for id;
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static protected function instantiate($record) {
    // inherited class obj
    $object = new static;
    // automatically assignment re-usable
    foreach($record as $property => $value) {
      if(property_exists($object, $property)) {
        $object->$property = $value;
      }
    }
    return $object;
  }

  protected function validate() {
    $this->errors = [];
    return $this->errors;
  }

  protected function create() {
    $this->validate();
    if(!empty($this->errors)) {
      return false; 
    }
    // all class attributes vals insert to db_columns
    $attributes = $this->sanitized_attributes();
    $sql = "INSERT INTO " . static::$table_name . " (";
    $sql .= join(', ', array_keys($attributes));
    $sql .= ") VALUES ('";
    $sql .= join("', '", array_values($attributes));
    $sql .= "')";
    $result = self::$database->query($sql);
    if($result) {
      // auto generated id.
      $this->id = self::$database->insert_id;
    }
    return $result;
  }

  protected function update() {
    $this->validate();
    if(!empty($this->errors)) { return false; }

    $attributes = $this->sanitized_attributes();
    $attribute_pairs = [];
    foreach($attributes as $key => $value) {
      $attribute_pairs[] = "{$key}='{$value}'";
    }

    $sql = "UPDATE " . static::$table_name . " SET ";
    $sql .= join(', ', $attribute_pairs);
    $sql .= " WHERE id='" . self::$database->real_escape_string($this->id) . "' ";
    $sql .= "LIMIT 1";
    $result = self::$database->query($sql);
    return $result;
  }

  public function save() {
    // A new record will not have an ID yet
    if(isset($this->id)) {
      return $this->update();
    } else {
      return $this->create();
    }
  }

  public function merge_attributes($args = []) {
    // technique to populate attributes
    foreach($args as $key => $value) {
      if(property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
  }

  // Properties which have database columns, excluding ID
  public function attributes() {
    $attributes = [];
    foreach(static::$db_columns as $column) {
      if ($column == 'id') {
        continue; 
      }
      // assign class attribute val to res.
      $attributes[$column] = $this->$column;
    }
    return $attributes;
  }

  protected function sanitized_attributes() {
    $sanitized = [];
    foreach($this->attributes() as $key => $value) {
      $sanitized[$key] = self::$database->real_escape_string($value);
    }
    return $sanitized;
  }

  public function get_errors() {
    return $this->errors;
  }

}

?>