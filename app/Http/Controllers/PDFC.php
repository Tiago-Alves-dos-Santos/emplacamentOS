<?php

namespace App\Http\Controllers;
use PDF;
use App\Models\OS;
use Illuminate\Http\Request;

class PDFC extends Controller
{
    public function os(Request $request)
    {
        $os = OS::find($request->id);
        $pdf = PDF::loadView('pdf.os', compact('os'));
        $pdf->setOptions(['isPhpEnabled' => true]);
        return $pdf->stream("os.pdf");
    }
}
