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

    public function test_payment_status_must_be_returned()
    {
        //Arrange
        $paymentRepositoryMock = \Mockery::mock(PaymentRepository::class);

        $orderId = 1;
        $updateAt = now();

        $paymentRepositoryMock
            ->shouldReceive('statusByOrderId')
            ->with($orderId)
            ->andReturn([
                'order_id' => $orderId,
                'payment_reference' => '123456',
                'amount' => 77.90,
                'status' => 'pending',
                'updated_at' => $updateAt
            ]);

        //Act
        $paymentService = new PaymentService($paymentRepositoryMock);
        $paymentStatus = $paymentService->statusByOrderId($orderId);

        //Assert
        $this->assertIsArray($paymentStatus, 'Assert variable is array or not');
        $this->assertEquals(1, $paymentStatus['order_id']);
        $this->assertEquals('123456', $paymentStatus['payment_reference']);
        $this->assertEquals('pending', $paymentStatus['status']);
        $this->assertEquals(77.90, $paymentStatus['amount']);
        $this->assertEquals($updateAt, $paymentStatus['updated_at']);
    }
}
