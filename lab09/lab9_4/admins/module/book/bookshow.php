<?php
// This view is included by the controller and expects the following variables:
// $data: The array of book items for the current page.
// $page_count: The total number of pages.
// $page: The current page number.
// $filters: An array of the current filter values.
// $cat_list: A list of all categories for the dropdown.
// $pub_list: A list of all publishers for the dropdown.

$filter_query_string = http_build_query(['mod' => 'book', 'group' => 'book', 'ac' => 'bookShow'] + $filters);
?>
<div class="content-box">
    <div class="content-box-header">
        <h3>Quản lý sách</h3>
        <ul class="content-box-tabs">
            <li><a href="#filter-tab" class="default-tab">Lọc và Tìm kiếm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
    <div class="content-box-content">
        <div class="tab-content default-tab" id="filter-tab">
            <form action="index.php" method="get">
                <input type="hidden" name="mod" value="book">
                <input type="hidden" name="group" value="book">
                <input type="hidden" name="ac" value="bookShow">
                <p>
                    <label>Tên sách</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($filters['name'] ?? ''); ?>" class="text-input small-input">
                    <label>Loại sách</label>
                    <select name="cat_id" class="small-input">
                        <option value="">-- Tất cả --</option>
                        <?php foreach($cat_list as $cat): ?>
                        <option value="<?php echo $cat['cat_id']; ?>" <?php if (($filters['cat_id'] ?? '') == $cat['cat_id']) echo 'selected'; ?>><?php echo $cat['cat_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label>NXB</label>
                     <select name="pub_id" class="small-input">
                        <option value="">-- Tất cả --</option>
                        <?php foreach($pub_list as $pub): ?>
                        <option value="<?php echo $pub['pub_id']; ?>" <?php if (($filters['pub_id'] ?? '') == $pub['pub_id']) echo 'selected'; ?>><?php echo $pub['pub_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="submit" class="button" value="Lọc">
                </p>
            </form>
            <div class="clear"></div>
        </div>
        <div class="tab-content" id="list-tab">
            <table>
                <thead>
                    <tr>
                        <th><input class="check-all" type="checkbox" /></th>
                        <th>Tên sách</th>
                        <th>Giá</th>
                        <th>Loại</th>
                        <th>Nhà XB</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="bulk-actions align-left">
                                 <a href="index.php?mod=book&group=book&ac=add" class="button">Thêm sách mới</a>
                            </div>
                            <div class="pagination">
                                <?php for ($i = 1; $i <= $page_count; $i++): ?>
                                <a href="index.php?<?php echo $filter_query_string . '&page=' . $i; ?>" class="number <?php if ($i == $page) echo 'current'; ?>" title="<?php echo $i; ?>"><?php echo $i; ?></a>
                                <?php endfor; ?>
                            </div>
                            <div class="clear"></div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php if (empty($data)): ?>
                    <tr><td colspan="6">Không có sách nào.</td></tr>
                    <?php else: foreach ($data as $r): ?>
                    <tr>
                        <td><input type="checkbox" /></td>
                        <td><?php echo htmlspecialchars($r["book_name"]); ?></td>
                        <td><?php echo number_format($r["price"]); ?> VND</td>
                        <td><?php echo htmlspecialchars($r["cat_name"]); ?></td>
                        <td><?php echo htmlspecialchars($r["pub_name"]); ?></td>
                        <td>
                            <a href="index.php?mod=book&group=book&ac=edit&id=<?php echo $r["book_id"]; ?>" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>&nbsp;&nbsp;
                            <a href="index.php?mod=book&group=book&ac=delete&id=<?php echo $r["book_id"]; ?>" title="Delete" onclick="return confirm('Bạn có chắc muốn xóa cuốn sách này?');"><img src="resources/images/icons/cross.png" alt="Delete" /></a>
                        </td>
                    </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>