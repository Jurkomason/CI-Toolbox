<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perceptron;

class PerceptronController extends Controller
{

}public function index(Request $request)
{
    $datos=$request->input('datos');
    $bias=$request->input('bias');
    $alfa=$request->input('alfa');
    $entradas=array(0,0);
    $salidas=array(0);
    (new Perceptron($datos,$bias,$alfa))->train();
}
