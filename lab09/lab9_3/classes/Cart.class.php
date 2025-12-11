<?php
class Cart extends Db{
	private $_cart;
	private $_num_item =0;

	public function __construct()
	{
		parent::__construct(); // Call parent constructor to establish DB connection
		if(!isset($_SESSION["cart"])) {
			$_SESSION["cart"] = array();
		}
		$this->_cart = $_SESSION["cart"];
		$this->_num_item = array_sum($this->_cart);
	}

	public function getNumItem()
	{
		return $this->_num_item;
	}

	public function __destruct()
	{
		$_SESSION["cart"] = $this->_cart;
	}

	public function bookExist($book_id)
	{
		$sql="select * from book where book_id = ?";
		$this->exeQuery($sql, array($book_id));
		return $this->getRowCount() > 0;
	}

	public function add($id, $quantity=1)
	{
		if (empty($id) || $quantity < 1 || !$this->bookExist($id)) {
			return false;
		}

		if (isset($this->_cart[$id])) {
			$this->_cart[$id] += $quantity;
		} else {
			$this->_cart[$id] = $quantity;
		}
		$this->_num_item = array_sum($this->_cart);
		$_SESSION["cart"] = $this->_cart; // Ensure session is updated
		return true;
	}

	public function remove($id)
	{
		if (isset($this->_cart[$id])) {
			unset($this->_cart[$id]);
			$this->_num_item = array_sum($this->_cart);
			$_SESSION["cart"] = $this->_cart;
		}
	}

	public function update($id, $quantity)
	{
        if (isset($this->_cart[$id])) {
            if ($quantity > 0) {
                $this->_cart[$id] = $quantity;
            } else {
                $this->remove($id);
            }
            $this->_num_item = array_sum($this->_cart);
            $_SESSION["cart"] = $this->_cart;
        }
	}
    
    public function getCartDetails()
    {
        if (empty($this->_cart)) {
            return array();
        }

        $book_ids = array_keys($this->_cart);
        // Create placeholders for the IN clause
        $placeholders = implode(',', array_fill(0, count($book_ids), '?'));
        
        $sql = "SELECT book_id, book_name, img, price FROM book WHERE book_id IN ($placeholders)";
        $books_info = $this->exeQuery($sql, $book_ids);

        $detailed_cart = array();
        $total = 0;

        foreach ($books_info as $book) {
            $id = $book['book_id'];
            $quantity = $this->_cart[$id];
            $subtotal = $book['price'] * $quantity;
            $total += $subtotal;
            $detailed_cart[] = array(
                'id' => $id,
                'name' => $book['book_name'],
                'img' => $book['img'],
                'price' => $book['price'],
                'quantity' => $quantity,
                'subtotal' => $subtotal
            );
        }

        return array('items' => $detailed_cart, 'total' => $total);
    }
}
?>