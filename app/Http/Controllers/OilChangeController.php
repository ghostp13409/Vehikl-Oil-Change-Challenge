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
            "current_odometer" => "required|integer|min:0",
            "previous_oil_change_date" => "required|date|before:today",
            "previous_oil_change_odometer" => "required|integer|min:0",
        ]);

        if (
            $validated["current_odometer"] <
            $validated["previous_oil_change_odometer"]
        ) {
            return back()
                ->withErrors([
                    "current_odometer" =>
                        "The current odometer must be greater or equal to the odometer at previous oil change.",
                ])
                ->withInput();
        }

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
        $kmSinceLast =
            $data["current_odometer"] - $data["previous_oil_change_odometer"];
        $monthsSinceLast = Carbon::parse(
            $data["previous_oil_change_date"],
        )->diffInMonths(now());

        return $kmSinceLast > 5000 || $monthsSinceLast > 6;
    }
}
