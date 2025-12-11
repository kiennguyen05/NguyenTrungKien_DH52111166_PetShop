<?php
// Main controller for Book, Category, and Publisher management
$group = Utils::getIndex("group", "book");

// CATEGORY MANAGEMENT (Preserved as per original file)
if ($group=="cat")
{	
	$category = new Category();
	$ac = Utils::getIndex("ac", "catShow");
	if ($ac !="delete")
	    include ROOT."/admins/module/book/catedit.php";
	
	if ($ac=="catShow")
		include ROOT."/admins/module/book/catshow.php";
	
	if ($ac=="delete") {
		$n = $category->delete(Utils::getIndex("id"));
		echo "<script>alert('Đã xóa $n category!'); window.location='index.php?mod=book&group=cat';</script>";
	}
	if ($ac=="saveEdit") {
		$n = $category->saveEdit();
		echo "<script>alert('Đã sửa $n category!'); window.location='index.php?mod=book&group=cat';</script>";
	}
	if ($ac=="saveAdd") {
		$n = $category->saveAddNew();
		echo "<script>alert('Đã thêm $n category!'); window.location='index.php?mod=book&group=cat';</script>";
	}
}

// BOOK MANAGEMENT (New Clean Controller)
if ($group=="book")
{
    $book = new Book();
    $ac = Utils::getIndex("ac", "bookShow");

    // Prepare data for views
    $category = new Category();
    $publisher = new Publisher();
    $cat_list = $category->getAll();
    $pub_list = $publisher->getAll();
    $msg = ""; // For notifications

    if ($ac == 'delete') {
        $id = Utils::getIndex("id");
        if ($book->delete($id) > 0) {
            $msg = "delete_success";
        } else {
            $msg = "delete_fail";
        }
        header("Location: index.php?mod=book&group=book&msg=$msg");
        exit();

    } elseif ($ac == 'add' || $ac == 'edit') {
        $is_edit = ($ac == 'edit');
        $book_data = array();
        if ($is_edit) {
            $id = Utils::getIndex("id");
            $book_data = $book->getDetail($id);
            if (!$book_data) {
                 header("Location: index.php?mod=book&group=book&msg=not_found");
                 exit();
            }
        }
        // Show the form
        include ROOT."/admins/module/book/bookedit.php";

    } elseif ($ac == 'saveAdd' || $ac == 'saveEdit') {
        $is_edit = ($ac == 'saveEdit');
        $data = [
            'book_name' => Utils::postIndex('book_name'),
            'description' => Utils::postIndex('description'),
            'price' => Utils::postIndex('price'),
            'img' => Utils::postIndex('img'),
            'pub_id' => Utils::postIndex('pub_id'),
            'cat_id' => Utils::postIndex('cat_id'),
        ];
        
        $success = false;
        if ($is_edit) {
            $id = Utils::getIndex("id");
            $success = $book->updateBook($id, $data);
            $msg = $success ? "edit_success" : "edit_fail";
        } else {
            $success = $book->addBook($data);
            $msg = $success ? "add_success" : "add_fail";
        }
        header("Location: index.php?mod=book&group=book&msg=$msg");
        exit();

    } else { // 'bookShow' (List view) is the default
        $filters = [
            'name' => Utils::getIndex('name'),
            'cat_id' => Utils::getIndex('cat_id'),
            'pub_id' => Utils::getIndex('pub_id')
        ];
        $page = Utils::getIndex("page", 1);
        
        $result = $book->getAll($filters, $page);
        $data = $result['items'];
        $page_count = $result['pageCount'];

        // Show notifications based on URL param
        $msg_code = Utils::getIndex('msg');
        if ($msg_code) {
             $messages = [
                'add_success' => 'Thêm sách mới thành công!',
                'edit_success' => 'Cập nhật sách thành công!',
                'delete_success' => 'Xóa sách thành công!',
                'add_fail' => 'Thêm sách thất bại. Vui lòng kiểm tra lại dữ liệu.',
                'edit_fail' => 'Cập nhật sách thất bại.',
                'delete_fail' => 'Xóa sách thất bại.',
                'not_found' => 'Không tìm thấy sách được yêu cầu.'
             ];
             if (isset($messages[$msg_code])) {
                echo '<div class="notification information png_bg"><div>' . $messages[$msg_code] . '</div></div>';
             }
        }

        include ROOT."/admins/module/book/bookshow.php";
    }
}

// PUBLISHER MANAGEMENT (Preserved as per original file)
if ($group=="pub")
{
   echo "Các thao tác với nhà xuất bản tại đây nha!";	
}