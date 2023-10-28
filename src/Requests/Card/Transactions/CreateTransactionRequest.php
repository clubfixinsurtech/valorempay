<?php

namespace ValoremPay\Requests\Card\Transactions;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateTransactionRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected int    $installments,
        protected int    $installmentType,
        protected int    $amount,
        protected string $softDescriptor,
        protected string $statusNotificationUrl,
        protected bool   $useDecisionManager = false,
        protected bool   $postponeConfirmation = false,
    )
    {
        //
    }

    public function resolveEndpoint(): string
    {
        return '/gse-tef-v2/transactions';
    }

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    protected function defaultBody(): array
    {
        return [
            'installments' => $this->installments,
            'installment_type' => $this->installmentType,
            'amount' => $this->amount,
            'soft_descriptor' => $this->softDescriptor,
            'additional_data' => [
                'status_notification_url' => $this->statusNotificationUrl,
                'use_decision_manager' => $this->useDecisionManager,
                'postpone_confirmation' => $this->postponeConfirmation,
            ],
        ];
    }
}