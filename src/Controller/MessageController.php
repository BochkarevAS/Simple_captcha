<?php

namespace App\Controller;

use App\Core\Controller;
use App\Repository\MessageRepository;
use App\Service\Pagination;
use App\Service\Validator;

class MessageController extends Controller
{
    const COUNT_PAGE = 25;

    public function index()
    {
        return $this->showMessage();
    }

    public function showMessage($current = 1, $sort = 'desc_id')
    {
        // Здесь я достаю нужные компоненты из контенера подобное используется в Симфони
        $message = $this->container->make(MessageRepository::class);
        $pagination = $this->container->make(Pagination::class);

        $pattern = $pagination->sort($sort);
        $page = ($current - 1) * self::COUNT_PAGE;
        $total = ceil($message->getCount() / self::COUNT_PAGE);
        $message = $message->getMessage($page, $pattern['url'], $pattern['type'], self::COUNT_PAGE);
        $pages = $pagination->page($total, $current, self::COUNT_PAGE);

        return $this->render('user/message', [
            'messages' => $message,
            'pages'    => $pages,
            'current'  => $current,
            'pattern'  => $pattern
        ]);
    }

    public function addMessage()
    {
        $username = $_POST['username'];
        $text = $_POST['message'];
        $captcha = $_POST['captcha'];
        $email = $_POST['email'];
        $homepage = $_POST['homepage'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $agent = $_SERVER["HTTP_USER_AGENT"];

        $validator = $this->container->make(Validator::class);
        $browser = $validator->agent($agent);
        $errors['username'] = $validator->validInput($username, 'username');
        $errors['message'] = $validator->validInput($text, 'message');
        $errors['email'] = $validator->validEmail($email);
        $errors['homepage'] = $validator->validUrl($homepage);
        $errors['captcha'] = $validator->validCaptcha($captcha);
        $_SESSION['errors'] = $validator->setErrors($errors);

        if ($_SESSION['errors']) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $message = $this->container->make(MessageRepository::class);
        $message->addMessage($username, $email, $text, $homepage, $captcha, $ip, $browser);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die();
    }
}