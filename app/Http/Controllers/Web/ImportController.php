<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Vanguard\Exports\ComponentsExport;
use Vanguard\Exports\ServicesExport;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Imports\ComponentsImport;
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

    public function importComponent(Request $request)
    {
        $request->validate([
            'component_import' => 'required'
        ]);
        Excel::import(new ComponentsImport($request->component_import), $request->component_import);
        return redirect()->route('imports.index')->with('success', 'All good!');
    }

    public function exportComponent()
    {
        return Excel::download(new ComponentsExport, 'component.xlsx');
    }

    public function exportService()
    {
        return Excel::download(new ServicesExport, 'services.xlsx');
    }
}
