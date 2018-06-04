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

    public function testGetForm()
    {
        $this->initTypeform();
        $response = $this->typeform->getForm('wJV1Iz');
        eval(\Psy\sh());
        $this->assertTrue(false);
    }
}
