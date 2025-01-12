<?php

namespace PayPal\Test\Api;

use PayPal\Common\PayPalModel;
use PayPal\Api\CartBase;
use PHPUnit\Framework\TestCase;

/**
 * Class CartBase
 *
 * @package PayPal\Test\Api
 */
class CartBaseTest extends TestCase
{
    /**
     * Gets Json String of Object CartBase
     * @return string
     */
    public static function getJson()
    {
        return '{"reference_id":"TestSample","amount":' .AmountTest::getJson() . ',"payee":' .PayeeTest::getJson() . ',"description":"TestSample","note_to_payee":"TestSample","custom":"TestSample","invoice_number":"TestSample","purchase_order":"TestSample","soft_descriptor":"TestSample","soft_descriptor_city":"TestSample","payment_options":' .PaymentOptionsTest::getJson() . ',"item_list":' .ItemListTest::getJson() . ',"notify_url":"http://www.google.com","order_url":"http://www.google.com","external_funding":' .ExternalFundingTest::getJson() . ',"type":"TestSample"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return CartBase
     */
    public static function getObject()
    {
        return new CartBase(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return CartBase
     */
    public function testSerializationDeserialization()
    {
        $obj = new CartBase(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getReferenceId());
        $this->assertNotNull($obj->getAmount());
        $this->assertNotNull($obj->getPayee());
        $this->assertNotNull($obj->getDescription());
        $this->assertNotNull($obj->getNoteToPayee());
        $this->assertNotNull($obj->getCustom());
        $this->assertNotNull($obj->getInvoiceNumber());
        $this->assertNotNull($obj->getPurchaseOrder());
        $this->assertNotNull($obj->getSoftDescriptor());
        $this->assertNotNull($obj->getSoftDescriptorCity());
        $this->assertNotNull($obj->getPaymentOptions());
        $this->assertNotNull($obj->getItemList());
        $this->assertNotNull($obj->getNotifyUrl());
        $this->assertNotNull($obj->getOrderUrl());
        $this->assertNotNull($obj->getExternalFunding());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param CartBase $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getReferenceId(), "TestSample");
        $this->assertEquals($obj->getAmount(), AmountTest::getObject());
        $this->assertEquals($obj->getPayee(), PayeeTest::getObject());
        $this->assertEquals($obj->getDescription(), "TestSample");
        $this->assertEquals($obj->getNoteToPayee(), "TestSample");
        $this->assertEquals($obj->getCustom(), "TestSample");
        $this->assertEquals($obj->getInvoiceNumber(), "TestSample");
        $this->assertEquals($obj->getPurchaseOrder(), "TestSample");
        $this->assertEquals($obj->getSoftDescriptor(), "TestSample");
        $this->assertEquals($obj->getSoftDescriptorCity(), "TestSample");
        $this->assertEquals($obj->getPaymentOptions(), PaymentOptionsTest::getObject());
        $this->assertEquals($obj->getItemList(), ItemListTest::getObject());
        $this->assertEquals($obj->getNotifyUrl(), "http://www.google.com");
        $this->assertEquals($obj->getOrderUrl(), "http://www.google.com");
        $this->assertEquals($obj->getExternalFunding(), ExternalFundingTest::getObject());
    }

    public function testUrlValidationForNotifyUrl()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('NotifyUrl is not a fully qualified URL');

        $obj = new CartBase();
        $obj->setNotifyUrl(null);
    }

    public function testUrlValidationForOrderUrl()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('OrderUrl is not a fully qualified URL');

        $obj = new CartBase();
        $obj->setOrderUrl(null);
    }
}
