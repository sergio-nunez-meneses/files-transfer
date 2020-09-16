<?php
require('tools/sql.php');

class Database
{

  private $pdo;

  protected function connexion()
  {
    $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHAR, DB_USER, DB_PASS, PDO_OPTIONS);

    if (empty($this->pdo) === FALSE)
    {
      // echo 'Connected to ' . DB_NAME . ' database!<br>';
      return TRUE;
    }
    else
    {
      echo 'Failed connecting to database. <br>';
      return FALSE;
    }
  }

  protected function run_query($sql, $placeholders = [])
  {
    if ($this->connexion() === TRUE)
    {
      if (empty($placeholders))
      {
        return $this->pdo->query($sql);
      }
      else
      {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($placeholders);
        return $stmt;
      }
    }
    else
    {
      echo 'Failed performing requested query. <br>';
      return FALSE;
    }
  }
}
