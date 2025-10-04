<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::latest()->paginate(10);
        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rpt_date' => 'required|date',
            'rpt_month' => 'required|integer|min:1|max:12',
            'rpt_year' => 'required|digits:4',
        ]);

        Report::create([
            'rpt_usr_id' => Auth::id(),
            'rpt_date' => $request->rpt_date,
            'rpt_month' => $request->rpt_month,
            'rpt_year' => $request->rpt_year,
            'rpt_created_by' => Auth::id(),
        ]);

        return redirect()->route('reports.index')->with('success', 'Report created successfully.');
    }

    public function show(Report $report)
    {
        return view('reports.show', compact('report'));
    }

    public function edit(Report $report)
    {
        return view('reports.edit', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $request->validate([
            'rpt_date' => 'required|date',
            'rpt_month' => 'required|integer|min:1|max:12',
            'rpt_year' => 'required|digits:4',
        ]);

        $report->update([
            'rpt_date' => $request->rpt_date,
            'rpt_month' => $request->rpt_month,
            'rpt_year' => $request->rpt_year,
            'rpt_updated_by' => Auth::id(),
        ]);

        return redirect()->route('reports.index')->with('success', 'Report updated successfully.');
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Report deleted successfully.');
    }
}
