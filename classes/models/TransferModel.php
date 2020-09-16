<?php

class TransferModel extends Database
{

  public function store_sender($sender)
  {
    $this->run_query('INSERT INTO senders VALUES (NULL, :sender)', ['sender' => $sender]);

    $stmt = $this->run_query('SELECT sender_id FROM senders ORDER BY sender_id DESC LIMIT 1');
    $last_sender_id = $stmt->fetch();
    return $last_sender_id['sender_id'];
  }

  public function store_file($file_name, $zip_name, $sender_id)
  {
    $this->run_query('INSERT INTO files VALUES (NULL, :file_name, 0, NOW(), :zip_name, :sender_id)', ['file_name' => $file_name, 'zip_name' => $zip_name, 'sender_id' => $sender_id]);
  }
}
