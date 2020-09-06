<?php

class TransferModel extends Database
{

  public function store_sender($sender)
  {
    $this->run_query('INSERT INTO senders VALUES (NULL, :sender)', ['sender' => $sender]);
    $stmt = $this->run_query('SELECT LAST_INSERT_ID()');
    return $stmt[0]['LAST_INSERT_ID()'];
  }

  public function store_file($file_name, $zip_name, $sender_id)
  {
    $this->run_query('INSERT INTO files VALUES (NULL, :file_name, 0, NOW(), :zip_name, :sender_id)', ['file_name' => $file_name, 'zip_name' => $zip_name, 'sender_id' => $sender_id]);
  }
}
