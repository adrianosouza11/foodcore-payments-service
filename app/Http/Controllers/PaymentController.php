<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
}
