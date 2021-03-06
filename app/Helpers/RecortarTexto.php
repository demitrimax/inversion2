<?php

namespace App\Helpers;

class RecortarTexto
{

  public static function recortar_texto($texto, $limite=100){
  	$texto = trim($texto);
  	$texto = strip_tags($texto);
  	$tamano = strlen($texto);
  	$resultado = '';
  	if($tamano <= $limite){
  		return $texto;
  	}else{
  		$texto = substr($texto, 0, $limite);
  		$palabras = explode(' ', $texto);
  		$resultado = implode(' ', $palabras);
  		$resultado .= '...';
  	}
  	return $resultado;
  }

}
