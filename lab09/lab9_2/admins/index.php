<?php
function getIndex($name, $default = "") {
    return isset($_GET[$name]) ? $_GET[$name] : $default;
}
$mod = getIndex("mod", "dashboard");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Simpla Admin</title>
    <!-- CSS -->
    <link rel="stylesheet" href="resources/css/reset.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="resources/css/style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" />
    <!--[if lte IE 7]>
    <link rel="stylesheet" href="resources/css/ie.css" type="text/css" media="screen" />
    <![endif]-->
    <!-- Javascripts -->
    <script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="resources/scripts/simpla.jquery.configuration.js"></script>
    <script type="text/javascript" src="resources/scripts/facebox.js"></script>
    <script type="text/javascript" src="resources/scripts/jquery.wysiwyg.js"></script>
    <!--[if IE 6]>
    <script type="text/javascript" src="resources/scripts/DD_belatedPNG_0.0.7a.js"></script>
    <script type="text/javascript">
        DD_belatedPNG.fix('.png_bg, img, li');
    </script>
    <![endif]-->
</head>
<body>
<div id="body-wrapper">
    <div id="sidebar">
        <div id="sidebar-wrapper">
            <h1 id="sidebar-title"><a href="#">Simpla Admin</a></h1>
            <a href="#"><img id="logo" src="resources/images/logo.png" alt="Simpla Admin logo" /></a>
            <div id="profile-links">
                Hello, <a href="#" title="Edit your profile">[Tên admin]</a><br />
                <br />
                <a href="../" title="View the Site">View the Site</a> |
                <a href="login.html" title="Sign Out">Sign Out</a>
            </div>

            <ul id="main-nav">
                <li>
                    <a href="index.php?mod=dashboard" class="nav-top-item no-submenu <?php if ($mod == 'dashboard') echo 'current'; ?>">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-top-item <?php if (in_array($mod, ['category', 'publisher', 'book'])) echo 'current'; ?>">
                        Quản lý sản phẩm
                    </a>
                    <ul>
                        <li><a href="index.php?mod=category" class="<?php if ($mod == 'category') echo 'current'; ?>">Quản lý loại sách</a></li>
                        <li><a href="index.php?mod=publisher" class="<?php if ($mod == 'publisher') echo 'current'; ?>">Quản lý nhà xuất bản</a></li>
                        <li><a href="index.php?mod=book" class="<?php if ($mod == 'book') echo 'current'; ?>">Quản lý sách</a></li>
                    </ul>
                </li>
                <li>
                    <a href="index.php?mod=order" class="nav-top-item no-submenu <?php if ($mod == 'order') echo 'current'; ?>">
                        Quản lý đơn hàng
                    </a>
                </li>
                <li>
                    <a href="index.php?mod=user" class="nav-top-item no-submenu <?php if ($mod == 'user') echo 'current'; ?>">
                        Quản lý người sử dụng
                    </a>
                </li>
                <li>
                    <a href="index.php?mod=news" class="nav-top-item no-submenu <?php if ($mod == 'news') echo 'current'; ?>">
                        Quản lý tin tức
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div id="main-content">
        <?php
        $mod_path = "module/$mod/index.php";
        if (file_exists($mod_path)) {
            include $mod_path;
        } else {
            echo "<h2 style='color:red'>Module '$mod' not found!</h2>";
            include "module/dashboard/index.php";
        }
        ?>
        <div id="footer">
            <small>
                &#169; Copyright 2025 Your Company | Powered by <a href="#">Simpla Admin</a> | <a href="#">Top</a>
            </small>
        </div>
    </div>
</div>
</body>
</html>
