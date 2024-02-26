<?php

namespace JustinMueller\Flugplanung\Api;

use JustinMueller\Flugplanung\Database;
use JustinMueller\Flugplanung\Helper;

class Flugtag
{
    public function handle(): array|false
    {
        Helper::checkLogin();
        Database::connect();

        $sql = "SELECT
            m.pilot_id AS Pilot_ID,
            CONCAT(m.firstname, ' ', m.lastname) AS Pilot,
            m.windenfahrer AS ist_windenfahrer,
            m.verein AS VereinId,
            2 AS NGL,
            2 AS HRP,
            2 AS AMD,
            '' AS Kommentar,
            '' AS timestamp,
            d.windenfahrer as windenfahrer_official,
            d.startleiter as startleiter_official
        FROM dienste d
        INNER JOIN mitglieder m ON d.pilot_id = m.pilot_id
        WHERE d.flugtag = :flugtag AND (d.startleiter = '1' OR d.windenfahrer = '1')
        
        UNION
         
        SELECT
            m.pilot_id AS Pilot_ID,
            CONCAT(m.firstname, ' ', m.lastname) AS Pilot,
            m.windenfahrer AS ist_windenfahrer,
            m.verein AS VereinId,
            NGL,
            HRP,
            AMD,
            Kommentar,
            timestamp,
            '' as windenfahrer_official,
            '' as startleiter_official
        FROM tagesplanung t
        INNER JOIN mitglieder m ON t.pilot_id = m.pilot_id
        WHERE flugtag = :flugtag";


        $result = Database::query($sql, ['flugtag' => $_GET['flugtag']]);
        if ($result) {
            require 'clubs.php';
            $data = [];
            foreach ($result as $row) {
                $row['VereinId'] = (int)$row['VereinId'];
                $row['Verein'] = $clubs[$row['VereinId']];
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }
}
