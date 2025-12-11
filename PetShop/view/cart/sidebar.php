<?php
// view/cart/sidebar.php

$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Giỏ hàng</h5>
    </div>
    <div class="card-body" style="overflow-y: auto; max-height: 60vh;">
        <?php if (empty($cart_items)): ?>
            <p>Chưa có sản phẩm nào trong giỏ hàng.</p>
        <?php else: ?>
            <ul class="list-group list-group-flush">
                <?php foreach ($cart_items as $id => $item): ?>
                    <?php $item_total = $item['price'] * $item['quantity']; $total += $item_total; ?>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="w-50"><?php echo htmlspecialchars($item['name']); ?></span>
                            <div class="input-group input-group-sm w-50">
                                <a href="index.php?page=cart&action=update&id=<?php echo $id; ?>&change=-1" class="btn btn-outline-secondary">-</a>
                                <input type="text" class="form-control text-center" value="<?php echo $item['quantity']; ?>" readonly>
                                <a href="index.php?page=cart&action=update&id=<?php echo $id; ?>&change=1" class="btn btn-outline-secondary">+</a>
                                <a href="index.php?page=cart&action=remove&id=<?php echo $id; ?>" class="btn btn-outline-danger btn-sm">X</a>
                            </div>
                        </div>
                        <small class="text-muted"><?php echo number_format($item['price'], 0, ',', '.'); ?>đ x <?php echo $item['quantity']; ?> = <?php echo number_format($item_total, 0, ',', '.'); ?>đ</small>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div class="card-footer">
        <h5>Tổng cộng: <span class="float-end"><?php echo number_format($total, 0, ',', '.'); ?>đ</span></h5>
        <hr>
        <a href="index.php?page=orders" class="btn btn-primary w-100 <?php echo empty($cart_items) ? 'disabled' : ''; ?>">Thanh toán</a>
    </div>
</div>
