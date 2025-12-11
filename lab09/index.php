<?php
// lab09/index.php
$lab_title = "Lab 09";
$user_info = "Nguyễn Trung Kiên-DH52111166, Lớp:D21_TH06, T2C3 Nhóm 9";
$items = [
    'lab9_1/' => 'Bài 1: Lab 9.1',
    'lab9_2/' => 'Bài 2: Lab 9.2',
    'lab9_3/' => 'Bài 3: Lab 9.3',
    'lab9_4/' => 'Bài 4: Lab 9.4'
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
            <?php foreach ($items as $link => $text): ?>
                <li><a href="<?php echo htmlspecialchars($link); ?>"><?php echo htmlspecialchars($text); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>