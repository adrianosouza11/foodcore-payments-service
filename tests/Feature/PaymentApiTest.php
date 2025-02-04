<?php

namespace Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PaymentApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_must_initiate_payment_via_api()
    {
        //Arrange
        $data = [
            'payment_reference' => '123456',
            'amount' => 77.90,
            'status' => 'pending',
            'order_id' => 1
        ];

        $expectedOrderStructure = function(AssertableJson $json) {
            $json->has('status');
            $json->has('message');
            $json->has('data', function (AssertableJson $json) {
                $json->has('id');
                $json->has('payment_reference');
                $json->has('amount');
                $json->has('status');
                $json->has('order_id');
                $json->has('created_at');
                $json->has('updated_at');
            });
        };

        //Act
        $response = $this->post('/api/payments', $data);

        //Assert
        $response->assertStatus(201)
            ->assertJson($expectedOrderStructure);
    }
}
