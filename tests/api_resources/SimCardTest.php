<?php

namespace Telnyx;

class SimCardTest extends TestCase
{
    const TEST_RESOURCE_ID = '6a09cdc3-8948-47f0-aa62-74ac943d6c58';

    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/v2/sim_cards'
        );
        $resources = SimCard::all();
        $this->assertInstanceOf(\Telnyx\Collection::class, $resources);
        $this->assertInstanceOf(\Telnyx\SimCard::class, $resources['data'][0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/v2/sim_cards/' . urlencode(self::TEST_RESOURCE_ID)
        );
        $resource = SimCard::retrieve(self::TEST_RESOURCE_ID);
        $this->assertInstanceOf(\Telnyx\SimCard::class, $resource);
    }

    public function testIsUpdatable()
    {
        $this->expectsRequest(
            'patch',
            '/v2/sim_cards/' . urlencode(self::TEST_RESOURCE_ID)
        );
        $resource = SimCard::update(self::TEST_RESOURCE_ID, [
            "name" => "Test",
        ]);
        $this->assertInstanceOf(\Telnyx\SimCard::class, $resource);
    }

    /*
    Temporarily commented out.
    public function testRequestActivation()
    {
        $simcard = SimCard::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/v2/sim_cards/' . urlencode(self::TEST_RESOURCE_ID) . '/actions/activate'
        );
        $resources = $simcard->activate();
        $this->assertInstanceOf(\Telnyx\SimCard::class, $resources);
    }

    public function testRequestDeactivation()
    {
        $simcard = SimCard::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'post',
            '/v2/sim_cards/' . urlencode(self::TEST_RESOURCE_ID) . '/actions/deactivate'
        );
        $resources = $simcard->deactivate();
        $this->assertInstanceOf(\Telnyx\SimCard::class, $resources);
    }
    */

    public function testRegister()
    {
        $this->expectsRequest(
            'post',
            '/v2/actions/register/sim_cards'
        );
        $resources = SimCard::register(["registration_codes" => ["1234567890, 123456332601"]]);
        $this->assertInstanceOf(\Telnyx\Collection::class, $resources);
        $this->assertInstanceOf(\Telnyx\SimCard::class, $resources['data'][0]);
    }
}
