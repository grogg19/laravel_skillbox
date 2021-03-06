<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\TotalReport;
use Illuminate\Support\Collection;
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
        $data = new Collection($request->post('reports'));

        if ($data->isEmpty()) {
            return back()
                ->withErrors(['Ни один пункт не выбран']);
        }

        TotalReport::dispatch(auth()->user(), $data)->onQueue('reports');
        return back()
            ->with(['status' => 'Запрос на генерацию отчета успешно отправлен.']);
    }

    public function totalReport()
    {
        return view('reports.admin.total');
    }
}
