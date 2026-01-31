<?php
    include 'templates/header.php';
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
            <h1 class="display-1 text-center fw-semibold">Register ID Game</h1>
            <h1 class="display-6 text-center text-danger">สมัครสมาชิกไอดีเกมส์</h1>

            <div class="card mt-5 shadow">
                <div class="card-body">
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_POST['userid'];
        $pass = $_POST['pass'];
        $pass_cof = $_POST['pass_cof'];
        $email = $_POST['email'];
        $date = $_POST['date'];
        $cap = $_POST['cap'];
        
        $swalScript = '';

        if (empty($user) || empty($pass) || empty($pass_cof) || empty($email) || empty($date) || empty($cap)) {
            $swalScript = "Swal.fire({ icon: 'error', title: 'ผิดพลาด!', text: 'กรุณากรอกข้อมูลให้ครบถ้วน ทุกช่อง ขอบคุณค่ะ !!!' });";
        } elseif ($cap != $_SESSION['security_code']) {
            $swalScript = "Swal.fire({ icon: 'error', title: 'ผิดพลาด!', text: 'กรุณากรอก Captcha ให้ถูกต้อง ลองใหม่อีกครั้ง !!!' });";
        } elseif (!preg_match("/^[A-Z0-9_]+$/i", $user) || !preg_match("/^[A-Z0-9_]+$/i", $pass)) {
            $swalScript = "Swal.fire({ icon: 'error', title: 'ผิดพลาด!', text: 'Username & Password สามารถใช้ได้เฉพาะตัวอักษรภาษาอังกฤษ, ตัวเลข และเครื่องหมาย _ เท่านั้น' });";
        } elseif ((strlen($user) < 6) || (strlen($user) > 23)) {
            $swalScript = "Swal.fire({ icon: 'error', title: 'ผิดพลาด!', text: 'Username ต้องมีความยาว 6-23 ตัวอักษร' });";
        } elseif ((strlen($pass) < 6) || (strlen($pass) > 23)) {
            $swalScript = "Swal.fire({ icon: 'error', title: 'ผิดพลาด!', text: 'Password ต้องมีความยาว 6-23 ตัวอักษร' });";
        } elseif ($pass != $pass_cof) {
            $swalScript = "Swal.fire({ icon: 'error', title: 'ผิดพลาด!', text: 'ระบุรหัสผ่านไม่ตรงกัน ลองใหม่อีกครั้ง !!!' });";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $swalScript = "Swal.fire({ icon: 'error', title: 'ผิดพลาด!', text: 'รูปแบบอีเมล์ไม่ถูกต้อง ลองใหม่อีกครั้ง !!!' });";
        } else {

            $sql = "SELECT account_id FROM `login` WHERE userid = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$user]);

            if ($stmt->fetch()) {
                $swalScript = "Swal.fire({ icon: 'error', title: 'ผิดพลาด!', text: 'ไอดีเกมส์นี้ถูกใช้งานแล้ว ลองใหม่อีกครั้ง !!!' });";
            } else {
                $sql_login = "INSERT INTO `login` (userid, user_pass, email, birthdate) VALUES (?, ?, ?, ?)";
                $stmt_insert = $pdo->prepare($sql_login);

                if ($stmt_insert->execute([$user, $pass, $email, $date])) {
                    $swalScript = "
                        Swal.fire({
                            icon: 'success',
                            title: 'ทำรายการสำเร็จ',
                            text: 'สมัครสมาชิกเรียบร้อยแล้ว ยินดีต้อนรับ เข้าสู่ระบบได้เลย',
                            timer: 5000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = 'login.php';
                        });
                    ";
                } else {
                    $swalScript = "Swal.fire({ icon: 'error', title: 'ผิดพลาด!', text: 'มีปัญหาการสมัครสมาชิกใช่หรือไม่ โปรดแจ้งทีมงาน Eddga-Studio' });";
                }
            }
        }

        if (!empty($swalScript)) {
            echo "<script>$swalScript</script>";
        }
    }
?>
                    <form method="post" novalidate>
                    <div class="mb-3 mt-3">
                        <label for="user" class="form-label">Username</label>
                        <input type="text" class="form-control form-control-lg" id="user" name="userid" placeholder="ระบุไอดีเกมส์ ตั้งแต่ 6 ตัวอักษรขึ้นไป" autocomplete="off" required>
                        <div id="user" class="form-text text-danger ps-1 pt-2">*ไม่ควรใช้ไอดีซ้ำกับเซิร์ฟเวอร์อื่นเด็ดขาด ไม่งั้นจะถูกแฮกได้ ด้วยความหวังดีจากทีมงาน</div>
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Password</label>
                        <input type="password" class="form-control form-control-lg" id="pass" name="pass" placeholder="ระบุรหัสผ่าน ตั้งแต่ 6 ตัวอักษรขึ้นไป" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="pass_cof" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control form-control-lg" id="pass_cof" name="pass_cof" placeholder="ระบุรหัสผ่านให้ตรงกัน" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control form-control-lg" id="email"
                        name="email" placeholder="ระบุอีเมล์ไว้สำหรับลบตัวละคร" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Birthday</label>
                        <input type="date" class="form-control form-control-lg" id="date" name="date" placeholder="เลือกวัน-เดือน-ปี เกิดสำหรับลบตัวละคร" required>
                    </div>
                    <div class="mb-3">
                        <label for="cap" class="form-label">Captcha</label>
                        <p><img src="config/captcha.php" class="img-thumbnail"></p>
                        <input type="text" class="form-control form-control-lg" maxlength="8" id="cap" name="cap" placeholder="ตอบคำถามข้างบนให้ถูกต้อง" autocomplete="off" required>
                    </div>
                    <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg mt-3 fs-1"><i class="ti ti-users-plus"></i> สมัครสมาชิก</button>
                    <hr>
                    <a href="login.php" class="btn btn-secondary btn-lg mb-3 fs-1"><i class="ti ti-login"></i> เข้าสู่ระบบ</a>
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

<?php
    include 'templates/footer.php';
?>