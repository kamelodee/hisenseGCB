<?php

namespace App\Services\MessageApi;
{
	class MessageSendResult
    {
        public $Message;       

        public $StatusMessage;

		public function __toString(){
			return $this -> StatusMessage . ", " . strval($this -> Message);
		}
	}
 }
?>