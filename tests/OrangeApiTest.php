<?php declare(strict_types=1);

namespace Aymardk\OrangeApiPhp\Tests;

use Aymardk\OrangeApiPhp\Core\Authorization;
use Aymardk\OrangeApiPhp\Feature\Balance;
use Aymardk\OrangeApiPhp\Feature\PurchaseHistory;
use Aymardk\OrangeApiPhp\Feature\SMSMessage;
use Aymardk\OrangeApiPhp\Feature\Statistics;
use Aymardk\OrangeApiPhp\Model\Data\BalanceData;
use Aymardk\OrangeApiPhp\Model\Data\OutboundSMSMessageRequest;
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
    private Authorization $authorization;

    protected ?string $appId = null; // todo
    protected ?string $clientId = 'F0TAHPWjC7NHCKZBU9A30kbAJkUdWXhZ'; // todo
    protected ?string $clientSecret = 'L9FA8aGbFeOcKOgw'; // todo
    protected ?string $senderAddress = '2250000';
    protected ?string $messageLogPath = 'log';
    protected ?string $logPath = 'tmp';

    protected function setUp(): void
    {
        parent::setUp();
        $this->authorization = new Authorization(
            $this->clientId,
            $this->clientSecret,
            $this->logPath
        );
    }

    public function testCredentials(): void
    {
//        $this->assertIsString($this->appId);
        $this->assertIsString($this->clientId);
        $this->assertIsString($this->clientSecret);
        $this->assertIsString($this->senderAddress);
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

    /**
     * @throws Exception
     */
    public function testSendMessage(): void
    {
        $message = new SMSMessage($this->authorization, $this->messageLogPath);
        $this->assertInstanceOf(
            SMSMessage::class,
            $message
        );

        $addresses = ['2250101668386']; // todo
        $senderName = 'WEB2SMS'; // todo
        $messageBody = 'Hello'; // todo

        foreach ($addresses as $address) {
            $response = $message
                ->withSenderAddress($this->senderAddress)
                ->withSenderName($senderName)
                ->withAddress($address)
                ->send($messageBody);

            $this->assertInstanceOf(
                SMSMessageResponse::class,
                $response
            );

            $this->assertInstanceOf(
                OutboundSMSMessageRequest::class,
                $response->getOutboundSMSMessageRequest()
            );
        }
    }

    /**
     * @throws Exception
     */
    public function testBalance(): void
    {
        $balance = new Balance($this->authorization, $this->messageLogPath);
        $this->assertInstanceOf(
            Balance::class,
            $balance
        );

        $response = $balance->check('CIV');
        $this->assertInstanceOf(
            BalanceResponse::class,
            $response,
        );

        $result = $response->getContracts();
        $this->assertIsArray($result);

        $balance = $result[0];
        $this->assertInstanceOf(
            BalanceData::class,
            $balance
        );

        $this->assertIsString($balance->getStatus());
        $this->assertIsInt($balance->getAvailableUnits());
        $this->assertIsString($balance->getExpirationDate());
    }

    /**
     * @throws Exception
     */
    public function testStatistics(): void
    {
        $statistics = new Statistics($this->authorization, $this->messageLogPath);
        $this->assertInstanceOf(
            Statistics::class,
            $statistics
        );

        $response = $statistics->check('CIV', $this->appId);

        $this->assertInstanceOf(
            PartnerStatisticResponse::class,
            $response
        );

        $statistics = $response->getPartnerStatistics();
        $this->assertInstanceOf(
            PartnerStatisticData::class,
            $statistics
        );

        $this->assertIsString($statistics->getDeveloperId());
        $this->assertIsArray($statistics->getStatistics());
    }

    /**
     * @throws Exception
     */
    public function testPurchaseOrders(): void
    {
        $orders = new PurchaseHistory($this->authorization, $this->messageLogPath);
        $this->assertInstanceOf(
            PurchaseHistory::class,
            $orders
        );

        $response = $orders->check('CIV');

        $this->assertInstanceOf(
            PurchaseOrderResponse::class,
            $response
        );

        $this->assertIsArray(
            $response->getPurchaseOrders()
        );

        foreach ($response->getPurchaseOrders() as $purchaseOrder) {
            $this->assertInstanceOf(
                PurchaseOrderData::class,
                $purchaseOrder
            );
        }
    }
}