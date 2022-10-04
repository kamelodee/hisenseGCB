<?php

namespace App\Services\MessageApi;
{	
	class MessageDeleteResult
    {
		public $Folder;
        public static $MessageIdsRemoveSucceeded = array();
        public $MessageIdsRemoveFailed = array();

		function SuccessCount()
		{			
			return (count($this ->MessageIdsRemoveSucceeded));
		}
		
		function FailedCount()
		{			
			return (count($this -> MessageIdsRemoveFailed));
		}
		
		function TotalCount()
		{			
			return ($this -> SuccessCount() + $this -> FailedCount());
		}
		
		public function __toString()
		{
            return "Total: " . $this->TotalCount . ". Success: " . $this->SuccessCount . ". Failed: " . $this->FailedCount . ".";
        }
	}
}
?>