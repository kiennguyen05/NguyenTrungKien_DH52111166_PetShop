<?php
// We don't need to include the class file here because of the autoloader in index.php

$news_obj = new News();
$ac = getIndex("ac", "list");

if ($ac == "detail") {
    $id = getIndex("id");
    if (empty($id)) {
        echo "<p>Không tìm thấy tin tức yêu cầu.</p>";
    } else {
        $news_item = $news_obj->getDetail($id);
        if (empty($news_item)) {
            echo "<p>Tin tức này không tồn tại.</p>";
        } else {
            ?>
            <div class="news-detail">
                <h2><?php echo htmlspecialchars($news_item['title']); ?></h2>
                <div class="content">
                    <?php if (!empty($news_item['img'])): ?>
                        <img src="image/news/<?php echo htmlspecialchars($news_item['img']); ?>" alt="<?php echo htmlspecialchars($news_item['title']); ?>" style="max-width: 100%; height: auto; padding-bottom:10px;">
                    <?php endif; ?>
                    
                    <?php echo $news_item['content']; ?>
                </div>
            </div>
            <?php
        }
    }
} else { // Default to "list" action
    $page = getIndex("page", 1);
    $news_list = $news_obj->getAll($page);
    $totalPages = $news_obj->getTotalPages();
    
    echo "<h2>Danh sách tin tức</h2>";

    if (count($news_list) > 0) {
        foreach ($news_list as $news_item) {
            ?>
            <div class="news-summary" style="display: flex; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
                <?php if (!empty($news_item['img'])): ?>
                    <div class="news-image" style="margin-right: 15px;">
                        <a href="index.php?mod=news&ac=detail&id=<?php echo $news_item['id']; ?>">
                            <img src="image/news/<?php echo htmlspecialchars($news_item['img']); ?>" alt="<?php echo htmlspecialchars($news_item['title']); ?>" width="120">
                        </a>
                    </div>
                <?php endif; ?>
                <div class="news-text">
                    <h3>
                        <a href="index.php?mod=news&ac=detail&id=<?php echo $news_item['id']; ?>">
                            <?php echo htmlspecialchars($news_item['title']); ?>
                        </a>
                    </h3>
                    
                    <p><?php echo htmlspecialchars($news_item['short_content']); ?></p>
                </div>
            </div>
            <?php
        }

        // Pagination
        echo '<div class="pagination" style="text-align: center; margin-top: 20px;">';
        if ($totalPages > 1) {
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i == $page) {
                    echo "<strong style='margin: 0 5px;'>$i</strong>";
                } else {
                    echo "<a href='index.php?mod=news&page=$i' style='margin: 0 5px;'>$i</a>";
                }
            }
        }
        echo '</div>';

    } else {
        echo "<p>Chưa có tin tức nào.</p>";
    }
}
?>