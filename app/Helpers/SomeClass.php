<?php

namespace App\Helpers;

class SomeClass
{
    public static function bytesToHuman($bytes)
    {
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public static function pagointeExcel( $rt, $pv, $Tn, $n)
    {
      //Tasa de Interes mensual $rt = $tasainteres /12
      //Cantidad de Coutas $Tn
      // Valor Presente $pv
      // couta a calcular $n
      $rt = $rt/100;
      $pagointeres =($pv*$rt*(($rt + 1)**($Tn + 1) - ($rt + 1)**$n)) / (($rt + 1)* (($rt + 1)**$Tn - 1));
      return $pagointeres;
    }
}
