<?php

namespace App\Helpers;


class VerificaRFC
{
  /**
   * Valida un RFC
   *
   * @param string $rfc a validar
   * @return multiple int 1 si el $rfc es valido 0 si no. boolean FALSE si sucede un error.
   * @link http://php.net/manual/en/function.preg-match.php
   */
  public static function validarRFC($rfc)
  {
  	$regex = '/^[A-Z]{4}([0-9]{2})(1[0-2]|0[1-9])([0-3][0-9])([ -]?)([A-Z0-9]{4})$/';
  	return preg_match($regex, $rfc);
  }//fin función

  public static function validarCURP($curp)
  {
       $valor = $curp;
   if(strlen($valor)==18){
      $letras     = substr($valor, 0, 4);
      $numeros    = substr($valor, 4, 6);
      $sexo       = substr($valor, 10, 1);
      $mxState    = substr($valor, 11, 2);
      $letras2    = substr($valor, 13, 3);
      $homoclave  = substr($valor, 16, 2);
        if(ctype_alpha($letras) && ctype_alpha($letras2) && ctype_digit($numeros) && ctype_digit($homoclave) && VerificaRFC::is_mx_state($mxState) && VerificaRFC::is_sexo_curp($sexo)){
          return true;
      }
    return false;
     }  else{
       return false;
      }

    }

    public static function is_mx_state($state){
    $mxStates = [
        'AS','BS','CL','CS','DF','GT',
        'HG','MC','MS','NL','PL','QR',
        'SL','TC','TL','YN','NE','BC',
        'CC','CM','CH','DG','GR','JC',
        'MN','NT','OC','QT','SP','SR',
        'TS','VZ','ZS'
    ];
    if(in_array(strtoupper($state),$mxStates)){
        return true;
    }
      return false;
    }

    public static function is_sexo_curp($sexo){
      $sexoCurp = ['H','M'];
      if(in_array(strtoupper($sexo),$sexoCurp)){
         return true;
      }
      return false;
    }


}
