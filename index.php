<?php
	if(isset($_SESSION['test_ongoing']))
		header("Location: files/quiz.php");
?>

<html>
	<head>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>SpeedTest</title>
	    <link rel="icon" type="image/png" href="admin/assets/img/favicon.png">
		<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/header.css">
		<link rel="stylesheet" type="text/css" href="css/util.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
		<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
		<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/tilt/tilt.jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>

	</head>

	<body>
		<!-- Header -->
		<header class="header1">
			<!-- Header desktop -->
			<div class="container-menu-header">
				<div class="wrap_header">
					<a href="index.php" class="logo">
						<img src="images/icons/logo.png" alt="IMG-LOGO">
					</a>

					<!-- Header Icon -->

				</div>
			</div>

			<!-- Header Mobile -->
			<div class="wrap_header_mobile">
				<!-- Logo moblie -->
				<a href="index.php" class="logo-mobile">
					<img src="images/icons/logo.png" alt="IMG-LOGO">
				</a>
			</div>
			</div>
		</header>

		<section>
			<div class="limiter">
				<div class="container-login100">
					<div class="wrap-login100">
						<div class="login100-pic js-tilt" data-tilt>
							<img src="images/img-01.png" alt="IMG">
						</div>
						<div class="login100-form validate-form">
						<span class="login100-form-title">
							Вход
						</span>
						
						<div class="wrap-input100 validate-input">
							<input class="input100" id="studentRollNumber" type="text" name="rollNumber"
								placeholder="Номер ученика" required>
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-user-circle-o" aria-hidden="true"></i>
							</span>
							<span class="error text-danger" id="empty_roll_number_field"></span>
						</div>

						<div class="container-login100-form-btn">
							<button class="login100-form-btn" onclick="login()">
								Зайти
							</button>
						</div>

						<div class="text-center p-t-136">
						</div>
</div>
					</div>
				</div>
			</div>
		</section>
		<script>
			$(document).ready(function () {

				if (Cookies.get('last_question_was_answered') != undefined) {
					Cookies.remove('last_question_was_answered');
					Cookies.remove('last_question');
				}
				if (Cookies.get('test_submitted_status') != undefined)
					Cookies.remove('test_submitted_status');	
			});


			$('.js-tilt').tilt({
				scale: 1.1
			})

			function login() {
				var someFieldIsEmpty = false;

				if (!$('#studentRollNumber').val()) {
					someFieldIsEmpty = true;
					$('#empty_roll_number_field').val("Введите номер ученика");
				}

				if (!someFieldIsEmpty) {
					$.ajax({
    type: "POST",
    url: "files/student_login.php",
    data: {
        "rollNumber": $("#studentRollNumber").val(),
    },
    success: function (response) {
	
        if (response === "STUDENT_RECORD_NOT_FOUND") {
			alert("Данный ученик не найден");
            
        } else {
            window.location.replace("files/dashboard.php");
        }
    },
    error: function (xhr, status, error) {
        console.error("AJAX request failed:", status, error);
    }
});
				}
			}
		</script>
	</body>
</html>