<?php

namespace Omnipay\TargetPay\Message;

class IdealPurchaseRequest extends PurchaseRequest
{
    public function getIssuer()
    {
        return $this->getParameter('issuer');
    }

    public function setIssuer($value)
    {
        return $this->setParameter('issuer', $value);
    }
    
    public function setSepa($value)
    {
            return $this->setParameter('cinfo_in_callback', $value);
    }

    public function getSepa()
    {
            return $this->getParameter('cinfo_in_callback');
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $this->validate('issuer', 'amount', 'description', 'returnUrl');

        return array(
            'rtlo' => $this->getSubAccountId(),
            'bank' => $this->getIssuer(),
            'amount' => $this->getAmountInteger(),
            'description' => $this->getDescription(),
            'language' => $this->getLanguage(),
            'currency' => $this->getCurrency(),
            'returnurl' => $this->getReturnUrl(),
            'reporturl' => $this->getNotifyUrl(),
            'cinfo_in_callback' =>$this->getSepa(),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getEndpoint()
    {
        return 'https://www.targetpay.com/ideal/start';
    }
}
