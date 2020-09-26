<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function handle(Request $request)
    {
        $table = $request->table;

        return Excel::download(new UserExport, 'invoices.xlsx');
    }
}
