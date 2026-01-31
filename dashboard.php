<?php
    include 'templates/header.php';

    if (!isset($_SESSION["SESSION_DASHBOARD"]) && $_SESSION["SESSION_DASHBOARD"] !== true) {
	    header("location: login.php");
        exit();
    }
    $id = $_SESSION["SESSION_COUNTID"];
?>
    <div class="template-animation">
        <div class="star-animation">
            <div id="stars4"></div>
            <div id="stars5"></div>
        </div>
        <div class="bg-img">
            <div class="container">
                <img src="img/pur.png" class="img-fluid mx-auto d-block c-img">
            </div>
        </div>
    </div>
    <div class="p-5 bg-body-secondary">
        <div class="container">
            <h1 class="display-1 text-center fw-semibold">Dashboard Member</h1>
            <h1 class="display-6 text-center text-danger">ระบบจัดการข้อมูลผู้ใช้งาน</h1>

            <div class="card mt-5 shadow">
                <div class="card-body p-3">
<?php
$swalScript = '';
$openModal = '';


if (isset($_POST['change_pass'])) {
    $openModal = '#PassModal';
    $passold = $_POST['passold'];
    $passnew = $_POST['passnew'];
    $passnew_cf = $_POST['passnew_cf'];


    $stmt = $pdo->prepare("SELECT account_id FROM `login` WHERE account_id = ? AND user_pass = ?");
    $stmt->execute([$id, $passold]);
    $user = $stmt->fetch();

    if (empty($passold) || empty($passnew) || empty($passnew_cf)) {
        $swalScript = "Swal.fire({ icon: 'error', title: 'ผิดพลาด!', text: 'กรุณากรอกข้อมูลให้ครบถ้วน ทุกช่อง' });";
    } elseif (!$user) {
        $swalScript = "Swal.fire({ icon: 'error', title: 'ผิดพลาด!', text: 'รหัสผ่านเก่าไม่ถูกต้อง ลองใหม่อีกครั้ง' });";
    } elseif ((strlen($passnew) < 6) || (strlen($passnew) > 23)) {
        $swalScript = "Swal.fire({ icon: 'error', title: 'ผิดพลาด!', text: 'โปรดตั้งรหัสผ่านใหม่ 6 - 23 ตัวอักษร' });";
    } elseif ($passnew != $passnew_cf) {
        $swalScript = "Swal.fire({ icon: 'error', title: 'ผิดพลาด!', text: 'รหัสผ่านใหม่ไม่ตรงกัน ลองใหม่อีกครั้ง' });";
    } else {
        $updateStmt = $pdo->prepare("UPDATE `login` SET user_pass = ? WHERE account_id = ?");
        $updateStmt->execute([$passnew, $id]);

        unset($_SESSION["SESSION_DASHBOARD"]);
        $swalScript = "
            Swal.fire({
                icon: 'success',
                title: 'ทำรายการสำเร็จ',
                text: 'เปลี่ยนรหัสผ่านเรียบร้อยแล้ว, กรุณาเข้าระบบใหม่อีกครั้ง',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'login.php';
            });
        ";
    }
}

if (isset($_POST['change_email'])) {
    $openModal = '#EmailModal';
    $passold = $_POST['passold'];
    $emailnew = $_POST['emailnew'];
    $emailnew_cf = $_POST['emailnew_cf'];

    $stmt = $pdo->prepare("SELECT account_id FROM `login` WHERE account_id = ? AND user_pass = ?");
    $stmt->execute([$id, $passold]);
    $user = $stmt->fetch();

    if (empty($passold) || empty($emailnew) || empty($emailnew_cf)) {
        $swalScript = "Swal.fire({ icon: 'error', title: 'ผิดพลาด!', text: 'กรุณากรอกข้อมูลให้ครบถ้วน ทุกช่อง' });";
    } elseif (!$user) {
        $swalScript = "Swal.fire({ icon: 'error', title: 'ผิดพลาด!', text: 'รหัสผ่านเก่าไม่ถูกต้อง ลองใหม่อีกครั้ง' });";
    } elseif ($emailnew != $emailnew_cf) {
        $swalScript = "Swal.fire({ icon: 'error', title: 'ผิดพลาด!', text: 'อีเมล์ใหม่ไม่ตรงกัน ลองใหม่อีกครั้ง' });";
    } elseif (!filter_var($emailnew, FILTER_VALIDATE_EMAIL)) {
        $swalScript = "Swal.fire({ icon: 'error', title: 'ผิดพลาด!', text: 'รูปแบบอีเมล์ไม่ถูกต้อง' });";
    } else {
        $updateStmt = $pdo->prepare("UPDATE `login` SET email = ? WHERE account_id = ?");
        $updateStmt->execute([$emailnew, $id]);

        unset($_SESSION["SESSION_DASHBOARD"]);
        $swalScript = "
            Swal.fire({
                icon: 'success',
                title: 'ทำรายการสำเร็จ',
                text: 'เปลี่ยนอีเมล์ใหม่เรียบร้อยแล้ว, กรุณาเข้าระบบใหม่อีกครั้ง',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'login.php';
            });
        ";
    }
}

ob_start();
?>
<script>
    <?php if (!empty($swalScript)) { echo $swalScript; } ?>

    <?php if (!empty($openModal)): ?>
    document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.querySelector('<?php echo $openModal; ?>'));
        myModal.show();
    });
    <?php endif; ?>
