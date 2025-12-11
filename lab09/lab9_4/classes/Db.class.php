<?php
class Db
{
    private $_numRow;
    private $dbh = null;

    public function __construct()
    {
        $driver = "mysql:host=" . HOST . "; dbname=" . DB_NAME . ";charset=utf8";
        try {
            $this->dbh = new PDO($driver, DB_USER, DB_PASS);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->query("set names 'utf8'");
        } catch (PDOException $e) {
            // Removed exit() to prevent site crash.
            echo "Lỗi kết nối CSDL: " . $e->getMessage();
        }
    }

    public function __destruct()
    {
        $this->dbh = null;
    }

    public function getRowCount()
    {
        return $this->_numRow;
    }

    private function query($sql, $arr = array(), $mode = PDO::FETCH_ASSOC)
    {
        try {
            $stm = $this->dbh->prepare($sql);
            $stm->execute($arr);
            
            $this->_numRow = $stm->rowCount();
            
            if (stripos(trim($sql), 'SELECT') === 0 || stripos(trim($sql), 'show') === 0) {
                return $stm->fetchAll($mode);
            }
            
            return [];
            
        } catch (PDOException $e) {
            // Removed exit() to prevent site crash.
            // Displays error in a formatted way for easier debugging.
            echo "<div style='background: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; margin: 10px 0;'>";
            echo "<strong>Lỗi SQL:</strong> " . $e->getMessage() . "<br>";
            echo "<strong>Câu lệnh:</strong> " . $sql;
            echo "</div>";
            return null; // Return null on error to prevent further processing
        }
    }

    public function exeQuery($sql,  $arr = array(), $mode = PDO::FETCH_ASSOC)
    {
        return $this->query($sql, $arr, $mode);
    }

    public function exeNoneQuery($sql,  $arr = array(), $mode = PDO::FETCH_ASSOC)
    {
        $this->query($sql, $arr, $mode);
        return $this->getRowCount();
    }

    public function countItems($sql, $arr = array())
    {
        $data = $this->exeQuery($sql, $arr, PDO::FETCH_BOTH);
        if (isset($data[0][0])) {
            return $data[0][0];
        }
        return 0;
    }
}
?>