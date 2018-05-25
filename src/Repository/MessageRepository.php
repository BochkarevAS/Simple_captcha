<?php

namespace App\Repository;

use App\Core\Db;

class MessageRepository extends Db
{
    public function getCount()
    {
        $sql = "SELECT COUNT(*) AS cnt FROM `message`.`messages`";
        $result = $this->query($sql);

        return $result->fetch(\PDO::FETCH_COLUMN);
    }

    public function getMessage($begin, $sort, $type, $end)
    {
        $sql = "
            SELECT `t`.`id`, `t`.`username`, `t`.`email`, 
                   `t`.`homepage`, `t`.`captcha`, `t`.`text`,
                   `t`.ip, `t`.`browser`, `t`.`date` 
            FROM (
                SELECT `msg`.`id`, `msg`.`username`, `msg`.`email`, 
                       `msg`.`homepage`, `msg`.`captcha`, `msg`.`text`,
                       INET6_NTOA(`msg`.`ip`) AS ip, `msg`.`browser`, `msg`.`date`
                FROM `message`.`messages` AS msg
                ORDER BY `msg`.`id` DESC
                LIMIT $begin, $end
            ) t
            ORDER BY `t`.`$sort` $type";
        $result = $this->query($sql);

        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function addMessage($username, $email, $text, $homepage, $captcha, $ip, $browser)
    {
        $sql = "
            INSERT INTO `message`.`messages` (`username`, `email`, `homepage`, `captcha`, `text`, `ip`, `browser`)
            VALUES (:username, :email, :homepage, :captcha, :text, INET6_ATON(:ip), :browser)";
        $result = $this->query($sql, [
            'username'  => $username,
            'email'     => $email,
            'homepage'  => $homepage,
            'captcha'   => $captcha,
            'text'      => $text,
            'ip'        => $ip,
            'browser'   => $browser
        ]);

        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
}