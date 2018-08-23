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
        $response = $this->typeform->getForm('zOwLuu');
        $this->typeform->addHiddenFields($response, ["test", "test2"]);
        $this->assertTrue($response instanceof \WATR\Models\Form);
        $webhook = $this->typeform->registerWebhook($response, "http://85c8d4ca.ngrok.io");
        $this->assertTrue($webhook->enabled);

        \VCR\VCR::eject();
        \VCR\VCR::turnOff();
    }

    public function testGetResponses()
    {
        // $this->markTestSkipped('must be revisited.');
        \VCR\VCR::turnOn();
        \VCR\VCR::insertCassette('typeform_get_responses.yml');

        $this->initTypeform();
        $response = $this->typeform->getResponses('zOwLuu');

        $this->assertTrue(is_array($response));

        \VCR\VCR::eject();
        \VCR\VCR::turnOff();
    }

    public function testWebhook()
    {
        $data = json_decode(file_get_contents('./tests/webhook.json', FILE_USE_INCLUDE_PATH));
        $response = Typeform::parseWebhook($data);
        $answer = $response->form_response->getAnswerByRef('0d00cc8b-527b-4e46-8fe4-fb41d17f40fc');

        $this->assertTrue($answer != -1);

        $this->assertTrue($answer['answer']->answer === 2);
    }
}
