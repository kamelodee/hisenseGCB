<?php

namespace App\Services\MessageApi;

use App\Services\MessageApi\Message;
use App\Services\MessageApi\MessageManipulateResult;
use App\Services\MessageApi\MessageReceiveResult;


{
	class MessageSendResult
    {
        public $Message;       

        public $StatusMessage;

		public function __toString(){
			return $this -> StatusMessage . ", " . strval($this -> Message);
		}
	}

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

	class MessageApi	
	{
		public $configuration;
		
		//**********************************************
		// Construction
		//**********************************************
		function __construct($configuration)
		{
			$this -> configuration = $configuration;
		}	
		
		//**********************************************
        // Message properties
        //**********************************************		
		
        //Id
		const PROP_NAME_MESSAGE_ID = "message_id";        
        //From
		const PROP_NAME_FROM_CONNECTION = "from_connection";
		const PROP_NAME_FROM_ADDRESS = "from_address";
		const PROP_NAME_FROM_STATION = "from_station";
        //To
		const PROP_NAME_TO_CONNECTION = "to_connection";
		const PROP_NAME_TO_ADDRESS = "to_address";
		const PROP_NAME_TO_STATION = "to_station";
        //Text
		const PROP_NAME_TEXT = "text";
        //Dates
		const PROP_NAME_CREATE_DATE = "create_date";
		const PROP_NAME_VALID_UNTIL = "valid_until";
		const PROP_NAME_TIME_TO_SEND = "time_to_send";
        //Reports
		const PROP_NAME_SUBMIT_REPORT_REQUESTED = "submit_report_requested";
		const PROP_NAME_DELIVERY_REPORT_REQUESTED = "delivery_report_requested";
		const PROP_NAME_VIEW_REPORT_REQUESTED = "view_report_requested";		
        //Tags
		const PROP_NAME_TAGS = "tags";

        //**********************************************
        // Folder
        //**********************************************
		
		const FOLDER_INBOX = "inbox";
		const FOLDER_OUTBOX = "outbox";
		const FOLDER_SENT = "sent";
		const FOLDER_NOT_SENT = "notsent";
		const FOLDER_DELETED = "deleted";
		
		function getUrl_SendMessage()
		{
			$apiUrl = rtrim($this -> configuration -> ApiUrl,'?');
			return $apiUrl . "?action=sendmsg";
		}
		
		function GetTagsAsArray($tags){
			$tagArray = [];
			foreach($tags as $key => $value){
				array_push($tagArray, array(
					'name' => strval($key),
					'value' => strval($value),
				));
			}
			return $tagArray;
		}
		
		function GetMessageAsArray($message){	
			return array(
				self::PROP_NAME_MESSAGE_ID => $message -> ID,
				self::PROP_NAME_FROM_CONNECTION => $message -> FromConnection,
				self::PROP_NAME_FROM_ADDRESS => $message -> FromAddress,
				self::PROP_NAME_FROM_STATION => $message -> FromStation,
				self::PROP_NAME_TO_CONNECTION => $message -> ToConnection,
				self::PROP_NAME_TO_ADDRESS => $message -> ToAddress,
				self::PROP_NAME_TO_STATION => $message -> ToStation,
				self::PROP_NAME_TEXT => $message -> Text,
				self::PROP_NAME_CREATE_DATE => $message -> CreateDate,
				self::PROP_NAME_VALID_UNTIL => $message -> ValidUntil,
				self::PROP_NAME_TIME_TO_SEND => $message -> TimeToSend,
				self::PROP_NAME_SUBMIT_REPORT_REQUESTED => $message -> IsSubmitReportRequested,
				self::PROP_NAME_DELIVERY_REPORT_REQUESTED => $message -> IsDeliveryReportRequested,
				self::PROP_NAME_VIEW_REPORT_REQUESTED => $message -> IsViewReportRequested,
				self::PROP_NAME_TAGS => $this -> GetTagsAsArray($message -> GetTags()),
			);
		}
		
		function CreateRequestBody_SendMessage($messages)			
		{
			$messageArray = [];
			foreach($messages as $key => $value){
				array_push($messageArray, $this -> GetMessageAsArray($value));
			}
			
			$ret = json_encode(['messages' => $messageArray]);
			return $ret;
		}		
		
		
		function DoRequestPost($url, $contentType, $requestBody, $username , $password)
		{													
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type'. ':' .$contentType));
			curl_setopt($ch, CURLOPT_USERPWD, $username. ":" .$password);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch,CURLOPT_POSTFIELDS, $requestBody);
			$result = curl_exec($ch);
			curl_close($ch);			
			return ($result);
		}	
		
		function getVal($message, $property){
			if(property_exists($message, $property))
			    return $message -> $property;
		     return null;
		}
		
		function ParseMessage($responseMsg){
			$msg = new Message();
			$msg-> ID = $this -> getVal($responseMsg, self::PROP_NAME_MESSAGE_ID);
			$msg-> FromConnection = $this -> getVal($responseMsg, self::PROP_NAME_FROM_CONNECTION);
			$msg-> FromAddress = $this -> getVal($responseMsg, self::PROP_NAME_FROM_ADDRESS);
			$msg-> FromStation = $this -> getVal($responseMsg, self::PROP_NAME_FROM_STATION);
			$msg-> ToConnection = $this -> getVal($responseMsg, self::PROP_NAME_TO_CONNECTION);
			$msg-> ToAddress = $this -> getVal($responseMsg, self::PROP_NAME_TO_ADDRESS);
			$msg-> ToStation = $this -> getVal($responseMsg, self::PROP_NAME_TO_STATION);
			$msg-> Text = $this -> getVal($responseMsg, self::PROP_NAME_TEXT);
			$msg-> CreateDate = $this -> getVal($responseMsg, self::PROP_NAME_CREATE_DATE);
			$msg-> ValidUntil = $this -> getVal($responseMsg, self::PROP_NAME_VALID_UNTIL);
			$msg-> TimeToSend = $this -> getVal($responseMsg, self::PROP_NAME_TIME_TO_SEND); 
			$msg-> IsSubmitReportRequested = $this -> getVal($responseMsg, self::PROP_NAME_SUBMIT_REPORT_REQUESTED);
			$msg-> IsDeliveryReportRequested = $this -> getVal($responseMsg, self::PROP_NAME_DELIVERY_REPORT_REQUESTED); 
			$msg-> IsViewReportRequested = $this -> getVal($responseMsg, self::PROP_NAME_VIEW_REPORT_REQUESTED);
			foreach($responseMsg->tags as $tagIndex => $tagData){
				$msg->AddTag($tagData->name, $tagData->value);
			}
			return $msg;
		}
		
		function ParseSendMessageResult($responseMsg){
			$msgResult = new MessageSendResult();
			$msgResult->Message = $this -> ParseMessage($responseMsg);
			$msgResult->StatusMessage = $responseMsg->status;
			return $msgResult;
		}
		
		function ParseSendMessageResults ($jsonResponse)
		{
			$response = json_decode($jsonResponse);			
			if($response->response_code != 'SUCCESS')
				return null;
			
			$messageResults = [];
			$messages = $response->data->messages;
			foreach($messages as $key => $value)
			{
				$msgResult = $this -> ParseSendMessageResult($value);
				array_push($messageResults, $msgResult);
			}
			
			$results = new MessageSendResults();			
			$results->TotalCount = $response->data->total_count;
			$results->SuccessCount = $response->data->success_count;
			$results->FailedCount = $response->data->failed_count;
			$results->Results = $messageResults;
			
			return($results);
		}		
				
		function SendMuliple($messages)		
        {	
			$username =  $this -> configuration -> Username;
			$password =  $this -> configuration -> Password;
			
            $requestBody = $this -> CreateRequestBody_SendMessage($messages);
            $jsonResponse = $this -> DoRequestPost($this->getUrl_SendMessage(), "application/json", $requestBody, $username, $password);
			$results = $this -> ParseSendMessageResults($jsonResponse);
			return $results;			
        }
		
		function SendSingle($message)
		{
			$results = $this -> SendMuliple(array($message));			
			return $results -> Results[0];
		}
		
		/*************************************
		//Receive
		**************************************/
		
		function getUrl_ReceiveMessage($folder)
        {           
			$apiUrl = rtrim($this -> configuration -> ApiUrl,'?');
			return $apiUrl . "?action=receivemsg&folder=". $folder;
        }
		
		function DoRequestGet($url, $username , $password)
		{													
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url);			
			curl_setopt($ch, CURLOPT_USERPWD, $username. ":" .$password);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);						
			$result = curl_exec($ch);
			
			curl_close($ch);			
			return ($result);
		}	
		
		function ParseReceiveMessageResult($jsonResponse)
		{
			$response = json_decode($jsonResponse);
			
			if($response->response_code != 'SUCCESS')
				return null;
			
			$messageResults = [];
			$messages = $response->data->data;
			foreach($messages as $key => $value)
			{
				$msgResult = $this -> ParseMessage($value);
				array_push($messageResults, $msgResult);
			}
			
			$result = new MessageReceiveResult();						
			$result->Folder = $response->data->folder;
			$result->Limit = $response->data->limit;
			$result->Messages = $messageResults;
			
			return($result);
		}	
		
		function DownloadIncoming()		
        {	
			$username =  $this -> configuration -> Username;
			$password =  $this -> configuration -> Password;
			
            $jsonResponse = $this -> DoRequestGet($this->getUrl_ReceiveMessage(self::FOLDER_INBOX), $username, $password);			
			$results = $this -> ParseReceiveMessageResult($jsonResponse);			
			return $results;			
        }
		
		/*************************************
		//Manipulate
		**************************************/
		
		function CreateRequestBody_ManipulateMessage($folder, $messageIds)			
		{		
			$body = array(
				'folder' => $folder,
				'message_ids' => $messageIds,
			);
			$ret = json_encode($body);			
			return $ret;
		}	
		
		
		function getUrl( $action)
        {
            $apiUrl = rtrim($this -> configuration -> ApiUrl,'?');
			return $apiUrl . "?action=" . $action;
        }
		
		
		function ParseManipulateMessageResult ($jsonResponse)
		{
			$response = json_decode($jsonResponse);	
			
			if($response->response_code != 'SUCCESS')
				return null;
			
			$messageIDResults = [];
			$message_ids = $response->data->message_ids;
			foreach($message_ids as $key => $value)
			{
				$msgIdResult = $value;
				array_push($messageIDResults, $msgIdResult);
			}
			
			$results = new MessageManipulateResult();
			$results->Folder = $response->data->folder; ;
			$results->MessageIds = $messageIDResults;
			
			return($results);
		}		
		
		function manipulate($folder, $messageIds, $action)
        {	
			$username =  $this -> configuration -> Username;
			$password =  $this -> configuration -> Password;
            
            $requestBody = $this -> CreateRequestBody_ManipulateMessage($folder, $messageIds);
			$jsonResponse = $this -> DoRequestPost($this->getUrl($action), "application/json", $requestBody, $username, $password);
			$result = $this -> ParseManipulateMessageResult($jsonResponse);
            return $result;
        }
		
		/*************************************
		//Delete
		**************************************/
		
		function DeleteMultiple($messages){
			$messageIds = [];
			
			foreach($messages as $key => $value)
			{
				$messageId = $value -> ID;
				array_push($messageIds, $messageId);
			}
			
			return $this -> manipulate(self::FOLDER_INBOX,$messageIds,"deletemsg",);
		}
		
		function DeleteSingle($message){
			return $this -> DeleteMultiple(array($message));
		}
			
		
		/*************************************
		//Mark
		**************************************/
		
		function MarkMultiple($messages){
			$messageIds = [];
			
			foreach($messages as $key => $value)
			{
				$messageId = $value -> ID;
				array_push($messageIds, $messageId);
			}
			
			return $this -> manipulate(self::FOLDER_INBOX,$messageIds,"markmsg",);
		}
		
		function MarkSingle($message){
			return $this -> MarkMultiple(array($message));
		}
			
	}	
}

?>