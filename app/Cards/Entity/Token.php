<?php

declare(strict_types=1);

namespace App\Cards\Entity;

use App\Cards\Entity\Card\Card;
use DateTimeImmutable;

class Token
{
    private DateTimeImmutable $expire;
    private Card $card;
    private string $value;

    public function __construct(string $value, Card $card, DateTimeImmutable $expire)
    {
        $this->expire = $expire;
        $this->value = $value;
        $this->card = $card;
    }

    /**
     * @return Card
     */
    public function getCard(): Card
    {
        return $this->card;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getExpire(): DateTimeImmutable
    {
        return $this->expire;
    }
}
