<?php

declare(strict_types=1);

namespace App\Cards\Service;

use App\Cards\Entity\Card\Card;
use App\Cards\Entity\Card\CVC;
use App\Cards\Entity\Card\ExpireDate;
use App\Cards\Entity\Card\PAN;
use App\Cards\Entity\Token;
use DateInterval;
use DateTimeImmutable;
use Exception;

class Tokenizer
{
    private const STRING_SEPARATOR = ';';

    private string $publicKey;
    private string $privateKey;
    private DateInterval $interval;

    public function __construct(string $publicKey, string $privateKey, DateInterval $interval)
    {
        $this->interval = $interval;
        $this->publicKey = $publicKey;
        $this->privateKey = $privateKey;
    }

    public function generate(Card $card, DateTimeImmutable $date): Token
    {
        $expire = $date->add($this->interval);
        $data = $this->formatString($card, $expire);

        openssl_public_encrypt($data, $encrypted, $this->publicKey);

        return new Token(base64_encode($encrypted), $card, $expire);
    }

    /**
     * @throws Exception
     */
    public function decrypt(string $value): Token
    {
        openssl_private_decrypt(base64_decode($value), $decrypted, $this->privateKey);

        $data = explode($decrypted, self::STRING_SEPARATOR);

        if(empty($data)) {
            throw new Exception('Cannot decrypt this token');
        }

        return new Token(
            $value,
            new Card(
                new PAN($data[0]),
                new CVC($data[1]),
                $data[2],
                ExpireDate::fromFormatString($data[3])
            ),
            DateTimeImmutable::createFromFormat('U', $data[4])
        );
    }

    private function formatString(Card $card, DateTimeImmutable $expire): string
    {
        return implode(self::STRING_SEPARATOR, [
            $card->getPan()->getValue(),
            $card->getCvc()->getValue(),
            $card->getCardHolder(),
            $card->getExpire()->getFormatString(),
            $expire->getTimestamp()
        ]);
    }
}
