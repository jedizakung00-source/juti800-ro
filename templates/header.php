<?php
    ob_start();
    session_start();
    include __DIR__ . '/../config/db_config.php';

    $current_page = basename($_SERVER['PHP_SELF']);
    if (empty($current_page) || $current_page == 'web-free') {
        $current_page = 'index.php';
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ragnarok Website Free</title>
    <link rel="icon" href="img/fav.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="css/star-animation.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-xxl navbar-dark bg-black bg-gradient p-2">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbars" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbars">
                <ul class="navbar-nav me-auto mb-2 mb-xl-0 fs-6">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="./"><i class="ti ti-home"></i> หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'download.php') ? 'active' : ''; ?>" href="download.php"><i class="ti ti-download"></i> ดาวน์โหลดเกมส์</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo in_array($current_page, ['server-info.php', 'woe-info.php', 'boss-time.php']) ? 'active' : ''; ?>" href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-question-mark"></i> แนะนำผู้เล่นใหม่</a>
                        <ul class="dropdown-menu dropdown-menu-dark fs-4">
                            <li>
                                <a class="dropdown-item" href="server-info.php"><i class="ti ti-chevron-right"></i> ข้อมูลเซิร์ฟเวอร์</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="woe-info.php"><i class="ti ti-chevron-right"></i> ข้อมูลกิลด์วอร์</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="boss-time.php"><i class="ti ti-chevron-right"></i> ข้อมูลเวลาบอส</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.facebook.com/groups/"><i class="ti ti-brand-facebook"></i> กลุ่มพูดคุย - ซื้อขาย</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.facebook.com/eddgastudio.official"><i class="ti ti-brand-meta"></i> ติดตามข่าวสาร</a>
                    </li>
                </ul>
                <div class="text-end">
<?php
    $ssid = $_SESSION["SESSION_COUNTID"] ?? "";
    if (!$ssid) {
?>
                    <a href="login.php" class="btn btn-primary btn-lg fs-6"><i class="ti ti-login"></i> เข้าสู่ระบบ</a>
                    <a href="register.php" class="btn btn-outline-warning btn-lg fs-6"><i class="ti ti-user-plus"></i> สมัครสมาชิก</a>
<?php } else { ?>
                    <a href="logout.php" class="btn btn-light btn-lg fs-6"><i class="ti ti-logout-2"></i> ออกจากระบบ</a>
<?php } ?>
                </div>
            </div>
        </div>
    </nav>