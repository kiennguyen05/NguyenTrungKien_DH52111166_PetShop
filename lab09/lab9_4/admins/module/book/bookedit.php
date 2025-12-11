<?php
// This view is included by the book module's index.php controller.
// It expects the following variables to be set:
// $book_data: An array of the book's data (for editing) or an empty array (for adding).
// $cat_list: A list of all categories for the dropdown.
// $pub_list: A list of all publishers for the dropdown.
// $is_edit: A boolean flag, true if editing, false if adding.
// $error_msg: A string containing an error message, if any.

$action_url = $is_edit ? "index.php?mod=book&group=book&ac=saveEdit&id=" . $book_data['book_id'] : "index.php?mod=book&group=book&ac=saveAdd";
?>

<h3><?php echo $is_edit ? "Chỉnh sửa sách" : "Thêm sách mới"; ?></h3>

<?php if (!empty($error_msg)): ?>
<div class="notification error png_bg">
    <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close" alt="close"></a>
    <div><?php echo $error_msg; ?></div>
</div>
<?php endif; ?>

<div class="content-box-content">
    <div class="tab-content default-tab">
        <form action="<?php echo $action_url; ?>" method="post">
            <fieldset>
                <p>
                    <label>Tên sách</label>
                    <input class="text-input medium-input" type="text" name="book_name" value="<?php echo htmlspecialchars($book_data['book_name'] ?? ''); ?>" />
                </p>
                <p>
                    <label>Loại sách</label>
                    <select name="cat_id" class="small-input">
                        <?php foreach ($cat_list as $cat): ?>
                        <option value="<?php echo $cat['cat_id']; ?>" <?php if (isset($book_data['cat_id']) && $book_data['cat_id'] == $cat['cat_id']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($cat['cat_name']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </p>
                <p>
                    <label>Nhà xuất bản</label>
                    <select name="pub_id" class="small-input">
                        <?php foreach ($pub_list as $pub): ?>
                        <option value="<?php echo $pub['pub_id']; ?>" <?php if (isset($book_data['pub_id']) && $book_data['pub_id'] == $pub['pub_id']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($pub['pub_name']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </p>
                <p>
                    <label>Giá (VND)</label>
                    <input class="text-input small-input" type="number" name="price" value="<?php echo htmlspecialchars($book_data['price'] ?? '0'); ?>" />
                </p>
                <p>
                    <label>Tên file ảnh (ví dụ: th01.jpg)</label>
                    <input class="text-input medium-input" type="text" name="img" value="<?php echo htmlspecialchars($book_data['img'] ?? ''); ?>" />
                </p>
                <p>
                    <label>Mô tả</label>
                    <textarea class="text-input textarea wysiwyg" name="description" cols="79" rows="15"><?php echo htmlspecialchars($book_data['description'] ?? ''); ?></textarea>
                </p>
                <p>
                    <input class="button" type="submit" value="Lưu" />
                </p>
            </fieldset>
            <div class="clear"></div>
        </form>
    </div>
</div>