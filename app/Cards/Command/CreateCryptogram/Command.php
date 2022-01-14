<?php

declare(strict_types=1);

namespace App\Cards\Command\CreateCryptogram;

class Command
{
    public string $cvc = '';
    public string $pan = '';
    public string $cardHolder = '';
    public string $expire = '';
}
