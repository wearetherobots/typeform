<?php

use PHPUnit\Framework\TestCase;
use WATR\Typeform;

class TypeformTest extends TestCase
{
    protected $typeform;

    public function initTypeform()
    {
        // TODO: fix env loading
        $this->typeform = new Typeform(getenv('TYPEFORM_API_KEY'));
    }

    public function testGetForm()
    {
        \VCR\VCR::turnOn();
        \VCR\VCR::insertCassette('typeform_get_form.yml');

        $this->initTypeform();
        $response = $this->typeform->getForm('wJV1Iz');
        $this->assertTrue($response instanceof \WATR\Models\Form);

        \VCR\VCR::eject();
        \VCR\VCR::turnOff();
    }

    public function testGetResponses()
    {
        \VCR\VCR::turnOn();
        \VCR\VCR::insertCassette('typeform_get_responses.yml');

        $this->initTypeform();
        $response = $this->typeform->getResponses('wJV1Iz');
        $this->assertTrue($response instanceof \WATR\Models\Form);

        \VCR\VCR::eject();
        \VCR\VCR::turnOff();
    }
}
