<?php
// view/home.php
// Variables $products, $cartItems, $totalCart are passed from HomeController
?>
<div class="container-fluid">
    <div class="row">
        <!-- Product Grid -->
        <div class="col-md-8">
            <!-- Search Form -->
            <div class="mb-4">
                <form action="index.php" method="GET" class="d-flex">
                    <input type="hidden" name="page" value="home">
                    <input class="form-control me-2" type="search" name="search" placeholder="Tìm kiếm sản phẩm..." aria-label="Search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                    <button class="btn btn-outline-success" type="submit">Tìm</button>
                </form>
            </div>
            
            <div class="row">
                <?php if (empty($products)): ?>
                    <div class="col-12">
                        <div class="alert alert-warning">Không tìm thấy sản phẩm nào.</div>
                    </div>
                <?php else: ?>
                    <?php foreach($products as $p): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="<?= htmlspecialchars($p['img_url'] ?? '') ?>" class="card-img-top" style="height: 150px; object-fit: contain; padding: 5px;">
                            <div class="card-body text-center d-flex flex-column">
                                <h6 class="card-title text-truncate" style="flex-grow: 1;"><?= htmlspecialchars($p['name']) ?></h6>
                                <p class="card-text text-danger fw-bold"><?= formatMoney($p['price']) ?></p>
                                <form method="POST" action="index.php">
                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($p['id'] ?? '') ?>">
                                    <input type="hidden" name="action" value="add">
                                    <button type="submit" class="btn btn-primary btn-sm w-100">Thêm vào giỏ</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Cart Sidebar -->
        <div class="col-md-4">
            <div class="card bg-light border-primary">
                <div class="card-header bg-primary text-white fw-bold">Giỏ hàng</div>
                <div class="card-body p-0" style="max-height: 70vh; overflow-y: auto;">
                    <?php if (empty($cartItems)): ?>
                        <p class="text-center p-3">Giỏ hàng trống</p>
                    <?php else: ?>
                        <table class="table table-sm table-striped mb-0">
                            <?php foreach($cartItems as $item): 
                                $subtotal = $item['quantity'] * $item['price'];
                            ?>
                            <tr>
                                <td style="width: 50px;"><img src="<?= htmlspecialchars($item['img_url'] ?? '') ?>" width="40"></td>
                                <td><small><?= htmlspecialchars($item['name']) ?></small></td>
                                <td class="text-nowrap text-center">
                                    <form method="POST" action="index.php" style="display:inline;">
                                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['id'] ?? '') ?>">
                                        <input type="hidden" name="action" value="decrease">
                                        <button class="btn btn-secondary btn-sm py-0 px-1">-</button>
                                    </form>
                                    <span class="mx-1 fw-bold"><?= $item['quantity'] ?></span>
                                    <form method="POST" action="index.php" style="display:inline;">
                                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['id'] ?? '') ?>">
                                        <input type="hidden" name="action" value="add">
                                        <button class="btn btn-secondary btn-sm py-0 px-1">+</button>
                                    </form>
                                </td>
                                <td class="text-end"><small><?= formatMoney($subtotal) ?></small></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Tổng cộng:</span>
                        <span class="text-danger"><?= formatMoney($totalCart) ?></span>
                    </div>
                    <?php if(count($cartItems) > 0): ?>
                    <a href="index.php?page=orders&action=checkout" class="btn btn-success w-100 mt-2 fw-bold">THANH TOÁN</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>