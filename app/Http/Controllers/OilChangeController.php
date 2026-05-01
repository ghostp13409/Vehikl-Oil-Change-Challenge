<?php

namespace App\Http\Controllers;

use App\Models\OilChangeCheck;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OilChangeController extends Controller
{
    public function index()
    {
        return view("form");
    }

    public function check(Request $request)
    {
        $validated = $request->validate([
            "current_odometer" => [
                "required",
                "integer",
                "min:0",
                function ($attribute, $value, $fail) use ($request) {
                    if ($value < $request->previous_oil_change_odometer) {
                        $fail(
                            "The current odometer must be greater or equal to the odometer at previous oil change.",
                        );
                    }
                },
            ],
            "previous_oil_change_date" => [
                "required",
                "date",
                function ($attribute, $value, $fail) {
                    if (!Carbon::parse($value)->isPast()) {
                        $fail(
                            "Date of previous oil change must be in the past.",
                        );
                    }
                },
            ],
            "previous_oil_change_odometer" => "required|integer|min:0",
        ]);

        $isDue = $this->calculateIfDue($validated);

        $check = OilChangeCheck::create([
            "current_odometer" => $validated["current_odometer"],
            "previous_oil_change_date" =>
                $validated["previous_oil_change_date"],
            "previous_oil_change_odometer" =>
                $validated["previous_oil_change_odometer"],
            "is_due" => $isDue,
        ]);

        return redirect()->route("result", ["id" => $check->id]);
    }

    public function result($id)
    {
        $check = OilChangeCheck::findOrFail($id);
        return view("result", compact("check"));
    }

    private function calculateIfDue($data)
    {
        $prevDate = Carbon::parse(
            $data["previous_oil_change_date"],
        )->startOfDay();
        $kmSinceLast =
            $data["current_odometer"] - $data["previous_oil_change_odometer"];

        // A car needs an oil change if it's been MORE THAN 5000 km
        $dueByDistance = $kmSinceLast > 5000;

        // OR if it's been MORE THAN 6 months
        // If we subtract 6 months from now, and the previous date is BEFORE that, it's more than 6 months.
        $sixMonthsAgo = now()->subMonths(6)->startOfDay();
        $dueByTime = $prevDate->lessThan($sixMonthsAgo);

        return $dueByDistance || $dueByTime;
    }
}
