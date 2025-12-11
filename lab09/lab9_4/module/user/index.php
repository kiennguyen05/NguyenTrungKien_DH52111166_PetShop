<?php
if (!defined("ROOT")) { die("Access denied"); }

$user_obj = new User();
$ac = Utils::getIndex("ac", "login");

if ($ac == "login") {
    if (isset($_POST['username'])) { // Form submitted
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user_data = $user_obj->login($username, $password);
        if ($user_data) {
            $_SESSION['user_id'] = $user_data['user_id'];
            $_SESSION['username'] = $user_data['username'];
            // Redirect to the cart, or wherever they came from
            header("Location: index.php?mod=cart&ac=checkout");
            exit();
        } else {
            $error_msg = "Tên đăng nhập hoặc mật khẩu không đúng.";
            include "module/user/login_form.php";
        }
    } else {
        include "module/user/login_form.php";
    }

} elseif ($ac == "register") {
    if (isset($_POST['username'])) { // Form submitted
        // Basic validation
        if ($_POST['password'] !== $_POST['password_confirm']) {
            $error_msg = "Mật khẩu không khớp.";
            include "module/user/register_form.php";
        } else {
            if ($user_obj->register($_POST['username'], $_POST['password'], $_POST['email'], $_POST['fullname'])) {
                // Automatically log the user in
                $user_data = $user_obj->login($_POST['username'], $_POST['password']);
                $_SESSION['user_id'] = $user_data['user_id'];
                $_SESSION['username'] = $user_data['username'];
                header("Location: index.php?mod=cart&ac=checkout");
                exit();
            } else {
                $error_msg = "Tên đăng nhập đã tồn tại.";
                include "module/user/register_form.php";
            }
        }
    } else {
        include "module/user/register_form.php";
    }

} elseif ($ac == "logout") {
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    session_destroy();
    header("Location: index.php");
    exit();
}
?>