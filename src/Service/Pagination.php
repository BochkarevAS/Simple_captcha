<?php

namespace App\Service;

class Pagination
{
    public function page($total, $current, $range)
    {
        $delta = floor($range / 2);
        $begin = $current - $delta;

        if ($begin < 1) {
            $begin = 1;
        }

        $end = $begin + $range - 1;

        if ($end > $total) {
            $end = $total;
            $begin = $end - ($range - 1);
            if ($begin < 1) {
                $begin = 1;
            }
        }

        $pages = [];
        for ($i = $begin; $i <= $end; $i++) {
            $pages[] = $i;
        }

        return $pages;
    }

    public function sort($sort)
    {
        $pattern = [
            'username' => 'desc_username',
            'email'    => 'desc_email',
            'date'     => 'desc_date'
        ];

        $exp = explode('_', $sort);
        $pattern['type'] = (strtoupper($exp[0]) === 'DESC') ? 'ASC' : 'DESC';
        $pattern['url'] = $exp[1];
        $pattern[$exp[1]] = mb_strtolower($pattern['type'] . '_' . $exp[1]);

        return $pattern;
    }
}