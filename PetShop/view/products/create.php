<div class="container">
    <h1 class="mb-4">Thêm sản phẩm mới</h1>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <form action="index.php?page=products&action=store" method="POST">
                        <div class="mb-3">
                            <label for="id" class="form-label">Mã sản phẩm (ID)</label>
                            <input type="text" class="form-control" id="id" name="id" required>
                            <div class="form-text">Mã sản phẩm là duy nhất.</div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Giá</label>
                            <input type="number" class="form-control" id="price" name="price" step="1000" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Tồn kho</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>
                        <div class="mb-3">
                            <label for="img_url" class="form-label">URL Hình ảnh</label>
                            <input type="text" class="form-control" id="img_url" name="img_url">
                            <div class="form-text">Dán đường dẫn tuyệt đối đến hình ảnh.</div>
                        </div>

                        <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
                        <a href="index.php?page=products&action=manage" class="btn btn-secondary">Hủy</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
