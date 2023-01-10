<?php

namespace Core\Model;

use Core\Base\Model;

class Transaction extends Model
{
    public function last_id_transaction()
    {   
        $result = $this->connection->query("SELECT * FROM transactions ORDER BY created_at DESC LIMIT 1");
        return $result->fetch_object();
    }

    public function get_user_transactions($user_id): array
    {
        $data = array();
        $result = $this->connection->query("SELECT * FROM transactions JOIN usertransactions ON transactions.id = usertransactions.transaction_id  WHERE usertransactions.user_id= $user_id");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data[] = $row;
            }
        }
        return $data;
    }
}