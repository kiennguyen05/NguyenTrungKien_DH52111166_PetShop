<?php
// view/invoices/list.php
// Variable $invoices is passed from InvoiceController
?>
<div class="container">
    <h2>Lịch sử hóa đơn bán hàng</h2>
    
    <form class="row g-3 mb-4 align-items-end" method="GET">
        <input type="hidden" name="page" value="invoices">
        <div class="col-auto">
            <label for="date" class="form-label">Lọc theo ngày:</label>
            <input type="date" name="date" id="date" class="form-control" value="<?= htmlspecialchars($_GET['date'] ?? '') ?>">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Lọc</button>
        </div>
        <div class="col-auto">
            <a href="index.php?page=invoices" class="btn btn-outline-secondary">Xóa lọc</a>
        </div>
    </form>

    <table class="table table-hover table-bordered">
        <thead class="table-light">
            <tr>
                <th>Mã Hóa Đơn</th>
                <th>Ngày Lập</th>
                <th>Nhân viên</th>
                <th class="text-end">Tổng tiền</th>
                <th class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($invoices)): ?>
                <tr>
                    <td colspan="5" class="text-center">Không tìm thấy hóa đơn nào.</td>
                </tr>
            <?php else: ?>
                <?php foreach($invoices as $inv): ?>
                <tr>
                    <td>#<?= htmlspecialchars($inv['invoice_id']) ?></td>
                    <td>
                        <?php
                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            if (!empty($inv['invoice_date'])) {
                                echo "<div><strong>Ngày hiển thị:</strong> " . date('d/m/Y H:i', strtotime($inv['invoice_date'])) . "</div>";
                                echo "<div style='font-size: 0.8em; color: #666;'>";
                                echo "<strong>Raw Date:</strong> " . $inv['invoice_date'] . "<br>";
                                echo "<strong>strtotime Result:</strong> " . strtotime($inv['invoice_date']) . "<br>";
                                echo "<strong>Current Timezone:</strong> " . date_default_timezone_get();
                                echo "</div>";
                            } else {
                                echo "Chưa có ngày";
                            }
                        ?>
                    </td>
                    <td><?= htmlspecialchars($inv['username']) ?></td>
                    <td class="fw-bold text-end"><?= formatMoney($inv['total_amount']) ?></td>
                    <td class="text-center">
                        <a href="index.php?page=invoices&action=show&id=<?= $inv['invoice_id'] ?>" class="btn btn-sm btn-info">Xem Chi tiết</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>