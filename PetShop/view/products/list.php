<?php
// view/products/list.php
// The $products variable is passed from ProductController

?>
<h1 class="mb-4">Sản phẩm</h1>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <div class="col">
                <div class="card h-100">
                    <img src="<?php echo htmlspecialchars($product['img_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                        <p class="card-text text-danger fw-bold"><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</p>
                        <p class="card-text"><small class="text-muted">Tồn kho: <?php echo htmlspecialchars($product['stock']); ?></small></p>
                        <div class="mt-auto">
                            <a href="index.php?page=cart&action=add&id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-primary w-100">Thêm vào giỏ</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <p>Không tìm thấy sản phẩm nào.</p>
        </div>
    <?php endif; ?>
</div>
