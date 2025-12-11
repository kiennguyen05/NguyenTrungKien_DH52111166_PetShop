<?php
// view/invoices/show.php
// Variables $invoice_info and $order_details are passed from InvoiceController
?>

<div class="container">
    <div class="card mx-auto shadow" style="max-width: 600px;">
        <div class="card-header bg-primary text-white text-center">
            <h4>HÓA ĐƠN BÁN LẺ</h4>
            <small>Mã hóa đơn: #<?= htmlspecialchars($invoice_info['invoice_id']) ?></small>
        </div>
        <div class="card-body">
            <?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
            <p><strong>Ngày lập:</strong> <?= date('d/m/Y H:i', strtotime($invoice_info['invoice_date'])) ?></p>
            <p><strong>Nhân viên:</strong> <?= htmlspecialchars($invoice_info['username']) ?></p>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th class="text-center">SL</th>
                        <th class="text-end">Đơn giá</th>
                        <th class="text-end">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($order_details as $d): ?>
                    <tr>
                        <td><?= htmlspecialchars($d['product_name']) ?></td>
                        <td class="text-center"><?= $d['quantity'] ?></td>
                        <td class="text-end"><?= formatMoney($d['unit_price']) ?></td>
                        <td class="text-end"><?= formatMoney($d['unit_price'] * $d['quantity']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="fw-bold fs-5">
                        <td colspan="3" class="text-end">Tổng cộng:</td>
                        <td class="text-end text-danger"><?= formatMoney($invoice_info['total_amount']) ?></td>
                    </tr>
                </tfoot>
            </table>
            <div class="text-center mt-4">
                <a href="index.php" class="btn btn-primary">Về trang bán hàng</a>
                <a href="index.php?page=invoices" class="btn btn-secondary">Xem lịch sử hóa đơn</a>
            </div>
        </div>
    </div>
</div>