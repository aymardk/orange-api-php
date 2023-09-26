<?php declare(strict_types=1);

namespace Aymardk\OrangeApiPhp\Tests;

use Aymardk\OrangeApiPhp\Core\Authorization;
use Aymardk\OrangeApiPhp\Feature\Balance;
use Aymardk\OrangeApiPhp\Feature\PurchaseHistory;
use Aymardk\OrangeApiPhp\Feature\SMSMessage;
use Aymardk\OrangeApiPhp\Feature\Statistics;
use Aymardk\OrangeApiPhp\Model\Data\BalanceData;
use Aymardk\OrangeApiPhp\Model\Data\PartnerStatisticData;
use Aymardk\OrangeApiPhp\Model\Data\PurchaseOrderData;
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
    protected string $senderAdress = '225xxxxxxxxxx'; // TODO: Add correct senderAdress
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

            if ($message->isAuthorized()) {
                $addresses = ['225xxxxxxxxxx']; // TODO: Add valid numbers for test

                foreach ($addresses as $k => $address) {
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
                $balance,
                "testBalance() #1"
            );

            if ($balance->isAuthorized()) {
                $response = $balance->check('CIV');

                $this->assertInstanceOf(
                    BalanceResponse::class,
                    $response,
                    "testBalance() #2"
                );

                $this->assertInstanceOf(
                    BalanceData::class,
                    $response->balance,
                    "testBalance() #3"
                );

                $this->assertIsString($response->balance->status, "testBalance() #4");
                $this->assertIsInt($response->balance->availableUnits, "testBalance() #5");
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

            if ($statistics->isAuthorized()) {
                $response = $statistics->check('CIV', $this->appId);

                $this->assertInstanceOf(
                    PartnerStatisticResponse::class,
                    $response
                );

                $this->assertInstanceOf(
                    PartnerStatisticData::class,
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

            if ($orders->isAuthorized()) {
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
                        PurchaseOrderData::class,
                        $purchaseOrder
                    );
                }
            }
        } catch (Exception $e) {
            $this->expectError();
        }
    }
}