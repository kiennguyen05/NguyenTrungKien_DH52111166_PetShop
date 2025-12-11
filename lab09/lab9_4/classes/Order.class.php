<?php
class Order extends Db {

    /**
     * Creates a new order in the database.
     * @param int $user_id The ID of the logged-in user.
     * @param array $shipping_info Associative array with recipient's info.
     * @param array $cart_data The result from Cart->getCartDetails().
     * @return bool|int The new order ID on success, false on failure.
     */
    public function create($user_id, $shipping_info, $cart_data) {
        if (empty($user_id) || empty($shipping_info) || empty($cart_data['items'])) {
            return false;
        }

        try {
            // This is a simplified transaction for PDO.
            $this->getDbh()->beginTransaction();

            // 1. Insert into 'orders' table
            $sql_order = "INSERT INTO orders (user_id, order_date, hoten_nguoinhan, diachi_nguoinhan, dienthoai_nguoinhan, total, status)
                          VALUES (:user_id, :order_date, :name, :address, :phone, :total, 0)";
            
            $arr_order = [
                ':user_id' => $user_id,
                ':order_date' => date('Y-m-d H:i:s'),
                ':name' => $shipping_info['name'],
                ':address' => $shipping_info['address'],
                ':phone' => $shipping_info['phone'],
                ':total' => $cart_data['total']
            ];

            // exeNoneQuery returns the number of affected rows, so we just execute it.
            $this->exeNoneQuery($sql_order, $arr_order);

            // 2. Get the last inserted order ID
            $order_id = $this->getDbh()->lastInsertId();
            if (!$order_id) {
                throw new Exception("Failed to create order record.");
            }

            // 3. Insert into 'order_detail' table for each item
            $sql_detail = "INSERT INTO order_detail (order_id, book_id, quantity, price)
                           VALUES (:order_id, :book_id, :quantity, :price)";

            foreach ($cart_data['items'] as $item) {
                $arr_detail = [
                    ':order_id' => $order_id,
                    ':book_id' => $item['id'],
                    ':quantity' => $item['quantity'],
                    ':price' => $item['price']
                ];
                $this->exeNoneQuery($sql_detail, $arr_detail);
            }

            // If all queries were successful, commit the transaction
            $this->getDbh()->commit();
            return $order_id;

        } catch (Exception $e) {
            // If any query fails, roll back the changes
            $this->getDbh()->rollBack();
            // Optionally log the error: error_log($e->getMessage());
            return false;
        }
    }
    
    // We need a public accessor for the PDO handle to use transaction methods
    private function getDbh() {
        // Reflection to access private property of parent
        $reflection = new ReflectionProperty('Db', 'dbh');
        $reflection->setAccessible(true);
        return $reflection->getValue($this);
    }
}
?>