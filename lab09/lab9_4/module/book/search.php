<?php
if (!defined("ROOT")) {
    echo "Err!";
    exit;
}

// Instantiate necessary objects
$category = new Category();
$publisher = new Publisher();
// $book is already available from book/index.php

// Fetch data for form dropdowns
$cat_list = $category->getAll();
$pub_list = $publisher->getAll();

// Get all search parameters from URL
$search_params = [
    'name' => Utils::getIndex('name'),
    'cat_id' => Utils::getIndex('cat_id'),
    'pub_id' => Utils::getIndex('pub_id'),
    'min_price' => Utils::getIndex('min_price'),
    'max_price' => Utils::getIndex('max_price')
];
$page = Utils::getIndex('page', 1);

// Check if a search has been performed
$is_searching = !empty(array_filter($search_params));

$list = [];
$pageCount = 0;

if ($is_searching) {
    $total_results = $book->countSearchAdvanced($search_params);
    if ($total_results > 0) {
        $pageCount = ceil($total_results / $book->pageSize);
        $list = $book->searchAdvanced($search_params, $page);
    }
}
?>

<style>
    .search-form { background-color: #f2f2f2; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
    .search-form table { width: 100%; }
    .search-form td { padding: 5px; }
    .book-result { display: flex; border-bottom: 1px solid #eee; padding: 10px; margin-bottom: 10px; }
    .book-result img { margin-right: 15px; }
    .pagination { text-align: center; margin-top: 20px; }
    .pagination a, .pagination strong { margin: 0 5px; }
</style>

<h3>Tìm kiếm nâng cao</h3>
<div class="search-form">
    <form action="index.php" method="get">
        <input type="hidden" name="mod" value="book" />
        <input type="hidden" name="ac" value="search" />
        <table>
            <tr>
                <td>Tên sách:</td>
                <td><input type="text" name="name" value="<?php echo htmlspecialchars($search_params['name']); ?>" /></td>
                <td>Loại sách:</td>
                <td>
                    <select name="cat_id">
                        <option value="">Tất cả</option>
                        <?php foreach ($cat_list as $cat) : ?>
                            <option value="<?php echo $cat['cat_id']; ?>" <?php if ($search_params['cat_id'] == $cat['cat_id']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($cat['cat_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Nhà xuất bản:</td>
                <td>
                    <select name="pub_id">
                        <option value="">Tất cả</option>
                        <?php foreach ($pub_list as $pub) : ?>
                            <option value="<?php echo $pub['pub_id']; ?>" <?php if ($search_params['pub_id'] == $pub['pub_id']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($pub['pub_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>Giá từ:</td>
                <td>
                    <input type="number" name="min_price" value="<?php echo htmlspecialchars($search_params['min_price']); ?>" placeholder="VND" />
                    - Đến:
                    <input type="number" name="max_price" value="<?php echo htmlspecialchars($search_params['max_price']); ?>" placeholder="VND" />
                </td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: center;"><input type="submit" value="Tìm kiếm" /></td>
            </tr>
        </table>
    </form>
</div>

<hr>

<h3>Kết quả tìm kiếm</h3>
<?php
if ($is_searching) {
    if (empty($list)) {
        echo "<p>Không tìm thấy kết quả nào phù hợp.</p>";
    } else {
        echo "<p>Tìm thấy " . count($list) . " kết quả.</p>";
        foreach ($list as $r) {
            ?>
            <div class="book-result">
                <img src="image/book/<?php echo htmlspecialchars($r['img']); ?>" width="80" alt="">
                <div>
                    <h4><?php echo htmlspecialchars($r['book_name']); ?></h4>
                    <p><strong>Giá:</strong> <?php echo number_format($r['price']); ?> VND</p>
                    <p><strong>NXB:</strong> <?php echo htmlspecialchars($r['pub_name']); ?></p>
                    <p><strong>Loại:</strong> <?php echo htmlspecialchars($r['cat_name']); ?></p>
                    <a href="index.php?mod=cart&ac=add&id=<?php echo $r['book_id']; ?>">Mua ngay</a>
                </div>
            </div>
            <?php
        }

        // Pagination
        if ($pageCount > 1) {
            echo '<div class="pagination">';
            // Build URL with existing search params
            $query_string = http_build_query(array_merge($search_params, ['mod' => 'book', 'ac' => 'search']));
            for ($i = 1; $i <= $pageCount; $i++) {
                if ($i == $page) {
                    echo "<strong>$i</strong>";
                } else {
                    echo "<a href='index.php?$query_string&page=$i'>$i</a>";
                }
            }
            echo '</div>';
        }
    }
} else {
    echo "<p>Vui lòng sử dụng form tìm kiếm ở trên để tìm sách.</p>";
}
?>