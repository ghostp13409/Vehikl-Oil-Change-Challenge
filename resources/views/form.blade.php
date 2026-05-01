@extends('layouts.app')

@section('content')
    <h1>Oil Change Check</h1>

    <div style="margin-bottom: 20px; padding: 10px; background: #f8f9fa; border: 1px solid #ddd;">
        <strong>Quick Fill (Testing):</strong>
        <button type="button" onclick="fillForm(7000, '{{ now()->subMonths(1)->format('Y-m-d') }}', 1000)" style="background: #6c757d; font-size: 0.8em; padding: 5px 10px;">Due (Distance)</button>
        <button type="button" onclick="fillForm(2000, '{{ now()->subMonths(7)->format('Y-m-d') }}', 1500)" style="background: #6c757d; font-size: 0.8em; padding: 5px 10px;">Due (Time)</button>
        <button type="button" onclick="fillForm(3000, '{{ now()->subMonths(2)->format('Y-m-d') }}', 2500)" style="background: #6c757d; font-size: 0.8em; padding: 5px 10px;">Not Due</button>
    </div>

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

    <script>
        function fillForm(current, date, prev) {
            document.getElementById('current_odometer').value = current;
            document.getElementById('previous_oil_change_date').value = date;
            document.getElementById('previous_oil_change_odometer').value = prev;
        }
    </script>
@endsection
