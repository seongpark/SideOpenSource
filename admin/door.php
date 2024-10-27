<?php
include '../db.php';
include '../detectAccount.php';

if ($member["access"] == "2") {

    ?>
    <!DOCTYPE html>
    <html lang="ko">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>사이드 for Professional</title>
        <link
                rel="shortcut icon"
                type="image/png"
                href="../favicon.ico"
        />
        <link rel="stylesheet" href="assets/css/styles.min.css"/>
    </head>

    <body>
    <!--  Body Wrapper -->
    <div
            class="page-wrapper"
            id="main-wrapper"
            data-layout="vertical"
            data-navbarbg="skin6"
            data-sidebartype="full"
            data-sidebar-position="fixed"
            data-header-position="fixed"
    >
        <?php
        include "includeMenu.php";
        ?>
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->

            <!--  Header End -->
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">문의</h5>
                            <p>사이드 개발자에게 <b>직접 문의를 할 수 있는 핫라인</b>입니다.
                            </p>


                            <form id="contact-form">
                                <input type="text" id="name" name="name"
                                       value="<?php echo htmlentities($member['name'], ENT_QUOTES, 'UTF-8'); ?>" hidden>

                                <label class="form-label">회신 받을 연락처 (이메일 혹은 전화번호)</label>
                                <input type="text" class="form-control" name="email" required>

                                <label class="form-label mt-3">내용</label>
                                <textarea type="text" class="form-control" name="message" required></textarea>

                                <button type="submit" class="btn btn-primary mt-3" style="width: 100%;">제출하기</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- EmailJS SDK -->
    <script type="text/javascript" src="https://cdn.emailjs.com/dist/email.min.js"></script>
    <script type="text/javascript">
        (function () {
            emailjs.init('user_NL267mEmFCTGneeJf8wzs');
        })();

        document.getElementById('contact-form').addEventListener('submit', function (event) {
            event.preventDefault();

            const serviceID = 'service_jls2smf';
            const templateID = 'template_x1t9wnh';

            emailjs.sendForm(serviceID, templateID, this)
                .then(function (response) {
                    console.log('SUCCESS!', response.status, response.text);
                    alert('정상적으로 접수가 완료되었습니다.');
                }, function (error) {
                    console.log('FAILED...', error);
                    alert('다시 시도해주시기 바랍니다.');
                });
        });
    </script>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/sidebarmenu.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="assets/js/dashboard.js"></script>
    </body>
    </html>


<?php } ?>
