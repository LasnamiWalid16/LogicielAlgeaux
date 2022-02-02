<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use PDF;

class EmpController extends Controller
{
    public function getFournisseur()
    {
        $fournisseurs=DB::select("select id,nom,date,total from fournisseurs ");

        return view('getFournisseur',compact('fournisseurs'));
 
    }

    public function downloadPDF()
    {
        $fournisseurs=DB::select("select id,nom,date,total from fournisseurs ");

        $pdf=PDF::loadView('getFournisseur',compact('fournisseurs'));

        return $pdf->download('fournisseurs.pdf');
 
    }
}
