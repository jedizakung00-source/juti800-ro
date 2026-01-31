<?php
    include 'templates/header.php';

    if (isset($_SESSION["SESSION_DASHBOARD"]) && $_SESSION["SESSION_DASHBOARD"] === true) {
	    header("location: dashboard.php");
        exit();
    }
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
            <h1 class="display-1 text-center fw-semibold">Login Member</h1>
            <h1 class="display-6 text-center text-danger">เข้าสู่ระบบ</h1>

            <div class="card mt-5 shadow">
                <div class="card-body">
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {        
        $user = $_POST['userid'];
        $pass = $_POST['pass'];
        $cap = $_POST['cap'];
        $swalScript = '';

        if (empty($user) || empty($pass) || empty($cap)) {
            $swalScript = "Swal.fire({ icon: 'error', title: 'ผิดพลาด!', text: 'กรุณากรอกข้อมูลให้ครบถ้วน ทุกช่อง ขอบคุณค่ะ !!!' });";
        } elseif ($cap != $_SESSION['security_code']) {
            $swalScript = "Swal.fire({ icon: 'error', title: 'ผิดพลาด!', text: 'กรุณากรอก Captcha ให้ถูกต้อง ลองใหม่อีกครั้ง !!!' });";
        } else {
            $sql = "SELECT * FROM `login` WHERE userid = ? AND user_pass = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$user, $pass]);
            $row = $stmt->fetch();

            if ($row) {
                $_SESSION["SESSION_DASHBOARD"] = true;
                $_SESSION["SESSION_USERID"] = $row['userid'];
                $_SESSION["SESSION_COUNTID"] = $row['account_id'];
                $swalScript = "
                    Swal.fire({
                        icon: 'success',
                        title: 'ทำรายการสำเร็จ',
                        text: 'ยินดีต้อนรับสมาชิก โปรดรอสักครู่ !!!',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = 'dashboard.php';
                    });
                ";
            } else {
                $swalScript = "Swal.fire({ icon: 'error', title: 'ผิดพลาด!', text: 'Username หรือ Password ไม่ถูกต้อง ลองใหม่อีกครั้ง !!!' });";
            }
        }

        if (!empty($swalScript)) {
            echo "<script>$swalScript</script>";
            if (isset($_SESSION["SESSION_DASHBOARD"]) && $_SESSION["SESSION_DASHBOARD"] === true) {
                exit();
            }
        }
    }
?>
                    <form method="post">
                    <div class="mb-3 mt-3">
                        <label for="user" class="form-label">Username</label>
                        <input type="text" class="form-control form-control-lg" id="user" name="userid" placeholder="กรุณาใส่ไอดีเกมส์" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Password</label>
                        <input type="password" class="form-control form-control-lg" id="pass" name="pass" placeholder="กรุณาใส่รหัสผ่าน" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="cap" class="form-label">Captcha</label>
                        <p><img src="config/captcha.php" class="img-thumbnail"></p>
                        <input type="text" class="form-control form-control-lg" maxlength="8" id="cap" name="cap" placeholder="ตอบคำถามข้างบนให้ถูกต้อง" autocomplete="off">
                    </div>
                    <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-danger btn-lg mt-3 fs-1"><i class="ti ti-login"></i> เข้าสู่ระบบ</button>
                    <hr>
                    <a href="register.php" class="btn btn-secondary btn-lg mb-3 fs-1"><i class="ti ti-users-plus"></i> สมัครสมาชิก</a>
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

<?php
    include 'templates/footer.php';
?>