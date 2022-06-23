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
        $img = public_path('img/teste.jpg');
        $pdf = PDF::loadView('pdf.os', compact('os','img'));
        $pdf->setOptions(['isPhpEnabled' => true, 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        return $pdf->stream("os{$os->id}.pdf");
    }
}
