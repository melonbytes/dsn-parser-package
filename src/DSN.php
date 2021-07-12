<?php

namespace MelonBytes\DSNParser;

class DSN {
    public $connection_string;
    const DSN_FORMAT = '/^([[:alnum:]]+):\/\/([[:alnum:]_-]+):([[:ascii:]]+)@([[:alnum:].-]+):*([0-9]*)\/([[:alnum:]_-]+)$/';

    function parse($connection_string) {
        $dsn = new \stdClass;
        $dsn->dsn = $connection_string;
        if (preg_match(self::DSN_FORMAT,$connection_string,$matches)) {
            $dsn->protocol = $matches[1];
            $dsn->username = $matches[2];
            $dsn->password = $matches[3];
            $dsn->hostname = $matches[4];
            $dsn->port     = $matches[5];
            $dsn->database = $matches[6];
        } else {
            $dsn->protocol = null;
            $dsn->username = null;
            $dsn->password = null;
            $dsn->hostname = null;
            $dsn->port     = null;
            $dsn->database = null;
        }
        if (!is_numeric($dsn->port)) {
            switch ($dsn-protocol) {
                case "mariadb":
                    $dsn->port = 3306;
                    break;
                case "mysql";
                    $dsn->port = 3306;
                    break;
                case "sqlserver";
                    $dsn->port = 1433;
                    break;
                case "pgsql";
                    $dsn->port = 5432;
                    break;
                default:
                    $dsn->port = 3306;
            }
        }
        return $dsn;
    }
}
