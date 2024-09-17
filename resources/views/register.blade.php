@extends('layouts.app')

@section('title', 'Registration')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Registration</h2>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="phonenumber" class="form-label">Phone:</label>
                            <input type="text" name="phonenumber" class="form-control" value="{{ old('phonenumber') }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>

                    @if (session('link'))
                        <div class="alert alert-success mt-3">
                            <p>Your unique link: <a href="{{ session('link') }}">{{ session('link') }}</a></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
