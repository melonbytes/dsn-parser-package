<?php

namespace DSNParser;

class DSN {
    public $connection_string;
    const DSN_FORMAT = '/^([[:alnum:]]+):\/\/([[:alnum:]_-]+):([[:ascii:]]+)@([[:alnum:].-]+)\/([[:alnum:]_-]+)$/';

    function parse($connection_string) {
        $dsn = new stdClass;
        $dsn->dsn = $connection_string;
        if (preg_match(self::DSN_FORMAT,$connection_string,$matches)) {
            $dsn->protocol = $matches[1];
            $dsn->username = $matches[2];
            $dsn->password = $matches[3];
            $dsn->hostname = $matches[4];
            $dsn->database = $matches[5];
        } else {
            $dsn->protocol = null;
            $dsn->username = null;
            $dsn->password = null;
            $dsn->hostname = null;
            $dsn->database = null;
        }
        return $dsn;
    }
}
