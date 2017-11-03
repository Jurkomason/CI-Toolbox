<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adaline extends Model
{

    protected $bias;
    protected $numEntradas;
    protected $numDatos;
    protected $weightVector;
    protected $numIterationes = 0;
    protected $numEntradas = 0;


    public function __construct($bias, $numEntradas,$numDatos, $numIteraciones)
    {
        if ($numEntradas < 1) {
            throw new \InvalidArgumentException();
        }
        $this->numEntradas = $numEntradas+2;
        $this->bias = $bias;
        $this->numIteraciones = $numIteraciones;
        $this->numDatos = $numDatos;

        for ($i = 0; $i < $this->numEntradas; $i++) {
            $this->weightVector[$i] = rand()/getrandmax() * 2 - 1;
        }
    }

    /**
     * @param array $entradas array of input signals
     * @param int  $outcome      1 = true / 0 = false
     * @return array
     * @throws \InvalidArgumentException
     */
    public function train($entradas)
    {
        for(j=0;j<$this->numIteraciones;j++){

            $ecm=0;

            for(k=0;k<$this->numDatos;k++){
                //se obtiene el deseado
                $deseadoActual=$entradas[$k][$numEntradas+1];
                $a=0;
                //se calcula la agregación
                for($i=0;$i<$this->numEntradas;$i++){
                    a=a+$entradas[$k][$i]*($this->weightVector[$i]);
                }
                //se aplica la función de activación
                $yk=a;

                $salida[$k]=$yk;
                //se calcula el error y se acumula en el ecm
                $error=$deseadoActual-$yk;
                $ecm=$ecm + ($error^2)/(2*$numDatos);

                //se actualizan los parámetros
                for ($i=0; $i <$this->numEntradas;$i++) {

                    $this->weightVector[$i]=$this->weightVector[$i]+($error*$entradas[$k][$i]);
                }
            }

            if ($ecm==0) {
                $j=$numIteraciones;
            }
        }

        return $salida;
    }
    /**
     * @return array
     */
    public function getWeightVector()
    {
        return $this->weightVector;
    }
    /**
     * @param array $weightVector
     *
     * @throws \InvalidArgumentException
     */
    public function setWeightVector($weightVector)
    {
        if (!is_array($weightVector) || count($weightVector) != $this->numEntradas) {
            throw new \InvalidArgumentException();
        }
        $this->weightVector = $weightVector;
    }
    /**
     * @return int
     */
    public function getBias()
    {
        return $this->bias;
    }
    /**
     * @param float $bias
     *
     * @throws \InvalidArgumentException
     */
    public function setBias($bias)
    {
        if (!is_numeric($bias)) {
            throw new \InvalidArgumentException();
        }
        $this->bias = $bias;
    }
    /**
     * @param array $entradas
     *
     * @return int (0 for false, 1 = true)
     * @throws \InvalidArgumentException
     */
    public function test($entradas)
    {
        if (!is_array($entradas) || count($entradas) != $this->numEntradas) {
            throw new \InvalidArgumentException();
        }
        $testResult = $this->dotProduct($this->weightVector, $entradas) + $this->bias;
        $this->output = $testResult > 0 ? 1 : 0;
        return $this->output;
    }

}