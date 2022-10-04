<?php

namespace App\Services\MessageApi;
{
	class MessageSendResults
    {
        public $TotalCount;
		
        public $SuccessCount;
		
        public $FailedCount;
		
        public $Results = array();
		
		
		public function __toString(){
			
            return "Total: " . $this ->TotalCount . ". Success: " . $this ->SuccessCount . ". Failed: " . $this ->FailedCount . ".";
        }
		
    }
 }
?>