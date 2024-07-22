<!-- <link rel="apple-touch-icon" sizes="57x57" href="home/img/favicon/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="home/img/favicon/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="home/img/favicon/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="home/img/favicon/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="home/img/favicon/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="home/img/favicon/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="home/img/favicon/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="home/img/favicon/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="home/img/favicon/apple-touch-icon-180x180.png">
<link rel="icon" type="home/image/png" href="home/img/favicon/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="home/image/png" href="home/img/favicon/android-chrome-192x192.png" sizes="192x192">
<link rel="icon" type="home/image/png" href="home/img/favicon/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="home/image/png" href="home/img/favicon/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="home/img/favicon/manifest.json">
<link rel="shortcut icon" href="home/img/favicon/favicon.ico">
<meta name="msapplication-TileColor" content="#663fb5">
<meta name="msapplication-TileImage" content="home/img/favicon/mstile-144x144.png">
<meta name="msapplication-config" content="home/img/favicon/browserconfig.xml">
<meta name="theme-color" content="#663fb5"> -->


<!-- <link rel="stylesheet" type="text/css" href="./asset/css/bootstrap.min.css"> -->

<!-- <link rel="stylesheet" type="text/css" href="./asset/sweetalert/dist/sweetalert.css">
<script src="./asset/js/jquery.min.js" ></script>
<script src="./asset/js/bootstrap.min.js" ></script> -->

<!-- <link rel="stylesheet" type="text/css" href="./asset/css/dataTables.bootstrap.min.css" />
<script src="./asset/js/datatables.min.js"></script>
<script src="./asset/js/dataTables.bootstrap.min.js"></script> -->
<!-- <script type="text/javascript" src="./asset/sweetalert/dist/sweetalert.min.js"></script> -->


<link rel="shortcut icon" href="../asset/img/svg/amanah_logo.svg" type="image/x-icon">


<link rel="stylesheet" href="./assets/compiled/css/app.css">
<link rel="stylesheet" href="./assets/compiled/css/app-dark.css">
<link rel="stylesheet" href="./assets/compiled/css/iconly.css">

<script src="assets/static/js/components/dark.js"></script>
<script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<!-- Bootstrap CSS -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script src="assets/compiled/js/app.js"></script>



<!-- DataTables -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>



<!-- Need: Apexcharts -->
<script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
<script src="assets/static/js/pages/dashboard.js"></script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('logoutButton').addEventListener('click', function() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Anda akan logout!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, logout!',
            cancelButtonText: 'Tidak, tetap login'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'logout.php';
            }
        });
    });
</script>