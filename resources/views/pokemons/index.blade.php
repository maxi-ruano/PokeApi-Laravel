
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .pokemon-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .pokemon-cell {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        .pokemon-cell:hover {
            background-color: #f0f0f0; 
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: url('{{ asset('images/poke.jpg') }}') center bottom no-repeat;
            background-size: cover;
            opacity: 0.5; 
        }
    </style>
</head>
<body class="container mt-5">
    
    <br><br>

    <h1>Poke List</h1>

    <br><br>

    <form class="mb-4" action="{{ url('/') }}" method="get">
        <div class="form-row">
            <div class="col">
                <input type="text" class="form-control" name="name" id="name" value="{{ request('name') }}" placeholder="Search for name">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>
    @if (!empty($searchResults))
        <div id="searchResults" class="mb-4 text-center">
            <a href="{{ url('/') }}" class="btn btn-secondary" style="margin-right: 1050px;">Back</a>
        </div>
    @endif

    <div class="pokemon-grid">
        @forelse ($paginatedResults as $pokemon)
            <div class="pokemon-cell">
                <h3>{{ $pokemon['name'] }}</h3>
                <img src="{{ $pokemon['image_url'] }}" alt="{{ $pokemon['name'] }}">
                <form action="{{ url('/pokemons/' . $pokemon['id']) }}" method="get">
                    <button type="submit" class="btn btn-primary">Details</button>
                </form>
            </div>
        @empty
            <div class="text-center alert alert-warning">
                <p style="color: red">NOT FOUND </p>
            </div>
        @endforelse
    </div>
    
    <br><br>

    {{ $paginatedResults->links('pagination::simple-bootstrap-4') }}

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
