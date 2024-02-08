<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
</head>
<body class="container mt-5">
    <h1 class="mb-4">Pokemon Details</h1>

    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ $pokemon['name'] }}</h2>
            <img src="{{ $pokemon['sprites']['front_default'] }}" alt="{{ $pokemon['name'] }}" class="img-fluid mb-3">

            <a href="{{ url('/') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
