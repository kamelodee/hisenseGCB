<?php

namespace App\Services\MessageApi;
{	
	class MessageManipulateResult
    {
        public $Folder;
        public $MessageIds = array();        
		
		function GetMessageIdCount(){
			return count($this -> MessageIds);
		}
		
		public function __toString()
		{
            return "Updated count: " . $this -> GetMessageIdCount() . ". Folder: " . $this -> Folder . ".";
        }
    }
}
?>