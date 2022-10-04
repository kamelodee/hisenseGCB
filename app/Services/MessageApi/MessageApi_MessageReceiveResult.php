<?php

namespace App\Services\MessageApi;
{	
	class MessageReceiveResult
    {	
		public $Folder;
		
		public $Limit;
		
		public $Messages = array();
		
		function GetMessageCount(){
			return count($this -> Messages);
		}
		
		public function __toString(){
			
            return "Message count: " . $this -> GetMessageCount() . ".";
        }	
	}
}
?>