</script>
<?php
$page_specific_scripts = ob_get_clean();
?>
                <ul class="nav nav-pills nav-fill">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0)"><i class="ti ti-layout-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#PassModal"><i class="ti ti-key"></i> เปลี่ยนรหัสผ่าน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#EmailModal"><i class="ti ti-mail"></i> เปลี่ยนอีเมล์</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="ti ti-logout-2"></i> ออกจากระบบ</a>
                    </li>
                </ul>

                <!-- Modal 1 -->
                <div class="modal fade" id="PassModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">เปลี่ยนรหัสผ่าน ID : <?php echo $_SESSION["SESSION_USERID"]; ?></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post">
                                <div class="mb-3">
                                    <label for="user" class="form-label">UserID</label>
                                    <input type="text" class="form-control" id="user" value="<?php echo $_SESSION["SESSION_USERID"]; ?>" autocomplete="off" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="passold" class="form-label">Password Old</label>
                                    <input type="password" class="form-control" id="passold" name="passold" placeholder="ระบุรหัสผ่านใช้ง่านล่าสุด">
                                </div>
                                <div class="mb-3">
                                    <label for="passnew" class="form-label">Password New</label>
                                    <input type="password" class="form-control" id="passnew" name="passnew" placeholder="ระบุรหัสผ่านใหม่ที่ต้องการเปลี่ยน">
                                </div>
                                <div class="mb-3">
                                    <label for="passnew_cf" class="form-label">Confirm Password New</label>
                                    <input type="password" class="form-control" id="passnew_cf" name="passnew_cf" placeholder="ยืนยันหัสผ่านใหม่ที่ต้องการเปลี่ยน">
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" name="change_pass" class="btn btn-primary"><i class="ti ti-send"></i> ส่งข้อมูล</button>
                                </div>
                            </form>                          
                        </div>
                        </div>
                    </div>
                </div>
                <!-- Modal 2 -->
                <div class="modal fade" id="EmailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">เปลี่ยนรหัสผ่าน ID : <?php echo $_SESSION["SESSION_USERID"]; ?></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post">
                                <div class="mb-3">
                                    <label for="user" class="form-label">UserID</label>
                                    <input type="text" class="form-control" id="user" value="<?php echo $_SESSION["SESSION_USERID"]; ?>" autocomplete="off" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="passold" class="form-label">Password Old</label>
                                    <input type="password" class="form-control" id="passold" name="passold" placeholder="ระบุรหัสผ่านใช้ง่านล่าสุด">
                                </div>
                                <div class="mb-3">
                                    <label for="emailnew" class="form-label">Email New</label>
                                    <input type="email" class="form-control" id="emailnew" name="emailnew" placeholder="ระบุรหัสผ่านใหม่ที่ต้องการเปลี่ยน">
                                </div>
                                <div class="mb-3">
                                    <label for="emailnew_cf" class="form-label">Confirm Email New</label>
                                    <input type="email" class="form-control" id="emailnew_cf" name="emailnew_cf" placeholder="ยืนยันหัสผ่านใหม่ที่ต้องการเปลี่ยน">
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" name="change_email" class="btn btn-primary"><i class="ti ti-send"></i> ส่งข้อมูล</button>
                                </div>
                            </form>    
                        </div>
                        </div>
                    </div>
                </div>

                <hr>
<?php
    $stmt = $pdo->prepare("SELECT * FROM `login` WHERE account_id = ?");
    $stmt->execute([$id]);
    $user_row = $stmt->fetch();
?>
                <div class="row">
                    <div class="col-lg-4">
                        <h4 class="mt-3"><i class="ti ti-user"></i> ข้อมูลผู้ใช้งาน</h4>
                        <ul class="list-group mt-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Account ID
                                <span><?php echo htmlspecialchars($user_row['account_id']); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                User ID
                                <span><?php echo htmlspecialchars($user_row['userid']); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Last Login
                                <span><?php echo htmlspecialchars($user_row['lastlogin']); ?></span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-8">
                        <h4 class="mt-3"><i class="ti ti-trophy"></i> ข้อมูลตัวละคร</h4>
<?php
    $stmtc = $pdo->prepare("SELECT * FROM `char` WHERE account_id = ?");
    $stmtc->execute([$id]);

    if ($stmtc->rowCount() > 0) {
?>
                        <table class="table">
                        <thead>
                            <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">ชื่อตัวละคร</th>
                            <th class="text-center">เลเวล/จ็อบ</th>
                            <th class="text-center">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
    $i = 1;
    while ($char_row = $stmtc->fetch()) {
?>
                            <tr>
                            <td class="text-center align-middle"><?php echo $i; ?></td>
                            <td class="text-center align-middle"><?php echo htmlspecialchars($char_row['name']); ?></td>
                            <td class="text-center align-middle"><?php echo htmlspecialchars($char_row['base_level']); ?> / <?php echo htmlspecialchars($char_row['job_level']); ?></td>
                            <td class="text-center align-middle"><?php if ($char_row['online'] == 0) { echo '<span class="badge text-bg-danger rounded-pill">Offline</span>'; } else { echo '<span class="badge rounded-pill text-bg-success">Online</span>'; } ?></td>
                            </tr>
<?php
    $i++;
    }
?>
                        </tbody>
                        </table>
<?php
    } else {
?>
                        <div class="alert alert-danger mt-5" role="alert">
                            <i class="ti ti-exclamation-circle"></i> ไม่พบข้อมูลตัวละคร
                        </div>
<?php
    }
?>
                    </div>
                </div>
                </div>
            </div>

        </div>
    </div>
<?php
    include 'templates/footer.php';
?>