<?php
// view/products/edit.php
// The $product object is passed from the controller
?>
<div class="container">
    <h1 class="mb-4">Chỉnh sửa sản phẩm</h1>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <form action="index.php?page=products&action=update" method="POST">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($product->id); ?>">

                        <div class="mb-3">
                            <label for="name" class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($product->name); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($product->description); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Giá</label>
                            <input type="number" class="form-control" id="price" name="price" step="1000" value="<?php echo htmlspecialchars($product->price); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Tồn kho</label>
                            <input type="number" class="form-control" id="stock" name="stock" value="<?php echo htmlspecialchars($product->stock); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="img_url" class="form-label">URL Hình ảnh</label>
                            <input type="text" class="form-control" id="img_url" name="img_url" value="<?php echo htmlspecialchars($product->img_url); ?>">
                            <div class="form-text">Dán đường dẫn tuyệt đối đến hình ảnh.</div>
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                        <a href="index.php?page=products&action=manage" class="btn btn-secondary">Hủy</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
