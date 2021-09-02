<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\TotalReport;
use Illuminate\Http\Request;

class AdminReportsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['admin']);
    }

    public function index()
    {
        return view('reports.admin.index');
    }

    public function makeReport(Request $request)
    {
        $data = collect($request->except(['_token']));

        TotalReport::dispatch(auth()->user(), $data);
        return back()
            ->with(['status' => 'Запрос на генерацию отчета отправлен.']);
    }

    public function totalReport()
    {
        return view('reports.admin.total');
    }
}
