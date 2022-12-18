<?php declare(strict_types=1);

namespace Aymardk\OrangeApiPhp\Tests;

use Aymardk\OrangeApiPhp\Core\Authorization;
use Aymardk\OrangeApiPhp\Feature\Balance;
use Aymardk\OrangeApiPhp\Feature\PurchaseHistory;
use Aymardk\OrangeApiPhp\Feature\SMSMessage;
use Aymardk\OrangeApiPhp\Feature\Statistics;
use Aymardk\OrangeApiPhp\Model\Data\BalanceData;
use Aymardk\OrangeApiPhp\Model\Data\PartnerStatistic;
use Aymardk\OrangeApiPhp\Model\Data\PurchaseOrder;
use Aymardk\OrangeApiPhp\Model\Response\BalanceResponse;
use Aymardk\OrangeApiPhp\Model\Response\PartnerStatisticResponse;
use Aymardk\OrangeApiPhp\Model\Response\PurchaseOrderResponse;
use Aymardk\OrangeApiPhp\Model\Response\SMSMessageResponse;
use Exception;
use PHPUnit\Framework\TestCase;

class OrangeApiTest extends TestCase
{
    protected string $appId = ''; // TODO: Add correct appId
    protected string $clientId = ''; // TODO: Add correct clientId
    protected string $clientSecret = ''; // TODO: Add correct clientSecret
    protected string $senderAdress = ''; // TODO: Add correct senderAdress
    protected string $messageLogPath = 'log';
    protected string $logPath = 'tmp';

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
        $this->assertIsString($this->appId);
        $this->assertIsString($this->clientId);
        $this->assertIsString($this->clientSecret);
        $this->assertIsString($this->senderAdress);
    }

    public function testLogPath(): void
    {
        $this->assertDirectoryExists($this->logPath);
        $this->assertDirectoryIsWritable($this->logPath);
    }

    public function testMessageLogPath(): void
    {
        $this->assertDirectoryExists($this->messageLogPath);
        $this->assertDirectoryIsWritable($this->messageLogPath);
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

            $addresses = ['']; // Array of numbers to test

            foreach ($addresses as $k => $address) {
                $this->assertIsBool($message->isAuthorized());
                $response = $message
                    ->withSenderAddress($this->senderAdress)
                    ->withAddress($address)
                    ->withSenderName("WEB2SMS")
                    ->send("Welcome guy. Juste un test d'envoi");

                $this->assertInstanceOf(
                    SMSMessageResponse::class,
                    $response
                );
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

            $this->assertIsBool($balance->isAuthorized());
            $response = $balance->check('CIV');

            $this->assertInstanceOf(
                BalanceResponse::class,
                $response
            );

            $this->assertInstanceOf(
                BalanceData::class,
                $response->balance
            );

            $this->assertIsInt($response->balance->availableUnits);
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

                $response = $statistics->check('CIV', $this->appId);

                $this->assertInstanceOf(
                    PartnerStatisticResponse::class,
                    $response
                );

                $this->assertInstanceOf(
                    PartnerStatistic::class,
                    $response->partnerStatistics
                );

                $this->assertIsString($response->partnerStatistics->developerId);
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

                $this->assertIsArray(
                    $response->purchaseOrders
                );

                foreach ($response->purchaseOrders as $purchaseOrder) {
                    $this->assertInstanceOf(
                        PurchaseOrder::class,
                        $purchaseOrder
                    );
                }
            }
        } catch (Exception $e) {
            $this->expectError();
        }
    }
}