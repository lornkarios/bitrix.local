<?php


namespace NewsProject\Utils;

use CCaptcha, COption;

class CaptchaService implements CaptchaInterface
{

    private $captcha;

    public function __construct()
    {
        $this->captcha = new CCaptcha();
    }

    public function getSid(): string
    {
        $this->captcha->SetCode();
        return $this->captcha->GetSID();
    }

    public function check(string $code, string $sid): bool
    {
        $captchaPass = COption::GetOptionString("main", "captcha_password", "");
        return (strlen($sid) > 0 && strlen($code) > 0) && ($this->captcha->CheckCodeCrypt($code, $sid, $captchaPass));
    }
}
