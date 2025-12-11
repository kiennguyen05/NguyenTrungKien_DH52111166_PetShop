<?php
// lab01/index.php
$lab_title = "Lab 01";
$user_info = "Nguyễn Trung Kiên-DH52111166, Lớp:D21_TH06, T2C3 Nhóm 9";
$items = [
    'example01.php',
    'lab1_3.php',
    'lab1_4.php',
    'vi_du_04/',
    'vi_du_05/',
    'vi_du04/'
];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lab_title; ?> - Danh sách bài thực hành</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4; }
        .container { max-width: 800px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #333; text-align: center; }
        .user-info { text-align: center; color: #555; margin-bottom: 20px; font-weight: bold; }
        ul { list-style-type: none; padding: 0; }
        li { margin: 10px 0; }
        a { text-decoration: none; color: #007bff; background-color: #e7f3ff; display: block; padding: 15px; border-radius: 5px; transition: background-color 0.3s; }
        a:hover { background-color: #d0e7ff; }
        a::after { content: ' »'; font-size: 1.2em; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Danh sách các bài thực hành <?php echo $lab_title; ?></h1>
        <p class="user-info"><?php echo $user_info; ?></p>
        <ul>
            <?php foreach ($items as $item): ?>
                <li><a href="<?php echo htmlspecialchars($item); ?>"><?php echo htmlspecialchars($item); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>