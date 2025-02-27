<?php

	 //retorna la url del proyecto
	function base_url()
	{
		return BASE_URL;
	}
    //retorna la url de Assets
    function media()
    {
        return BASE_URL."/Assets";
    }
    function headerAdmin($data="")
    {
    $view_header = "Views/Template/header_admin.php";
    require_once ($view_header);
    }
    function footerAdmin($data="")
    {
    $view_footer = "Views/Template/footer_admin.php";
    require_once ($view_footer); 
    }       
	//Muestra informacion formateada
	function dep($data)
	{
		$format = print_r('<pre>');
		$format = print_r($data);
		$format = print_r('</pre>');
		return $format;
	}
   function getModal(string $nameModal, $data)
    {
    $view_modal = __DIR__ . "/../Views/Template/Modals/{$nameModal}.php";
    if (file_exists($view_modal)) {
        require_once $view_modal;        
    } else {
        echo "Error: Modal file not found at $view_modal";
    }
    }

	 //Elimina exceso de espacios entre palabras
	 function strClean($strCadena){
     $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $strCadena);
     $string = trim($string); //Elimina espacios en blanco al inicio y al final
     $string = stripslashes($string); // Elimina las \ invertidas
     $string = str_ireplace("<script>","",$string);
     $string = str_ireplace("</script>","",$string);
     $string = str_ireplace("<script src>","",$string);
     $string = str_ireplace("<script type=>","",$string);
     $string = str_ireplace("SELECT * FROM","",$string);
     $string = str_ireplace("DELETE FROM","",$string);
     $string = str_ireplace("INSERT INTO","",$string);
     $string = str_ireplace("SELECT COUNT(*) FROM","",$string);
     $string = str_ireplace("DROP TABLE","",$string);
     $string = str_ireplace("OR '1'='1","",$string);
     $string = str_ireplace('OR "1"="1"',"",$string);
     $string = str_ireplace('OR ´1´=´1´',"",$string);
     $string = str_ireplace("is NULL; --","",$string);
     $string = str_ireplace("is NULL; --","",$string);
     $string = str_ireplace("LIKE '","",$string);
     $string = str_ireplace('LIKE "',"",$string);
     $string = str_ireplace("LIKE ´","",$string);
     $string = str_ireplace("OR 'a'='a","",$string);
     $string = str_ireplace('OR "a"="a',"",$string);
     $string = str_ireplace("OR ´a´=´a","",$string);
     $string = str_ireplace("OR ´a´=´a","",$string);
     $string = str_ireplace("--","",$string);
     $string = str_ireplace("^","",$string);
     $string = str_ireplace("[","",$string);
     $string = str_ireplace("]","",$string);
     $string = str_ireplace("==","",$string);
     return $string;
 	}

 //Genera una contraseña de 10 caracteres
	function passGenerator($length = 10)
    {
    $pass = "";
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $longitudCadena = strlen($cadena);

    for ($i = 0; $i < $length; $i++) {
        $pos = random_int(0, $longitudCadena - 1);
        $pass .= $cadena[$pos];
    }

    return $pass;
    }


	//Genera un token
	function token()
	{
	    $r1 = bin2hex(random_bytes(10));
	    $r2 = bin2hex(random_bytes(10));
	    $r3 = bin2hex(random_bytes(10));
	    $r4 = bin2hex(random_bytes(10));
	    $token = $r1.'-'.$r2.'-'.$r3.'-'.$r4;
	    return $token;
	}

	//Formato para valores monetarios
	function formatMoney($cantidad){
    $cantidad = number_format($cantidad,2,SPD,SPM);
    return $cantidad;
	}
    

?>