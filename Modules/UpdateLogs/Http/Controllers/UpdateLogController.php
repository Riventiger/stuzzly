<?php

namespace Modules\UpdateLogs\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\UpdateLogs\Models\UpdateLog;

class UpdateLogController extends Controller
{
    public function index()
    {
        $logs = UpdateLog::latest()->paginate(20);

        return view('UpdateLogs::index', compact('logs'));
    }

    public function show(UpdateLog $updateLog)
    {
        return view('UpdateLogs::show', compact('updateLog'));
    }

    public function destroy(UpdateLog $updateLog)
    {
        $updateLog->delete();

        return redirect()->route('updatelogs.index')->with('success', 'Log entry deleted.');
    }

    public function clear()
    {
        UpdateLog::truncate();

        return redirect()->route('updatelogs.index')->with('success', 'All update logs cleared.');
    }
}
