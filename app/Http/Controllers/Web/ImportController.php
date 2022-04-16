<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Vanguard\Exports\ServicesExport;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Imports\ServicesImport;

class ImportController extends Controller
{
    public function index()
    {
        return view('import.index');
    }

    public function importService(Request $request)
    {
        $request->validate([
            'service_import' => 'required'
        ]);
        Excel::import(new ServicesImport(), $request->service_import);
        return redirect()->route('imports.index')->with('success', 'All good!');
    }

    public function exportService()
    {
        return  Excel::download(new ServicesExport,'services.xlsx');
    }
}
