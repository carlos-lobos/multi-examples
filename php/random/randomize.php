<?php
if (!defined('DFLT_RAND_METHOD')) {
    define('DFLT_RAND_METHOD', "mt_rand");
}

class Randomize {

    var $i_min = null;
    var $i_max = null;
    var $s_method = null;
    var $b_first_getrandom = false;

    function __construct() {
	$this->SetMethod(DFLT_RAND_METHOD);
    }

    function SetMin($i_min) {
	$this->i_min=(int)$i_min;
    }

    function SetMax($i_max) {
	$this->i_max=(int)$i_max;
    }

    function SetMethod($s_method) {
	$this->s_method = (string)$s_method;
    }

    function makeSeed() {
	/* Ejemplo tomado de http://ar2.php.net/manual/en/function.mt-srand.php */
	list($usec, $sec) = explode(' ', microtime());
	return (float) $sec + ((float) $usec * 100000);
    }

    function GetRandom($i_min=null, $i_max=null, $s_method="mt_rand") {
	if ($i_min!==null) {
	    $this->SetMin($i_min);
	}

	if ($i_max!==null) {
	    $this->SetMax($i_max);
	}

	if ($s_method!=DFLT_RAND_METHOD) {
	    $this->s_method=$s_method;
	}

	switch ($this->s_method) {
	    case "rand":
		if(!$this->b_first_getrandom){
		    $this->b_first_getrandom = true;
		    srand($this->makeSeed());
		}
		if ($this->i_min!==null && $this->i_max!==null) {
		    return rand($this->i_min, $this->i_max);
		} else {
		    return rand();
		}
		break;

	    case DFLT_RAND_METHOD:
	    default:
		if(!$this->b_first_getrandom){
		    $this->b_first_getrandom = true;
		    mt_srand($this->makeSeed());
		}
		if ($this->i_min!==null && $this->i_max!==null) {
		    return mt_rand($this->i_min, $this->i_max);
		} else {
		    return mt_rand();
		}
		break;
	}
    }

    function GetRandomCharOfString($s_string) {
	if (empty($s_string)) {
	    return false;
	}

	$i_min=0;
	$i_max=strlen($s_string)-1;
	$i_random=$this->GetRandom($i_min, $i_max);
	$s_random_char=$s_string[$i_random];

	return $s_random_char;
    }
}

?>