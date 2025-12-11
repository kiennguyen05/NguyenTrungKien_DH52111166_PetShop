<?php
class User extends Db {

    /**
     * Checks user credentials against the database.
     * @param string $username
     * @param string $password
     * @return array User data on success, empty array on failure.
     */
    public function login($username, $password) {
        // For this example, we're storing passwords as plain text.
        // In a real application, you should use password_hash() and password_verify().
        $sql = "SELECT * FROM user WHERE username = :username AND password = :password";
        $arr = array(':username' => $username, ':password' => $password);
        $result = $this->exeQuery($sql, $arr);
        if ($this->getRowCount() > 0) {
            return $result[0]; // Return user data
        }
        return array();
    }

    /**
     * Registers a new user.
     * @param string $username
     * @param string $password
     * @param string $email
     * @param string $fullname
     * @return bool True on success, false on failure (e.g., user exists).
     */
    public function register($username, $password, $email, $fullname) {
        // Check if username already exists
        $sql_check = "SELECT * FROM user WHERE username = :username";
        $this->exeQuery($sql_check, array(':username' => $username));
        if ($this->getRowCount() > 0) {
            return false; // User already exists
        }

        $sql = "INSERT INTO user (username, password, email, hoten) VALUES (:username, :password, :email, :fullname)";
        $arr = array(
            ':username' => $username,
            ':password' => $password, // Storing plain text
            ':email'    => $email,
            ':fullname' => $fullname
        );
        return $this->exeNoneQuery($sql, $arr) > 0;
    }

    public function getById($user_id)
    {
        $sql = "SELECT * FROM user WHERE user_id = :user_id";
        $arr = array(":user_id" => $user_id);
		$data = $this->exeQuery($sql, $arr);
		if (Count($data)>0) return $data[0];
		else return array();
    }
}
?>