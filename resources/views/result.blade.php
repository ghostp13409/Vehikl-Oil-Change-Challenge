@extends('layouts.app')

@section('content')
    <h1>Oil Change Result</h1>

    <div class="result-message">
        @if($check->is_due)
            <p class="result-due">Your car is due for an oil change.</p>
        @else
            <p class="result-not-due">Your car is not yet due for an oil change.</p>
        @endif
    </div>

    <hr>

    <h3>Original Values Entered:</h3>
    <ul>
        <li><strong>Current Odometer:</strong> {{ $check->current_odometer }} km</li>
        <li><strong>Date of Previous Oil Change:</strong> {{ $check->previous_oil_change_date->format('Y-m-d') }}</li>
        <li><strong>Odometer at Previous Oil Change:</strong> {{ $check->previous_oil_change_odometer }} km</li>
    </ul>

    <div style="margin-top: 20px;">
        <a href="{{ route('home') }}">
            <button type="button">Check Another Car</button>
        </a>
    </div>
@endsection
