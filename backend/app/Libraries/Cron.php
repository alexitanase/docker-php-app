<?php

namespace App\Libraries;

use DateTime;
use DatePeriod;
use DateInterval;
use Exception;
use Predis\Client;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Exception\PropelException;
use PropelService\AdminSession;
use PropelService\AdminSessionQuery;
use PropelService\Event;
use PropelService\EventQuery;
use PropelService\Map\AdminSessionTableMap;
use App\Libraries\DatetimeUtils;

class Cron {

    public function minute() {
        //$this->closeExpiredSessions();
    }

    /**
     * @throws Exception
     */
    public function hour() {
    }

    /**
     * @param string $start_date
     * @param string|null $end_date
     * @throws Exception
     */
    public function day(string $start_date = "yesterday", string $end_date = "yesterday") {
    }

    public function closeExpiredSessions() {

        $sessions = AdminSessionQuery::create()->filterByStatus(AdminSessionTableMap::COL_STATUS_VALID)->filterByExpireDate("now", Criteria::LESS_THAN)->getIterator();

        /**
         * @var AdminSession $session
         */
        foreach ($sessions as $session) {
            $session->setStatus(AdminSessionTableMap::COL_STATUS_INVALID);
            $session->save();
        }

    }

    protected function print_msg($msg){
        echo $msg."\n";
    }
}