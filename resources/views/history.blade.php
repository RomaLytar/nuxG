@extends('layouts.app')

@section('title', 'History of Games')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Last 3 Results</h2>
                </div>
                <div class="card-body">
                    @if($history->isEmpty())
                        <div class="alert alert-warning text-center">
                            <p>History is empty.</p>
                        </div>
                    @else
                        <ul class="list-group">
                            @foreach ($history as $item)
                                <li class="list-group-item">
                                    <strong>Number:</strong> {{ $item['number'] }},
                                    <strong>Result:</strong> {{ $item['result'] }},
                                    <strong>Win:</strong> {{ $item['win_amount'] }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="text-center mt-4">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
