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
use Illuminate\Support\Facades\Log;
use React\Socket\Connector;


class Test{
public static function sendSms(){
$loop = LoopFactory::create();
$logger = new Stdout();
$connector = new Connector($loop);
$smppClient = new Client($connector, $loop);

$smppClient
    ->connect('148.62.76.42:2315')
    ->then(function (Connection $connection) use ($logger) {
        $logger->info('Connected');

        $connection->on(DeliverSm::class, function (DeliverSm $pdu) use ($connection) {
            $connection->replyWith(new DeliverSmResp());
        });

        $bindTransmitter = new BindTransmitter();
        $bindTransmitter->setSystemId('sunelect');
        $bindTransmitter->setPassword('mUjQH5xsb');

        $connection
            ->send($bindTransmitter)
            ->then(function (BindTransmitterResp $pdu) use ($connection, $logger) {
                $logger->info('Binded');
                Log::info("hello");
                $submitSm = new SubmitSm();
                $submitSm->setSourceAddress(new Address(Ton::international(), Npi::isdn(), 'hisenseGH'));
                $submitSm->setDestinationAddress(new Address(Ton::international(), Npi::isdn(), '0248907440'));
                $submitSm->setShortMessage('Hello there!');

                return $connection->send($submitSm);
            })
            ->then(function (SubmitSmResp $pdu) use ($connection, $logger) {
                $logger->info('Submited. message_id: {messageId}', [
                    'messageId' => $pdu->getMessageId(),
                ]);
                $connection->close();
            })
        ;
    })
;

$loop->run();
}
}