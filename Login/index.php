<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="shortcut icon" href="../asset/img/svg/amanah_logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="../assets/compiled/css/app.css">
    <link rel="stylesheet" href="../assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="../assets/compiled/css/auth.css">

    <style>
    .auth-logo img {
        max-width: 80% !important;
        height: auto !important;
        display: block !important;
        margin: 0 auto 20px !important;
    }

    #auth-right {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        background-color: #f7f7f7;
        /* atau warna latar belakang lain sesuai keinginan Anda */
    }

    #auth-right .hero-img {
        max-width: 100%;
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-20px);
        }
    }
    </style>
</head>

<body>
    <script src="../assets/static/js/initTheme.js"></script>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <img src="../asset/img/logo/logo2.png" alt="Logo">
                    </div>
                    <form method="POST" action="../login.php" onsubmit="return validateForm()">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" name="email" id="email" class="form-control form-control-xl"
                                placeholder="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="pass" id="pass" class="form-control form-control-xl"
                                placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log
                            in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Belum punya akun? <a href="register.php" class="font-bold">Daftar</a>.
                        </p>
                        <!-- <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
                        <img src="../landing-page/assets/img/hero-img2.png" class="img-fluid animated" alt="">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
    function validateForm() {
        var email = document.getElementById('email').value;
        var password = document.getElementById('pass').value;

        if (email.trim() === '' || password.trim() === '') {
            alert('Email dan password harus diisi');
            return false;
        }
        return true;
    }
    </script>
</body>

</html>