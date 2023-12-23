<?php

class VPS{
    private $nCPU;
    private $nRAM;
    private $nDisk;
    private $SO;
    private $IP;

    function __construct($nCPU, $nRAM, $nDisk, $SO, $IP) {
        $this->nCPU = $nCPU;
        $this->nRAM = $nRAM;
        $this->nDisk = $nDisk;
        $this->SO = $SO;
        $this->IP = $IP;
    }

    public function Mostrar($e, $d, $l){
        if($e){
            echo "El preu mensual del VPS en Euros és de: ". $this->CalcularEuros() . " €<br>";
        }
        if($d){
            echo "El preu mensual del VPS en Dolars és de: ". $this->CalcularDolars() . " $<br>";
        }
        if($l){
            echo "El preu mensual del VPS en Lliures és de: ". $this->CalcularLliures() . " £<br>";
        }
    }

    function CalcularEuros(){
        $a = $this->nCPU * 2;
        $b = $this->nDisk * 0.15;
        $total = $a + $this->nRAM + $b + $this->SO + $this->IP;
        return $total;
    }

    function CalcularDolars(){
        return $this->CalcularEuros() * 1.10;
    }

    function CalcularLliures(){
        return $this->CalcularEuros() * 0.86;
    }

}

$nCPU = $_POST['cpu'];
$nRAM = $_POST['ram'];
$nDisk = $_POST['disc'];
$SO = $_POST['so'];
$IP = $_POST['ip'];

$euros = $_POST['moneda'][0] ?? null;
$dolars = $_POST['moneda'][1] ?? null;
$lliures = $_POST['moneda'][2] ?? null;

$VPS = new VPS($nCPU, $nRAM, $nDisk, $SO, $IP);

$VPS->Mostrar($euros, $dolars, $lliures);

?>