<?php

namespace JustinMueller\Flugplanung\Api;

use JustinMueller\Flugplanung\Database;
use JustinMueller\Flugplanung\Helper;

class Flugtage
{
    public function handle(): array|false
    {
        Helper::checkLogin();
        Database::connect();

        $startDate = $_GET['startDate'];
        $endDate = $_GET['endDate'];

        $query = 'SELECT datum FROM moegliche_flugtage WHERE datum BETWEEN :startDate AND :endDate ORDER BY datum DESC';

        return Database::query($query, ['startDate' => $startDate, 'endDate' => $endDate]);
    }
}
