<?php


namespace NewsProject\Utils;


interface CaptchaInterface
{
    public function getSid(): string;

    public function check(string $code, string $sid): bool;
}
