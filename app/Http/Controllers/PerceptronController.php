<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perceptron;

class PerceptronController extends Controller
{

public function index(Request $request)
{

    $bias=$request->input('bias');
    $numEntradas=$request->input('numEntradas');
    $numDatos=$request->input('numDatos');
    $numIteraciones=$request->input('numIteraciones');

    $perceptron= new Perceptron($bias,$numEntradas,$numDatos,$numIteraciones);

    //x1
    $entradas[0][0]=0;
    $entradas[0][1]=0;
    $entradas[0][2]=1;
    $entradas[0][3]=1;

    //x2
    $entradas[1][0]=0;
    $entradas[1][1]=1;
    $entradas[1][2]=0;
    $entradas[1][3]=1;

    //bias
    $entradas[2][0]=$bias;
    $entradas[2][1]=$bias;
    $entradas[2][2]=$bias;
    $entradas[2][3]=$bias;

    //deseado
    $entradas[3][0]=0;
    $entradas[3][1]=0;
    $entradas[3][2]=0;
    $entradas[3][3]=1;

    $salida=$perceptron->train($entradas);

    foreach ($salida as $yk) {
            echo $yk;
        }
    }
}