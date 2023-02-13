<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $lead = Lead::query();

        if ($request->has('lead_type')) {
            $lead->where('lead_type', $request->lead_type);
        }

        return $lead->get();
    }

    public function indexActive()
    {
        return Lead::where('is_active', 1)->get();
    }

    public function store(Request $request)
    {
        return Lead::create($request->all());
    }

    public function show(Lead $lead)
    {
        return $lead;
    }

    public function update(Lead $lead, Request $request)
    {
        $lead->fill($request->all())->save();

        return $lead;
    }

    public function destroy(Lead $lead)
    {
        $lead->fill(['is_active' => 0])->save();

        return $lead;
    }
}
