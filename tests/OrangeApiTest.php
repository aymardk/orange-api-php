<?php declare(strict_types=1);

namespace Aymardkouakou\OrangeApiPhp\Tests;

use Aymardkouakou\OrangeApiPhp\Core\Authorization;
use Aymardkouakou\OrangeApiPhp\Feature\Balance;
use Aymardkouakou\OrangeApiPhp\Feature\PurchaseHistory;
use Aymardkouakou\OrangeApiPhp\Feature\SMSMessage;
use Aymardkouakou\OrangeApiPhp\Feature\Statistics;
use Aymardkouakou\OrangeApiPhp\Model\Response\PartnerContractResponse;
use Aymardkouakou\OrangeApiPhp\Model\Response\PartnerStatisticResponse;
use Aymardkouakou\OrangeApiPhp\Model\Response\PurchaseOrderResponse;
use Aymardkouakou\OrangeApiPhp\Model\Response\SMSMessageResponse;
use Exception;
use PHPUnit\Framework\TestCase;

class OrangeApiTest extends TestCase
{
    protected string $clientId = 'U9g64qO68IzIjtsaVfA59OaoTNshYyIs';
    protected string $clientSecret = '4ik8PTwtBYRE2KZK';
    protected string $senderAdress = '2250748422030';
    protected string $messageLogPath = './log';
    protected string $logPath = './tmp';

    /**
     * @return Authorization
     */
    protected function getAuthorization(): Authorization
    {
        return
            new Authorization(
                $this->clientId,
                $this->clientSecret,
                false,
                $this->logPath
            );
    }

    public function testCredentials(): void
    {
        $this->assertIsString($this->clientId);
        $this->assertIsString($this->clientSecret);
    }

    public function testLogPath(): void
    {
        $this->assertDirectoryExists($this->logPath);
    }

    public function testMessageLogPath(): void
    {
        $this->assertDirectoryExists($this->messageLogPath);
    }

    public function testAuthorization(): void
    {
        $this->assertInstanceOf(
            Authorization::class,
            $this->getAuthorization()
        );
    }

    public function testSendMessage(): void
    {
        try {
            $message = new SMSMessage($this->getAuthorization(), $this->messageLogPath);
            $this->assertInstanceOf(
                SMSMessage::class,
                $message
            );

            $addresses = ['2250709474609', '2250101668386'];

            foreach ($addresses as $k => $address) {
                if ($isAuthrozed = $message->isAuthorized()) {
                    $this->assertIsBool($isAuthrozed);

                    $response = $message
                        ->withSenderAddress($this->senderAdress)
                        ->withAddress($address)
                        ->send(sprintf("Welcome #%s", $k + 1));

                    $this->assertInstanceOf(
                        SMSMessageResponse::class,
                        $response
                    );
                }
            }
        } catch (Exception $e) {
            $this->expectError();
        }
    }

    public function testBalance(): void
    {
        try {
            $balance = new Balance($this->getAuthorization(), $this->messageLogPath);
            $this->assertInstanceOf(
                Balance::class,
                $balance
            );

            if ($isAuthrozed = $balance->isAuthorized()) {
                $this->assertIsBool($isAuthrozed);

                $response = $balance->check();

                $this->assertInstanceOf(
                    PartnerContractResponse::class,
                    $response
                );
            }
        } catch (Exception $e) {
            $this->expectError();
        }
    }

    public function testStatistics(): void
    {
        try {
            $statistics = new Statistics($this->getAuthorization(), $this->messageLogPath);
            $this->assertInstanceOf(
                Statistics::class,
                $statistics
            );

            if ($isAuthrozed = $statistics->isAuthorized()) {
                $this->assertIsBool($isAuthrozed);

                $response = $statistics->check(['country_code' => 'CIV']);

                $this->assertInstanceOf(
                    PartnerStatisticResponse::class,
                    $response
                );
            }
        } catch (Exception $e) {
            $this->expectError();
        }
    }

    public function testPurchaseOrders(): void
    {
        try {
            $orders = new PurchaseHistory($this->getAuthorization(), $this->messageLogPath);
            $this->assertInstanceOf(
                PurchaseHistory::class,
                $orders
            );

            if ($isAuthrozed = $orders->isAuthorized()) {
                $this->assertIsBool($isAuthrozed);

                $response = $orders->check('CIV');

                $this->assertInstanceOf(
                    PurchaseOrderResponse::class,
                    $response
                );
            }
        } catch (Exception $e) {
            $this->expectError();
        }
    }
}