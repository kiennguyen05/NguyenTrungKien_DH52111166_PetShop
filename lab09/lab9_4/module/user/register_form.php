<h3>Đăng ký tài khoản</h3>
<?php if (isset($error_msg)) echo "<p style='color:red;'>$error_msg</p>"; ?>
<form action="index.php?mod=user&ac=register" method="post">
    <table>
        <tr>
            <td>Tên đăng nhập:</td>
            <td><input type="text" name="username" required></td>
        </tr>
        <tr>
            <td>Mật khẩu:</td>
            <td><input type="password" name="password" required></td>
        </tr>
        <tr>
            <td>Nhập lại mật khẩu:</td>
            <td><input type="password" name="password_confirm" required></td>
        </tr>
        <tr>
            <td>Họ và tên:</td>
            <td><input type="text" name="fullname" required></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input type="email" name="email" required></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Đăng ký"></td>
        </tr>
    </table>
</form>
<p>Đã có tài khoản? <a href="index.php?mod=user&ac=login">Đăng nhập</a>.</p>
