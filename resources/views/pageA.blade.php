@extends('layouts.app')

@section('title', 'Page A')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Welcome, {{ $user->name }}</h2>
                </div>
                <div class="card-body">

                    <p class="text-center">
                        <strong>Current unique link:</strong>
                        <a href="{{ url('/pageA/'.$user->unique_link) }}">{{ url('/pageA/'.$user->unique_link) }}</a>
                    </p>

                    <div class="d-grid gap-2">
                        <form action="{{ route('pageA.generate', $user->unique_link) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-block">Generate a New Unique Link</button>
                        </form>

                        <form action="{{ route('pageA.deactivate', $user->unique_link) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-block">Deactivate Link</button>
                        </form>

                        <form action="{{ route('pageA.lucky', $user->unique_link) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-block">I'm Feeling Lucky</button>
                        </form>
                    </div>

                    @if (session('randomNumber'))
                        <div class="alert alert-info mt-3">
                            <p><strong>Random number:</strong> {{ session('randomNumber') }}</p>
                            <p><strong>Result:</strong> {{ session('isWin') }}</p>
                            <p><strong>Amount of winnings:</strong> {{ session('winAmount') }}</p>
                        </div>
                    @endif

                    <div class="d-grid gap-2 mt-3">
                        <form action="{{ route('pageA.history', $user->unique_link) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-block">Show Last 3 Results</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
