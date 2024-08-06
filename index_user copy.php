<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amanah Laundry - User Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
    }

    .navbar {
        margin-bottom: 30px;
    }

    .card {
        margin-bottom: 20px;
    }

    .footer {
        background-color: #343a40;
        color: white;
        padding: 20px 0;
        text-align: center;
        position: fixed;
        bottom: 0;
        width: 100%;
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Amanah Laundry</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Booking</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pickup</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                        <h5 class="card-title">Book Laundry</h5>
                        <p class="card-text">Make a booking for your laundry needs.</p>
                        <a href="#" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-truck fa-3x mb-3"></i>
                        <h5 class="card-title">Pickup Service</h5>
                        <p class="card-text">Request a pickup for your laundry.</p>
                        <a href="#" class="btn btn-primary">Request Pickup</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-user fa-3x mb-3"></i>
                        <h5 class="card-title">Profile</h5>
                        <p class="card-text">Manage your profile and settings.</p>
                        <a href="#" class="btn btn-primary">View Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 Amanah Laundry. All Rights Reserved.</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>