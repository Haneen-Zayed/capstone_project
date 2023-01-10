<?php

namespace Core\Model;

use Core\Base\Model;

class Item extends Model
{
    public function get_available_item(): array
    {
        $data = array();
        $result = $this->connection->query("SELECT * FROM items WHERE stock > 0");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function get_expensive_item(): array
    {
        $data = array();
        $result = $this->connection->query("SELECT * FROM $this->table ORDER BY selling_price DESC LIMIT 5");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function get_item_transactions($transaction_id)
    {
        $result = $this->connection->query("SELECT * FROM items JOIN usertransactions ON items.id = usertransactions.item_id  WHERE usertransactions.transaction_id= $transaction_id");
        return $result->fetch_object();
    }
}