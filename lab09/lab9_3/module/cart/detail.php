<style>
    .cart-table { width: 100%; border-collapse: collapse; }
    .cart-table th, .cart-table td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    .cart-table th { background-color: #f2f2f2; }
    .cart-table img { max-width: 60px; }
    .cart-actions { margin-top: 15px; }
    .total-row { font-weight: bold; }
    .quantity-input { width: 50px; text-align: center; }
    .cart-total { text-align: right; font-size: 1.2em; margin-top: 20px;}
</style>

<h2>Chi tiết giỏ hàng</h2>

<?php
if (empty($cart_data['items'])) {
    echo "<p>Giỏ hàng của bạn đang trống.</p>";
} else {
?>
<form action="index.php?mod=cart&ac=update" method="post">
    <table class="cart-table">
        <thead>
            <tr>
                <th colspan="2">Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tạm tính</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cart_data['items'] as $item): ?>
            <tr>
                <td><img src="image/book/<?php echo htmlspecialchars($item['img']); ?>" alt=""></td>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td><?php echo number_format($item['price']); ?> VND</td>
                <td>
                    <input type="number" name="quantities[<?php echo $item['id']; ?>]" value="<?php echo $item['quantity']; ?>" min="1" class="quantity-input">
                </td>
                <td><?php echo number_format($item['subtotal']); ?> VND</td>
                <td>
                    <a href="index.php?mod=cart&ac=delete&id=<?php echo $item['id']; ?>" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td colspan="4" style="text-align: right;">Tổng cộng</td>
                <td colspan="2"><?php echo number_format($cart_data['total']); ?> VND</td>
            </tr>
        </tbody>
    </table>
    <div class="cart-actions">
        <input type="submit" value="Cập nhật giỏ hàng">
    </div>
</form>
<div class="cart-total">
    <a href="index.php?mod=cart&ac=checkout">Thanh toán</a>
</div>
<?php
}
?>