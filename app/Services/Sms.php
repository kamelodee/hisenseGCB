<?php
namespace App\Services;
use alexeevdv\React\Smpp\Client;
use alexeevdv\React\Smpp\Connection;
use alexeevdv\React\Smpp\Pdu\BindTransmitter;
use alexeevdv\React\Smpp\Pdu\BindTransmitterResp;
use alexeevdv\React\Smpp\Pdu\DeliverSm;
use alexeevdv\React\Smpp\Pdu\DeliverSmResp;
use alexeevdv\React\Smpp\Pdu\SubmitSm;
use alexeevdv\React\Smpp\Pdu\SubmitSmResp;
use alexeevdv\React\Smpp\Proto\Address;
use alexeevdv\React\Smpp\Proto\Address\Ton;
use alexeevdv\React\Smpp\Proto\Address\Npi;
use Firehed\SimpleLogger\Stdout;
use React\EventLoop\Factory as LoopFactory;
use React\Socket\Connector;
use Illuminate\Support\Facades\Log;
// require_once 'vendor/autoload.php';
class Sms{
 public static function sendSms($sender, $to, $sms){
$loop = LoopFactory::create();
//  info($loop);
$logger = new Stdout();
$connector = new Connector($loop);
$smppClient = new Client($connector, $loop);

$smppClient
    ->connect('148.62.76.42:2315')
    ->then(function (Connection $connection) use ($logger,$sender,$to,$sms) {
    
        $connection->on(DeliverSm::class, function (DeliverSm $pdu) use ($connection) {
            $connection->replyWith(new DeliverSmResp());
        });
        
        $bindTransmitter = new BindTransmitter();
        $bindTransmitter->setSystemId('sunhelect');
        $bindTransmitter->setPassword('H3tecSE');
        info($bindTransmitter);
        $connection
            ->send($bindTransmitter)
            ->then(function (BindTransmitterResp $pdu) use ($connection, $logger,$sender,$to,$sms) {
                Log::info('connedee');
                $submitSm = new SubmitSm();
                $submitSm->setSourceAddress(new Address(Ton::international(), Npi::isdn(), $sender));
                $submitSm->setDestinationAddress(new Address(Ton::international(), Npi::isdn(), $to));
                $submitSm->setShortMessage($sms);
                $submitSm->setServiceType('suhst');
                return $connection->send($submitSm);
            })
            ->then(
                function (SubmitSmResp $pdu) use ($connection, $logger) {
                Log::info('Submited. message_id: {messageId}', [
                    'messageId' => $pdu->getMessageId(),
                ]);
                $connection->close();
            },
            function(){
                info('faild');
            }
            )
        ;
    },
    
    )
;

$loop->run();
}
}