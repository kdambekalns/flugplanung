<?php

namespace JustinMueller\Flugplanung\Api;

use JustinMueller\Flugplanung\Database;
use JustinMueller\Flugplanung\Helper;

class Betrieb
{
    public function handle(): array|false
    {
        Helper::checkLogin();
        Database::connect();

        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $query = "SELECT * FROM moegliche_flugtage WHERE datum = :flugtag";
            $result = Database::query($query, ['flugtag' => $_GET['flugtag']]);
            return current($result);
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $sql = 'UPDATE moegliche_flugtage SET betrieb_ngl = :betrieb_ngl, betrieb_hrp = :betrieb_hrp, betrieb_amd = :betrieb_amd, aufbau = :aufbau WHERE  datum = :flugtag';
            return Database::insertSqlStatement($sql, [
                    'flugtag' => $_POST['flugtag'],
                    'betrieb_ngl' => $_POST['flugbetrieb_ngl'],
                    'betrieb_hrp' => $_POST['flugbetrieb_hrp'],
                    'betrieb_amd' => $_POST['flugbetrieb_amd'],
                    'aufbau' => $_POST['aufbau']
                ]
            );
        }
    }
}
