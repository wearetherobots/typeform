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

    public function testInit()
    {
        $this->assertTrue(false);
    }

    /**
     * @vcr typeform_get_form
     */
    public function testGetForm()
    {
        \VCR\VCR::turnOn();
        \VCR\VCR::insertCassette('typeform_get_form.yml');

        $this->initTypeform();
        $response = $this->typeform->getForm('wJV1Iz');
        eval(\Psy\sh());
        $this->assertTrue(false);

        \VCR\VCR::eject();
        \VCR\VCR::turnOff();
    }
}
