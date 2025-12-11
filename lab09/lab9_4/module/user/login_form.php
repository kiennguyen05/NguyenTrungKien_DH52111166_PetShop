<h3>Đăng nhập</h3>
<p>Bạn cần đăng nhập để tiếp tục thanh toán.</p>
<?php if (isset($error_msg)) echo "<p style='color:red;'>$error_msg</p>"; ?>
<form action="index.php?mod=user&ac=login" method="post">
    <table style="width: 50%;">
        <tr>
            <td>Tên đăng nhập:</td>
            <td><input type="text" name="username" required></td>
        </tr>
        <tr>
            <td>Mật khẩu:</td>
            <td><input type="password" name="password" required></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Đăng nhập"></td>
        </tr>
    </table>
</form>
<p>Chưa có tài khoản? <a href="index.php?mod=user&ac=register">Đăng ký ngay</a>.</p>
