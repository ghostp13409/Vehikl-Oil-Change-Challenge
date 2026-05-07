<x-layout title="Result">
    <x-header title="Vehikl Oil Check Challange" separator />

    <div class="flex flex-col gap-5 items-center">
        <x-card title="Oil Change Result" separator class="max-w-md">
            @if ($check->is_due)
                <x-alert class="alert-warning">
                    Oil Change is due!
                </x-alert>
            @else
                <x-alert class="alert-success">
                    Oil Change is not due :D
                </x-alert>
            @endif
        </x-card>

        {{-- Form Values --}}

        <x-card title="Your Input" separator>
            <div class="flex flex-col gap-2">
                <div><strong>Current Odometer:</strong> {{ $check->current_odometer }} km</div>
                <div><strong>Date of Last Oil Change:</strong> {{ $check->previous_oil_change_date->format('Y-m-d') }}
                </div>
                <div><strong>Odometer at Last Change:</strong> {{ $check->previous_oil_change_odometer }} km</div>
            </div>
        </x-card>

        {{-- Go Back Button --}}
        <div class="mt-10">
            <a href="/" class="btn btn-primary">Check Another Vehicle</a>
        </div>
    </div>


</x-layout>
