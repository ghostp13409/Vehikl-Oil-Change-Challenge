<x-layout title="Oil Change Check">
    <x-header title="Vehikl Oil Check Challange" separator />

    <div class="flex-col gap-10 items-center">

        <x-card title="Quick Fill (Testing):" seperator class="max-w-2xl mx-auto shadow-lg">
            <div class="flex gap-4 flex-wrap">
                <button type="button" onclick="fillForm(7000, '{{ now()->subMonths(1)->format('Y-m-d') }}', 1000)"
                    class="btn btn-primary">Due (Distance)</button>
                <button type="button" onclick="fillForm(2000, '{{ now()->subMonths(7)->format('Y-m-d') }}', 1500)"
                    class="btn btn-primary">Due
                    (Time)</button>
                <button type="button" onclick="fillForm(3000, '{{ now()->subMonths(2)->format('Y-m-d') }}', 2500)"
                    class="btn btn-primary">Not
                    Due</button>
            </div>
        </x-card>


        <x-card class="max-w-2xl mx-auto shadow-lg mt-10">
            <x-header title="Oil Change Check" subtitle="Fill in the details below" />



            {{-- Standard Laravel POST Form --}}
            <x-form method="POST" action="/check">
                @csrf

                <div class="grid gap-4">
                    {{-- Current Odometer --}}
                    <x-input label="Current Odometer (km)" name="current_odometer" type="number"
                        placeholder="e.g. 50000" value="{{ old('current_odometer') }}" />
                    @error('current_odometer')
                        <div class="text-error text-sm mt-1">{{ $message }}</div>
                    @enderror

                    {{-- Previous Change Date --}}
                    <x-input label="Date of Last Oil Change" name="previous_oil_change_date" type="date"
                        value="{{ old('previous_oil_change_date') }}" />
                    @error('previous_oil_change_date')
                        <div class="text-error text-sm mt-1">{{ $message }}</div>
                    @enderror

                    {{-- Previous Odometer --}}
                    <x-input label="Odometer at Last Change (km)" name="previous_oil_change_odometer" type="number"
                        placeholder="e.g. 50000" value="{{ old('previous_oil_change_odometer') }}" />
                    @error('previous_oil_change_odometer')
                        <div class="text-error text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <x-slot:actions>
                    <x-button label="Clear" type="reset" class="btn-ghost" />
                    <x-button label="Check" type="submit" class="btn-primary" />
                </x-slot:actions>
            </x-form>
        </x-card>
    </div>

    <script>
        function fillForm(currentOdometer, previousChangeDate, previousOdometer) {
            document.querySelector('input[name="current_odometer"]').value = currentOdometer;
            document.querySelector('input[name="previous_oil_change_date"]').value = previousChangeDate;
            document.querySelector('input[name="previous_oil_change_odometer"]').value = previousOdometer;
        }
    </script>
</x-layout>
