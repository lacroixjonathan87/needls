<?php

class StateUtils {


    const STATE_PAUSED = 'PAUSED';
    const STATE_RUNNING = 'RUNNING';
    const STATE_COMPLETE = 'COMPLETE';

    /**
     * @param SomeObject $object
     * @param string $state State to look after (Default: "RUNNING")
     * @param int $now Used by test
     *
     * @return int
     *
     * @throws InvalidArgumentException StopDate is smaller than startDate
     * @throws InvalidArgumentException Missing log record
     */
    public static function calculateTimeInState($object, $state=self::STATE_RUNNING, $now=null) {

        if(is_null($now)){
            $now = time();
        }

        $startDate = $object->getStartDate();
        if(is_null($startDate)){
            $startDate = PHP_INT_MIN; // So can work with logs from before 1970-01-01
        }

        $stopDate = $object->getStopDate();
        if(is_null($stopDate)){
            $stopDate = $now;
        }

        if($stopDate < $startDate){
            //throw new InvalidArgumentException('StopDate is smaller than startDate');
            return 0;
        }

        $timeInState = 0;
        $currentDate = null;
        $currentState = null;

        $sortedStatusLog = self::sortStatusLog($object->getStatusLog());
        foreach($sortedStatusLog as $log){
            $date = $log['date'];
            $oldState = $log['oldState'];
            $newState = $log['newState'];

            if($oldState != $currentState){
                throw new InvalidArgumentException('Missing log record');
            }

            if($currentState === $state){
                $timeInState += self::calculateTime($currentDate, $date, $startDate, $stopDate);
            }

            $currentDate = $date;
            $currentState = $newState;
        }

        if($currentState === $state){
            $timeInState += self::calculateTime($currentDate, $now, $startDate, $stopDate);
        }

        return $timeInState;

    }

    /**
     * Sort statusLog by date
     * @param array $statusLog
     * @return array
     */
    private static function sortStatusLog($statusLog) {

        usort($statusLog, function($a, $b){
            return $a['date'] - $b['date'];
        });

        return $statusLog;

    }

    /**
     * Calculate the time between $beginDate and $endDate, excluding time outside of $startDate and $stopDate
     *
     * @param int $beginDate
     * @param int $endDate
     * @param int $startDate
     * @param int $stopDate
     *
     * @return int
     */
    private static function calculateTime($beginDate, $endDate, $startDate, $stopDate) {

        $beginDate = max($beginDate, $startDate);
        $endDate = min($endDate, $stopDate);

        if($endDate <= $beginDate) {
            return 0;
        }

        return ($endDate - $beginDate);

    }

}
