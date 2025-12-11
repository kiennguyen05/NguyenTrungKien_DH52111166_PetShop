<?php
// view/orders/checkout.php
// Variables $cartItems and $totalCart are passed from OrderController
?>

<div class="container">
    <h2 class="mb-4 text-center">Xác nhận thanh toán</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h4>Chi tiết đơn hàng</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Sản phẩm</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-end">Đơn giá</th>
                                <th class="text-end">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($cartItems as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['name']) ?></td>
                                <td class="text-center"><?= $item['quantity'] ?></td>
                                <td class="text-end"><?= formatMoney($item['price']) ?></td>
                                <td class="text-end"><?= formatMoney($item['price'] * $item['quantity']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-active fw-bold fs-5">
                                <td colspan="3" class="text-end">TỔNG TIỀN PHẢI THU:</td>
                                <td class="text-end text-danger"><?= formatMoney($totalCart) ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h4>Phương thức thanh toán</h4>
                <form action="index.php?page=orders&action=processPayment" method="POST">
                    <input type="hidden" name="total_amount" value="<?= $totalCart ?>">
                    
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="payment_method" value="cash" id="cash" checked>
                        <label class="form-check-label" for="cash">Tiền mặt</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="payment_method" value="transfer" id="transfer">
                        <label class="form-check-label" for="transfer">Chuyển khoản</label>
                    </div>

                    <hr>
                    <button type="submit" class="btn btn-success w-100 py-3 fw-bold">HOÀN TẤT THANH TOÁN</button>
                    <a href="index.php" class="btn btn-outline-secondary w-100 mt-2">Quay lại bán hàng</a>
                </form>
            </div>
        </div>
    </div>
</div>