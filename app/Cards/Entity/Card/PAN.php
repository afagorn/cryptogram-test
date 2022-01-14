<?php

declare(strict_types=1);

namespace App\Cards\Entity\Card;

use DomainException;

class PAN
{
    private const SECRET_LENGTH = 4;

    private string $pan;

    public function __construct(string $pan)
    {
        if(strlen($pan) !== 16) {
            throw new DomainException('CVC must be only 3 symbols');
        }

        $this->pan = $pan;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->pan;
    }

    public function toSecretString(): string
    {
        $first = substr($this->pan, 0, self::SECRET_LENGTH);
        $end = substr($this->pan, -self::SECRET_LENGTH);

        return $first . '**' . $end;
    }
}
