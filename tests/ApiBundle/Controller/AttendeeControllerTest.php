<?php

namespace Tests\ApiBundle\Controller;

class AttendeeControllerTest extends ApiTestCase
{
    /**
     * @test aaa
     */
    public function testIndex()
    {
        $nickname = 'Object Orienter'.random_int(0, 999);
        $data = [
            'name' => $nickname,
            'email' => $nickname.'@asd.pl',
        ];
        // 1) Create a programmer resource
        $response = $this->client->post('/api/v2/attendee', [
            'body' => json_encode($data)
        ]);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertTrue($response->hasHeader('Location'));
    }
}
