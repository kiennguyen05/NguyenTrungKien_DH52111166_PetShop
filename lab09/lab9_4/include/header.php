<div class="itemmenu"><a href="index.php">Home</a></div>
<div class="itemmenu"><a href="#">Tin tức</a></div>
<div class="itemmenu"><a href="#">Sản Phẩm</a></div>
<div class="itemmenu"><a href="index.php?mod=cart">Giỏ hàng (<span id="cart_sumary"><?php echo $cart->getNumItem(); ?></span>)</a></div>

<div style="float:right; padding: 10px;">
    <?php if (isset($_SESSION['username'])): ?>
        Chào, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!
        <a href="index.php?mod=user&ac=logout">Đăng xuất</a>
    <?php else: ?>
        <a href="index.php?mod=user&ac=login">Đăng nhập</a> |
        <a href="index.php?mod=user&ac=register">Đăng ký</a>
    <?php endif; ?>
</div>

<div class="itemmenusearch">
    <form action="index.php">
        <input type="hidden" name="mod" value="book" />
        <input type="hidden" name="ac" value="search" />
        <input type="text" name="key" value="<?php echo Utils::getIndex("key", ""); ?>" /><input type="submit" value="Search" />
    </form>
</div>
<div style="clear:both;"></div>