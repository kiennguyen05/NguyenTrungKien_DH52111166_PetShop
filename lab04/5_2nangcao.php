<?php
session_start();
if (!isset($_SESSION['data'])) {
    $_SESSION['data'] = array();
}

// Thêm phần tử vào mảng
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $key = $_POST['key'];
    $value = $_POST['value'];
    
    // Thêm vào mảng trong session
    $_SESSION['data'][$key] = $value;
}

// Xóa phần tử khỏi mảng
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $keyToDelete = $_POST['delete'];
    unset($_SESSION['data'][$keyToDelete]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>

    <style>
        .table th, .table td {
            vertical-align: middle;
        }
        .container {
            margin-top: 30px;
        }
    </style>
</head>
<body>

<div class="container">
        <h2>Nhập Key và Value vào Mảng</h2>
        
        <!-- Form nhập key và value -->
        <form method="POST" action="">
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="key">Key:</label>
                    <input type="text" class="form-control" id="key" name="key" required>
                </div>
                <div class="form-group col-md-5">
                    <label for="value">Value:</label>
                    <input type="text" class="form-control" id="value" name="value" required>
                </div>
                <div class="form-group col-md-2">
                    <button type="submit" name="add" class="btn btn-primary mt-4">Thêm</button>
                    <button type="reset" class="btn btn-danger mt-4">Hủy</button>
                </div>
            </div>
        </form>

        <!-- Bảng hiển thị dữ liệu -->
        <table class="table table-bordered mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>Index</th>
                    <th>Key</th>
                    <th>Value</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Duyệt mảng trong session và hiển thị
                if (!empty($_SESSION['data'])) {
                    foreach ($_SESSION['data'] as $key => $value) {
                        echo "<tr>";
                        echo "<td>" . $key . "</td>";
                        echo "<td>" . $value . "</td>";
                        echo "<td>
                                <form method='POST' style='display:inline-block'>
                                    <button type='submit' class='btn btn-danger' name='delete' value='$key'>Xóa</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</body>
</html>