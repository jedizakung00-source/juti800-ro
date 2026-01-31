    <div class="bg-footer p-5">
        <div class="container">
            <img src="img/pur.png" class="img-fluid mx-auto d-block c-img" data-aos="fade-up" data-aos-duration="1000">
            <div class="fs-3 text-center text-uppercase text-light bg-dark p-5 rounded-4 shadow-lg" style="--bs-bg-opacity: .8;" data-aos="fade-down" data-aos-duration="1000">
                สวัสดีชาว ro วันนี้เรามีโปเจคที่ชือว่า eddga-studio.official เป็นแนวเล่นสนุก เน้นสังคมปาตี้เล่นระยะยาว
                แนวทางเซิร์ฟ จะเป็นนาวแทางผสมผสาน ยุคใหม่และยุคเก่าเข้าด้วยกัน
                PC สามารถเปิดได้ 999 จอต่อ ip และรองรับ ระบบมือถือ ( ในอนาคต เร็วๆนี้ ก่อนชาติหน้า )
                eddga-studio.official จะมีการปรับสมดุลบางอย่างเพื่อให้สมดุลมากยิ่งขึ้น จะอ้างอิงแพท pre-Renewal
                โดยปกติแพทนี้ Lv มอนเตอร์จะน้อยและเลือดจะน้อยตาม เราได้ทำการปรับสมดุล Lv มอนเตอร์และ Hp ให้สมดุล
                ในแพท pre-Renewal มอนเตอร์ จะถูกเปลี่ยนแปลงไปจากแพทเก่าๆ และการอัพสเตตัสจะถูกเปลี่ยนใหม่ทั้งหมด
                ในรอบนี้ เราได้ทำการพัฒนาระบบ เพิ่มระบบ สัตว์เลี้ยงเข้ามาเพื่้อให้มีความแปลกใหม่มากยิ่งขึ้น
            </div>
        </div>
    </div>
    <div class="py-5 bg-dark bg-gradient text-light">
        <div class="container">
            <div class="text-center text-uppercase pt-3">© copyright 2016-2025,WebSite Ragnarok Free By.Eddga-Studio</div>
            <div class="text-center text-uppercase">Designed By : Eggda-Studio.Official All Rights Reserved</div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script src="js/noclick.js"></script>
    
    <?php
        if (isset($page_specific_scripts)) {
            echo $page_specific_scripts;
        }
    ?>

    <script>
        AOS.init();
    </script>

    <div class="position-fixed bottom-0 end-0 p-3 d-flex flex-column align-items-end gap-2" style="z-index: 1050;">
        <!-- Theme Toggle Button -->
        <button id="themeToggleBtn" class="btn btn-light rounded-circle shadow d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border: none;">
            <i class="ti ti-moon" id="themeIcon" style="font-size: 1.5rem;"></i>
        </button>

        <!-- Scroll to Top Button -->
        <button id="scrollToTopBtn" class="btn btn-danger rounded-circle shadow d-flex align-items-center justify-content-center" style="display: none; width: 50px; height: 50px; border: none;">
            <i class="ti ti-arrow-up" style="font-size: 1.5rem;"></i>
        </button>
    </div>
    <script>
        $(document).ready(function() {
            var scrollToTopBtn = $('#scrollToTopBtn');
            var themeToggleBtn = $('#themeToggleBtn');
            var themeIcon = $('#themeIcon');
            var htmlElement = $('html');

            function handleScroll() {
                if ($(window).scrollTop() > 100) {
                scrollToTopBtn.addClass('show');
                } else {
                scrollToTopBtn.removeClass('show');
                }
            }

            handleScroll();
            $(window).on('scroll', handleScroll);

            scrollToTopBtn.on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({ scrollTop: 0 }, 'smooth');
            });

            function setTheme(theme) {
                htmlElement.attr('data-bs-theme', theme);
                localStorage.setItem('theme', theme);
                theme === 'dark' ? themeIcon.removeClass('ti-moon').addClass('ti-sun') : themeIcon.removeClass('ti-sun').addClass('ti-moon');
                theme === 'dark' ? themeToggleBtn.removeClass('btn-light').addClass('btn-dark') : themeToggleBtn.removeClass('btn-dark').addClass('btn-light');
            }

            setTheme(localStorage.getItem('theme') || 'light');

            themeToggleBtn.on('click', function() {
                var newTheme = htmlElement.attr('data-bs-theme') === 'dark' ? 'light' : 'dark';
                setTheme(newTheme);
            });
        });
    </script>
    </body>
</html>
<?php
    $pdo = null;
    ob_end_flush();
?>