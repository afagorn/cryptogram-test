<?php

declare(strict_types=1);

namespace App\Cards\Entity;

class Cryptogram
{
    public function __construct(
        private Token $token
    ) {
    }

    public function toFormatArray(): array
    {
        return [
            'pan' => $this->token->getCard()->getPan()->toSecretString(),
            'token' => $this->token->getValue()
        ];
    }

    /**
     * @return Token
     */
    public function getToken(): Token
    {
        return $this->token;
    }
}
