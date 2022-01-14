<?php

declare(strict_types=1);

namespace App\Cards\Entity\Card;

class Card
{
    private PAN $pan;
    private CVC $cvc;
    private string $cardHolder;
    private ExpireDate $expire;

    public function __construct(
        PAN $pan,
        CVC $cvc,
        string $cardHolder,
        ExpireDate $expire
    ) {
        $this->pan = $pan;
        $this->cvc = $cvc;
        $this->cardHolder = $cardHolder;
        $this->expire = $expire;
    }

    /**
     * @return PAN
     */
    public function getPan(): PAN
    {
        return $this->pan;
    }

    /**
     * @return CVC
     */
    public function getCvc(): CVC
    {
        return $this->cvc;
    }

    /**
     * @return string
     */
    public function getCardHolder(): string
    {
        return $this->cardHolder;
    }

    /**
     * @return ExpireDate
     */
    public function getExpire(): ExpireDate
    {
        return $this->expire;
    }
}
