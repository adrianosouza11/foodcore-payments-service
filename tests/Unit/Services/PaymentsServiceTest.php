<?php

namespace Unit\Services;

use App\Models\Payment;

use App\Repositories\PaymentRepository;
use App\Services\PaymentService;
use Tests\TestCase;

class PaymentsServiceTest extends TestCase
{
    public function test_must_initiate_payment()
    {
        //Arrange
        $paymentRepositoryMock = \Mockery::mock(PaymentRepository::class);

        $data = [
          'payment_reference' => '123456',
          'amount' => 77.90,
          'status' => 'pending',
          'order_id' => 1
        ];

        $paymentRepositoryMock->shouldReceive('create')
            ->with($data)
            ->andReturn(new Payment([
                'id' => 1,
                'payment_reference' => '123456',
                'amount' => 77.90,
                'status' => 'pending',
                'order_id' => 1
            ]));

        //Act
        $paymentService = new PaymentService($paymentRepositoryMock);
        $payment = $paymentService->create($data);

        //Assert
        $this->assertInstanceOf(Payment::class, $payment);
        $this->assertEquals('123456', $payment->payment_reference);
        $this->assertEquals(77.90, $payment->amount);
        $this->assertEquals('pending', $payment->status);
        $this->assertEquals(1, $payment->order_id);
    }
}
