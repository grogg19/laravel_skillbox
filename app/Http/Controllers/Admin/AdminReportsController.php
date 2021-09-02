<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
}
