<?php

namespace App\Service;

class Validator
{
    public function validInput($input, $name)
    {
        $errors = false;
        $input = addslashes($input);
        $input = htmlspecialchars($input);
        $input = preg_replace("/[^a-z0-9]/i", "", $input);

        if (!$input) {
            $errors = "Поле $name заполнено не корректно";
        }

        return $errors;
    }

    public function validEmail($email)
    {
        $errors = false;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors = "Не корректный Email $email !!!";
        }

        return $errors;
    }

    public function validUrl($homepage)
    {
        $errors = false;

        if ($homepage == '') {
            return $errors;
        }

        if (!filter_var($homepage, FILTER_VALIDATE_URL)) {
            $errors = "Не корректный url $homepage !!!";
        }

        return $errors;
    }

    public function validCaptcha($captcha)
    {
        $errors = false;

        if ($_POST['captcha'] !== $_SESSION['random'])	{
            $errors = "Не верно введена captcha $captcha !!!";
        }

        return $errors;
    }

    public function setErrors(array $errors)
    {
        foreach ($errors as $key => $error) {
            if (!$error) {
                unset($errors[$key]);
            }
        }

        return $errors;
    }

    public function agent($agent)
    {
        $browsers = [
            'Firefox',
            'Opera',
            'Chrome',
            'MSIE',
            'Safari'
        ];

        foreach ($browsers as $browser) {
            if (strpos($agent, $browser) !== false) {
                return $browser;
            }
        }

        return 'Неизвестный';
    }
}