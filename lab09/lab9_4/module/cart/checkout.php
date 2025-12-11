<h2>Thanh toán</h2>
<?php
// The global $cart object is available here.

// Check if cart is empty
if ($cart->getNumItem() == 0) {
    echo "<p>Giỏ hàng của bạn đang trống. Vui lòng thêm sản phẩm vào giỏ trước khi thanh toán.</p>";
    echo '<a href="index.php">Tiếp tục mua sắm</a>';
    return; // Stop further rendering
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<h4>Vui lòng đăng nhập để thanh toán</h4>";
    // Include the login form
    if (isset($error_msg)) {
        // Make sure error message from controller is visible
        echo "<p style='color:red;'>$error_msg</p>";
    }
    include ROOT . "/module/user/login_form.php";
} else {
    // User is logged in, show shipping form
    $user = new User();
    $user_info = $user->getById($_SESSION['user_id']);
?>
    <h4>Thông tin nhận hàng</h4>
    <p>Xin chào <strong><?php echo htmlspecialchars($user_info['hoten']); ?></strong>. Vui lòng điền thông tin để nhận hàng.</p>

    <form action="index.php?mod=cart&ac=process_checkout" method="post">
        <table>
            <tr>
                <td>Tên người nhận:</td>
                <td><input type="text" name="shipping_name" value="<?php echo htmlspecialchars($user_info['hoten']); ?>" required></td>
            </tr>
            <tr>
                <td>Địa chỉ nhận hàng:</td>
                <td><input type="text" name="shipping_address" value="<?php echo htmlspecialchars($user_info['diachi']); ?>" required style="width: 300px;"></td>
            </tr>
            <tr>
                <td>Số điện thoại:</td>
                <td><input type="text" name="shipping_phone" value="<?php echo htmlspecialchars($user_info['dienthoai']); ?>" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Hoàn tất đơn hàng"></td>
            </tr>
        </table>
    </form>
<?php
}
?>