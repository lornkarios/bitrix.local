<?php

namespace NewsProject\Utils;

use Respect\Validation\Rules;
use Respect\Validation\Validator as v;


/**
 * Class ValidateService
 * @package NewsProject\Utils
 */
class ValidateForm
{
    private $email;
    private $phone;
    private $message;
    private $name;
    private $file;
    private $errors;

    public function __construct(string $email, string $phone, string $message, string $name, $file)
    {
        $this->email = trim($email);
        $this->phone = trim($phone);
        $this->message = trim($message);
        $this->name = trim($name);
        $this->file = $file;
    }

    private function validText(string $message): bool
    {
        $value = stripslashes($message);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        return $message == $value;
    }

    private function validName($name): bool
    {
        $usernameValidator = new Rules\AllOf(
            new Rules\Regex("/\A[А-Яа-яёЁA-Za-z]{3,15}\z/u"),
            new Rules\NoWhitespace(),
            new Rules\Length(1, 15)
        );

        $userValidator = new Rules\Key('name', $usernameValidator);

        return $userValidator->validate(['name' => $name]);
    }

    private function validFile($file): bool
    {
        $fileValidator1 = new Rules\AllOf(
            new Rules\File(),
            new Rules\Size(null, '5MB')
        );

        $fileValidator2 = new Rules\OneOf(
            new Rules\Mimetype('image/png'),
            new Rules\Mimetype('image/jpeg'),
            new Rules\Mimetype('image/gif'),
            new Rules\Mimetype('application/vnd.ms-excel'),
            new Rules\Mimetype('application/')
        );

        return $fileValidator1->validate(new \SplFileInfo($file['tmp_name'])) && $fileValidator2->validate($file['tmp_name']);
    }


    public function isValid(): bool
    {
        $this->errors = [];
        $valid = true;
        if (empty($this->email)) {
            $this->errors[] = [
                'field' => 'email',
                'text' => 'Поле email пустое!'
            ];
            $valid = false;
        } elseif (!v::email()->validate($this->email)) {
            $this->errors[] = [
                'field' => 'email',
                'text' => 'Поле email некорректно!'
            ];
            $valid = false;
        }

        if (empty($this->phone)) {
            $this->errors[] = [
                'field' => 'phone',
                'text' => 'Поле телефон пустое!'
            ];
            $valid = false;
        } elseif (!v::phone()->validate($this->phone)) {
            $this->errors[] = [
                'field' => 'phone',
                'text' => 'Поле телефон некорректно!'
            ];
            $valid = false;
        }

        if (empty($this->name)) {
            $this->errors[] = [
                'field' => 'name',
                'text' => 'Поле Имя пустое!'
            ];
            $valid = false;
        } elseif (!$this->validName($this->name)) {
            $this->errors[] = [
                'field' => 'name',
                'text' => 'Поле Имя некорректно!'
            ];
            $valid = false;
        }

        if (empty($this->message)) {
            $this->errors[] = [
                'field' => 'message',
                'text' => 'Поле сообщение пустое!'
            ];
            $valid = false;
        } elseif (!$this->validText($this->message)) {
            $this->errors[] = [
                'field' => 'message',
                'text' => 'Поле сообщение некорректно!'
            ];
            $valid = false;
        }

        if (empty($this->file)) {
            $this->errors[] = [
                'field' => 'file',
                'text' => 'Файл пуст!'
            ];
            $valid = false;
        } elseif (!$this->validFile($this->file)) {
            $this->errors[] = [
                'field' => 'file',
                'text' => 'Файл некорректен!'
            ];
            $valid = false;
        }
        return $valid;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getFile()
    {
        return $this->file;
    }

}
