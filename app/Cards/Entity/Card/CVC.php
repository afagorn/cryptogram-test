<?php

declare(strict_types=1);

namespace App\Cards\Entity\Card;

use DomainException;

class CVC
{
    private string $cvc;

    public function __construct(string $cvc)
    {
        if(strlen($cvc) !== 3) {
            throw new DomainException('CVC must be only 3 symbols');
        }

        $this->cvc = $cvc;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->cvc;
    }
}
