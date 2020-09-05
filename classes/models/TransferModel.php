<?php

class TransferModel extends Database
{

  public static function store_sender($sender)
  {
    $stmt = $this->run_query('INSERT INTO senders VALUES (NULL, :sender)', ['sender' => $sender]);
    $result = $stmt->fetch();
    return $result['LAST_INSERT_ID()'];
  }

  public static function store_file($sender_id)
  {
    $this->run_query('INSERT INTO files VALUES (NULL, :file_name, 0, NOW(), :zip_name, :sender_id)', ['file_name' => $file_name, 'zip_name' => $zip_name, 'sender_id' => $sender_id]);
  }
}
