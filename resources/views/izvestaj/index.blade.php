<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Izveštaji</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="mb-4 text-center">📑 Lista Izveštaja</h1>

    @if($izvestajs->isEmpty())
        <div class="alert alert-info text-center">
            Trenutno nema unetih izveštaja.
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach($izvestajs as $izvestaj)
                <div class="col">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $izvestaj->title }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($izvestaj->contents, 150) }}</p>
                            <a href="{{ route('izvestajs.show', $izvestaj) }}" class="btn btn-primary btn-sm">
                                Detaljnije
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
