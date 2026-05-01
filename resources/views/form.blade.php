@extends('layouts.app')

@section('content')
    <h1>Oil Change Check</h1>

    <form action="{{ route('check') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="current_odometer">Current Odometer (km)</label>
            <input type="number" name="current_odometer" id="current_odometer" value="{{ old('current_odometer') }}" required>
            @error('current_odometer')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="previous_oil_change_date">Date of Previous Oil Change</label>
            <input type="date" name="previous_oil_change_date" id="previous_oil_change_date" value="{{ old('previous_oil_change_date') }}" required>
            @error('previous_oil_change_date')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="previous_oil_change_odometer">Odometer at Previous Oil Change (km)</label>
            <input type="number" name="previous_oil_change_odometer" id="previous_oil_change_odometer" value="{{ old('previous_oil_change_odometer') }}" required>
            @error('previous_oil_change_odometer')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Check Due Date</button>
    </form>
@endsection
