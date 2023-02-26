<?php

class Database {
  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $dbname = DB_NAME;

  private $handler;
  private $statement;
  private $error;

  public function __construct() {
    $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
    $options = [
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

    ];

    try {
      $this->handler = new PDO($dsn, $this->user, $this->pass, $options);
    }
    catch(PDOException $error) {
      $this->error = $error;
      echo "An error has occurred, try again later.";
    }
  }

  public function query($sql) {
    $this->statement = $this->handler->prepare($sql);
  }

  public function bind($parameter, $value, $type = null) {
    if (is_null($type)) {
      if (is_string($value)) $type = PDO::PARAM_STR;
      if (is_int($value)) $type = PDO::PARAM_INT;
      if (is_bool($value)) $type = PDO::PARAM_BOOL;
    }

    $this->statement->bindValue($parameter, $value, $type);
  }

  public function fetch() {
    $this->statement->execute();

    return $this->statement->fetchAll(PDO::FETCH_OBJ);
  }

  public function fetchOne() {
    $this->statement->execute();

    return $this->statement->fetch(PDO::FETCH_OBJ);
  }
}