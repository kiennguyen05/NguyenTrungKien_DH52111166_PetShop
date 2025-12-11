<div class="container mt-4">
    <h2>Quản lí sản phẩm</h2>
    <a href="index.php?page=products&action=create" class="btn btn-success mb-3">Thêm sản phẩm mới</a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Tồn kho</th>
                <th>Hình ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($products) && !empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['id']); ?></td>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ</td>
                        <td><?php echo htmlspecialchars($product['stock']); ?></td>
                        <td>
                            <?php if (!empty($product['img_url']) && file_exists($product['img_url'])): ?>
                                <img src="<?php echo htmlspecialchars($product['img_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="max-width: 100px; max-height: 100px;">
                            <?php else: ?>
                                <small>Không có ảnh</small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?page=products&action=edit&id=<?php echo $product['id']; ?>" class="btn btn-primary btn-sm">Sửa</a>
                            <a href="index.php?page=products&action=delete&id=<?php echo $product['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Không có sản phẩm nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
