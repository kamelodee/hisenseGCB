<?php

namespace App\Services\MessageApi;
{
	class Message
    {
        //**********************************************
        // Id
        //**********************************************
        		
		public $ID = null;
		
        //**********************************************
        // From
        //**********************************************

        public $FromConnection = null;
				
        public $FromAddress = null;
					
		public $FromStation = null;
		
        //**********************************************
        // To
        //**********************************************

		public $ToConnection = null;
		
		public $ToAddress = null;
		
		public $ToStation = null;
		
        //**********************************************
        // Text
        //**********************************************

		public $Text = null;
		
        //**********************************************
        // Dates
        //**********************************************

		public $CreateDate = null;
		
		public $ValidUntil = null;
		
		public $TimeToSend = null;
		
        //**********************************************
        //* Reports
        //**********************************************

		public $IsSubmitReportRequested = True;
		
		public $IsDeliveryReportRequested = True;
		
		public $IsViewReportRequested = True;
				
		public $tags = array();
		
        public function AddTag($key, $value)
        {            
           $this -> tags[strval($key)] = strval($value);           
        }		
		
		public function GetTags() {
			return $this->tags;
		}
		

        //**********************************************
        // Construction
        //**********************************************
		
		function genguid($data = null) 
		{
			// Generate 16 bytes (128 bits) of random data or use the data passed into the function.
			$data = $data ?? random_bytes(16);
			assert(strlen($data) == 16);

			// Set version to 0100
			$data[6] = chr(ord($data[6]) & 0x0f | 0x40);
			// Set bits 6-7 to 10
			$data[8] = chr(ord($data[8]) & 0x3f | 0x80);

			// Output the 36 character UUID.
			return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
		}

        function __construct()
        {	
            $this -> ID = $this -> genguid();
			
            $this -> CreateDate = date("Y-m-d H:i:s");
            $this -> TimeToSend = date("Y-m-d H:i:s");
			
			$date = strtotime("+7 day");
            $this -> ValidUntil = date("Y-m-d H:i:s", $date);
			
            $this -> IsSubmitReportRequested = true;
            $this -> IsDeliveryReportRequested = true;
            $this -> IsViewReportRequested = true;			
        }
		
		public function __toString(){
			$ret = "";
			if(!empty($this -> FromAddress))
				$ret .= $this -> FromAddress;
			else
				$ret .= $this -> FromConnection;
			
			$ret .= "->";
			
			if(!empty($this -> ToAddress))
				$ret .= $this -> ToAddress;
			else
				$ret .= $this -> ToConnection;
			
			if(!empty($this -> Text))
				$ret .= " '" . $this -> Text . "'";
			
			return $ret;
		}
	}	
}
?>