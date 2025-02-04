<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use App\Repositories\PaymentRepository;
use App\Http\Requests\StorePaymentRequest;
use \Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    private PaymentService $service;

    public function __construct()
    {
        $this->service = new PaymentService(new PaymentRepository());
    }

    /**
     * @param StorePaymentRequest $request
     * @return JsonResponse
     */
    public function store(StorePaymentRequest $request): JsonResponse
    {
        $payment = $this->service->create($request->validated());

        return response()->json([
            'status' => 201,
            'message' => 'create an payment',
            'data' => [ ...$payment->getAttributes() ]
        ], 201);
    }

    /**
     * @param int $order_id
     * @return JsonResponse
     */
    public function statusByOrderId(int $order_id): JsonResponse
    {
        $paymentStatus = $this->service->statusByOrderId($order_id);

        return response()->json([
            'status' => 200,
            'message' => 'Payment status by order id',
            'data' => $paymentStatus
        ]);
    }
}
