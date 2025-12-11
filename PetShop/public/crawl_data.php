<?php
require '../config/database.php';

// Get DB connection
$database = new Database();
$pdo = $database->getConnection();

echo "<!DOCTYPE html><html lang='vi'><head><meta charset='UTF-8'><title>Crawl Data</title>";
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">';
echo "</head><body class='container mt-4'>";

echo "<h3>Đang thiết lập cơ sở dữ liệu...</h3>";

// 1. Create User Admin mặc định
try {
    $stmt = $pdo->prepare("INSERT IGNORE INTO users (id, username, password, email, role) VALUES (?, ?, ?, ?, ?)");
    // Pass=123456 as per design.txt
    $stmt->execute([1, 'admin', '123456', 'admin@shop.com', 'admin']);
    echo "<div class='alert alert-success'>✔️ Đã kiểm tra/tạo user mẫu (User: <strong>admin</strong> / Pass: <strong>123456</strong>).</div>";
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>❌ Lỗi khi tạo user mẫu: " . $e->getMessage() . "</div>";
}


// 2. Cào dữ liệu sản phẩm từ Mozzi.vn
echo "<h3>Đang cào dữ liệu sản phẩm...</h3>";
$context = stream_context_create([
    "http" => ["header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36\r\n"]
]);
$html = @file_get_contents('https://mozzi.vn/', false, $context);

if (!$html) {
    echo "<div class='alert alert-danger'>❌ Không kết nối được với trang nguồn (mozzi.vn) để lấy dữ liệu sản phẩm. Vui lòng thử lại sau.</div>";
} else {
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTML('<?xml encoding="utf-8" ?>' . $html);
    libxml_clear_errors();

    $images = $doc->getElementsByTagName('img');
    $count = 0;
    $added_count = 0;

    foreach ($images as $img) {
        if ($added_count >= 12) break; // Lấy 12 sản phẩm

        $src = $img->getAttribute('data-src') ?: $img->getAttribute('src');
        $name = $img->getAttribute('alt'); 

        $src = strtok($src, '?');
        if (strpos($src, '//') === 0) $src = 'https:' . $src;
        
        if (empty($name) || strlen($name) < 5 || strpos($src, 'icon') !== false || strpos($src, 'logo') !== false) continue;

        // Giả lập ID và Giá
        $id = 'SP' . str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        $price = rand(50, 500) * 1000; 
        
        $sql = "INSERT IGNORE INTO products (id, name, description, price, stock, img_url) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        try {
            if ($stmt->execute([$id, $name, "Hàng chính hãng Mozzi", $price, 100, $src])) {
                if ($stmt->rowCount() > 0) {
                     echo "<div class='text-success'>✔️ Đã thêm: $name</div>";
                     $added_count++;
                }
            }
        } catch (Exception $e) { } // Bỏ qua lỗi để tiếp tục cào
        $count++;
    }
     echo "<div class='alert alert-info mt-3'>👍 Đã thêm thành công <strong>$added_count</strong> sản phẩm mới.</div>";
}

echo "<hr><a href='index.php' class='btn btn-primary'>✅ Hoàn tất! Quay lại trang chủ</a>";
echo "</body></html>";
?>
