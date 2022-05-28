<?php

/**
 * Example of Time keeper
 */

class TimeKeeper {
	var $b_stdout;
	var $EOL;
	
	var $i_precision;
	
	var $f_start_time;
	var $f_partial_time;
	
	var $a_times;
	var $a_diffs;
	
	function __construct($s_eol="\n"){
		$this->EOL=$s_eol;
	}
	
	function Microtime($b_get_as_float=true){
		$mtime=false;
		
		if(substr(PHP_VERSION,0,1)<5){
			if($b_get_as_float){
				list($usec, $sec)=explode(" ",microtime());
				$mtime=floatVal(floatVal($sec)+floatVal($usec));
			} else {
				$mtime=microtime();
			}
		} else {
			$mtime=microtime($b_get_as_float);
		}
		
		return $mtime;
	}
	
	function InitTimeKeeper($i_precision=6, $startmark='START'){
		$this->i_precision=$i_precision;
		$this->f_start_time=$this->Microtime();
		
		$this->f_partial_time=$this->f_start_time;
		
		$this->a_times=array();
		$this->a_diffs=array();
		
		$this->a_times[$startmark]=$this->f_start_time;
		$this->a_diffs[$startmark]=0;
	}
	
	function MarkTime($positionmark=false){
		if(!$positionmark){
			$positionmark=count($this->a_times);
		}
		
		$this->f_partial_time=$this->Microtime();
		$this->a_times[$positionmark]=$this->f_partial_time;
		$this->a_diffs[$positionmark]=($this->f_partial_time-$this->f_start_time);
		
		return true;
	}
	
	function EndTimeKeeper($endmark='END', $result_type=''){
		$this->MarkTime($endmark);
		if($result_type=='PRINT'){
			return $this->PrintResult();
		} elseif($result_type=='ARRAY'){
			return $this->GetResultArray();
		}
		return true;
	}
	
	function GetResultArray(){
		$a_resp=array();
		$a_resp['times']=$this->a_times;
		$a_resp['diffs']=$this->a_diffs;
		return $a_resp;
	}
	
	function PrintResult(){
		$key_ant='';
		foreach($this->a_times as $key => $f_time){
			$f_diff_intermark=0;
			if(!empty($key_ant)){
				$f_diff_intermark=$this->a_diffs[$key]-$this->a_diffs[$key_ant];
			}
			$key_ant=$key;
			
			echo sprintf("%-10s: %01.{$this->i_precision}f (%01.{$this->i_precision}f) %s", $key, $this->a_diffs[$key], $f_diff_intermark, $this->EOL);
		}
		return true;
	}
	
}

?>