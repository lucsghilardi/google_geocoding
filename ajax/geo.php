<?php


//PEGA OS VALORES 
$l1=$_POST['l1'];
$l2=$_POST['l2'];
$KEY='ENTRA COM SUA CHAVE API GOOGLE';
$url="https://maps.googleapis.com/maps/api/geocode/json?latlng={$l1},{$l2}&key={$KEY}";

    $curl=curl_init();

    curl_setopt( $curl, CURLOPT_URL, $url );
    curl_setopt( $curl, CURLOPT_MAXCONNECTS, 1 );
    curl_setopt( $curl, CURLOPT_FAILONERROR, FALSE );
    curl_setopt( $curl, CURLOPT_HEADER, FALSE );
    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, TRUE );
    curl_setopt( $curl, CURLOPT_CONNECTTIMEOUT, 15 );
    curl_setopt( $curl, CURLOPT_TIMEOUT, 90 );
    curl_setopt( $curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36' );
    curl_setopt( $curl, CURLINFO_HEADER_OUT, FALSE );

 $resultado = curl_exec($curl);
 $resultado = json_decode($resultado);



$lista_enderecos = ($resultado->results[0]->address_components);

//print_r($lista_enderecos);

$conta =  count($lista_enderecos);


for ($i=0;$i<$conta;$i++)
{

  $resultado_linha =$resultado->results[0]->address_components[$i];



  if ($resultado_linha->types[0]=='administrative_area_level_2')
  {
    $cidade=$resultado_linha->long_name;
  }


}


//RETORNA CIDADE
echo $cidade;




curl_close($curl);

?>