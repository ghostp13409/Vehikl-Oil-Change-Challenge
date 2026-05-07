<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOilChangeCheckRequest;
use App\Http\Requests\UpdateOilChangeCheckRequest;
use App\Models\OilChangeCheck;
use Carbon\Carbon;

class OilChangeCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOilChangeCheckRequest $request)
    {
        //
        $is_due = $this->checkIsDue($request);

        $check = OilChangeCheck::create([
            'current_odometer' => $request['current_odometer'],
            'previous_oil_change_date' => $request['previous_oil_change_date'],
            'previous_oil_change_odometer' => $request['previous_oil_change_odometer'],
            'is_due' => $is_due,
        ]);

        return view('oil-change.result', compact('check'));

    }

    /**
     * Display the specified resource.
     */
    public function show(OilChangeCheck $oilChangeCheck)
    {
        //
        $check = $oilChangeCheck;

        return view('oil-change.result', compact('check'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OilChangeCheck $oilChangeCheck)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOilChangeCheckRequest $request, OilChangeCheck $oilChangeCheck)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OilChangeCheck $oilChangeCheck)
    {
        //
    }

    private function checkIsDue($data)
    {
        $previousDate = Carbon::parse($data['previous_oil_change_date'])->startOfDay();
        $kmSinceLast = $data['current_odometer'] - $data['previous_oil_change_odometer'];

        $dueByDistance = $kmSinceLast >= 5000;

        $dueByNow = now()->subMonths(6)->startOfDay();
        $dueByTime = $previousDate->lessThanOrEqualTo($dueByNow);

        return $dueByDistance || $dueByTime;
    }
}
