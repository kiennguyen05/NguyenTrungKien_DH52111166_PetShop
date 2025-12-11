<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chào mừng</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; display: flex; align-items: center; justify-content: center; height: 100vh; background-color: #f0f2f5; margin: 0; }
        .container { text-align: center; }
        h1 { color: #333; }
        .choices { display: flex; gap: 20px; margin-top: 30px; }
        .choice-card { background: white; padding: 40px 50px; border-radius: 12px; text-decoration: none; color: #333; box-shadow: 0 4px 12px rgba(0,0,0,0.1); transition: all 0.2s ease-in-out; }
        .choice-card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.12); }
        .choice-card h2 { margin: 0; font-size: 1.5rem; color: #0d6efd; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Chào mừng bạn</h1>
        <p>Vui lòng chọn một trong các mục dưới đây để tiếp tục:</p>
        <div class="choices">
            <a href="PetShop/public/" class="choice-card">
                <h2>🛍️ Vào Pet Shop</h2>
            </a>
            <a href="labthuchanh.php" class="choice-card">
                <h2>🧪 Lab Thực Hành</h2>
            </a>
        </div>
    </div>
</body>
</html>