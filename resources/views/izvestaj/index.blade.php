@extends('layouts.app')
@section('content')

@section('content')
<div class="container py-5">
    {{-- Naslov --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold">Generisanje izveštaja</h1>
    </div>

    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Lista Izveštaja</h5>
        </div>
        <div class="card-body">
            @if($izvestajs->isEmpty())
                <div class="alert alert-info text-center">Trenutno nema izveštaja.</div>
            @else
                <form action="{{ route('izvestajs.generate') }}" method="POST">
                    @csrf

                    {{-- Tabela sa stilom --}}
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Odaberi</th>
                                    <th>Opis</th>
                                    <th>Količina</th>
                                    <th>Lokacija</th>
                                    <th>Šifra</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($izvestajs as $izvestaj)
                                <tr>
                                    <td>{{ $izvestaj->id }}</td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="izvestaji[]" value="{{ $izvestaj->id }}" id="izvestaj{{ $izvestaj->id }}">
                                        </div>
                                    </td>
                                    <td>{{ $izvestaj->title }}</td>
                                    <td>{{ $izvestaj->kolicina ?? '-' }}</td>
                                    <td>{{ $izvestaj->lokacija ?? '-' }}</td>
                                    <td>{{ $izvestaj->sifra ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Polje za opis --}}
                    <div class="mb-3 mt-4">
                        <label for="opis" class="form-label fw-bold">Opis generisanog izveštaja</label>
                        <textarea name="opis" id="opis" rows="4" class="form-control" placeholder="Unesite opis izveštaja..."></textarea>
                    </div>

                    {{-- Dugme --}}
                    <div class="text-end">
                        <button type="submit" class="btn btn-success btn-lg">Generiši izveštaj</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>

{{-- Opcionalno: bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
