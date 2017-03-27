<!--
  Connect class constructs mysqli connection object.
  Connect::getConnection() returns the constructed connection object.
-->

<?php
  class Connect
  {
    private $conn;

    function __construct() {
      $this->conn = new mysqli('localhost', 'root', '', 'login');
      if($this->conn->connect_error) {
          die('Connect Error (' . $conn->connect_errno . ') '
            . $conn->connect_error);
      }
    }

    public function getConnection() {
      return $this->conn;
    }
  }
?>