<?php

declare(strict_types=1);

namespace App\Cards\Entity\Card;

use DateTimeImmutable;

class ExpireDate
{

    private DateTimeImmutable $date;

    public function __construct(DateTimeImmutable $date)
    {
        $this->date = $date;
    }

    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    public static function fromFormatString(string $string): self
    {
        return new self(DateTimeImmutable::createFromFormat('d/y', $string));
    }

    public function getFormatString(): string
    {
        return $this->date->format('d/y');
    }
}
