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

    protected ?string $appId = 'LBjqup2ai1CJFMRC';
    protected ?string $clientId = 'F0TAHPWjC7NHCKZBU9A30kbAJkUdWXhZ';
    protected ?string $clientSecret = 'L9FA8aGbFeOcKOgw';
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
        $this->assertIsString($this->appId);
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

        $addresses = ['2250709474609'];
        $senderName = 'WEB2SMS';

        foreach ($addresses as $address) {
            $this->assertIsBool($message->isAuthorized());
            if ($message->isAuthorized()) {
                $response = $message
                    ->withSenderAddress($this->senderAddress)
                    ->withSenderName($senderName)
                    ->withAddress($address)
                    ->send("Welcome guy. Juste un test d'envoi");
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

        if ($balance->isAuthorized()) {
            $response = $balance->check('CIV');
            $this->assertInstanceOf(
                BalanceResponse::class,
                $response,
            );

            $result = $response->getContracts();
            $this->assertIsArray($result);

            $balance = $response->getContracts()[0];
            $this->assertInstanceOf(
                BalanceData::class,
                $balance
            );

            $this->assertIsString($balance->getStatus());
            $this->assertIsInt($balance->getAvailableUnits());
            $this->assertIsString($balance->getExpirationDate());
        }
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

        if ($statistics->isAuthorized()) {
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

        if ($orders->isAuthorized()) {
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
}