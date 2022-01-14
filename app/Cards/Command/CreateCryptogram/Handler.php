<?php

declare(strict_types=1);

namespace App\Cards\Command\CreateCryptogram;

use App\Cards\Entity\Card\Card;
use App\Cards\Entity\Card\CVC;
use App\Cards\Entity\Card\ExpireDate;
use App\Cards\Entity\Card\PAN;
use App\Cards\Entity\Cryptogram;
use App\Cards\Service\Tokenizer;
use DateTimeImmutable;

class Handler
{
    public function __construct(
        private Tokenizer $tokenizer
    ) {
    }

    public function handle(Command $command)
    {
        $token = $this->tokenizer->generate(
            new Card(
                new PAN($command->pan),
                new CVC($command->cvc),
                $command->cardHolder,
                ExpireDate::fromFormatString($command->expire)
            ),
            new DateTimeImmutable()
        );

        return new Cryptogram($token);
    }
}
