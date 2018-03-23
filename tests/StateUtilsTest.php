<?php
require __DIR__ . '/../StateUtils.class.php';
require __DIR__ . '/../SomeObject.class.php';

use PHPUnit\Framework\TestCase;

class StateUtilsTest extends TestCase
{

    /**
     * @dataProvider calculateTimeInStateTestProvider
     *
     * @param $statusLog
     * @param $startDate
     * @param $stopDate
     * @param $state
     * @param $now
     * @param $expected
     */
    public function testCalculateTimeInState($statusLog, $startDate, $stopDate, $state, $now, $expected) {

        $object = new SomeObject($statusLog, $startDate, $stopDate);
        $actual = StateUtils::calculateTimeInState($object, $state, $now);
        $this->assertEquals($expected, $actual);

    }

    /**
     * DataProvider for testCalculateTimeInState
     *
     * @return array
     */
    public function calculateTimeInStateTestProvider() {

        $now = time();

        return array(
            'TEST CASE 1' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-15")),
                        'oldState' => null,
                        'newState' => 'PAUSED'
                    ),
                ),
                date("U", strtotime("next week")),
                null,
                StateUtils::STATE_RUNNING,
                $now,
                0,
            ),

            'TEST CASE 2' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-15")),
                        'oldState' => null,
                        'newState' => 'PAUSED'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-16")),
                        'oldState' => 'PAUSED',
                        'newState' => 'RUNNING'
                    )
                ),
                null,
                null,
                StateUtils::STATE_RUNNING,
                $now,
                $now - date("U", strtotime("2015-10-16")),
            ),

            'TEST CASE 3' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-15")),
                        'oldState' => null,
                        'newState' => 'PAUSED'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-16")),
                        'oldState' => 'PAUSED',
                        'newState' => 'RUNNING'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-17")),
                        'oldState' => 'RUNNING',
                        'newState' => 'PAUSED'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-18")),
                        'oldState' => 'PAUSED',
                        'newState' => 'RUNNING'
                    ),
                ),
                null,
                null,
                StateUtils::STATE_RUNNING,
                $now,
                $now - date("U", strtotime("2015-10-18")) + (24 * 60 * 60),
            ),

            'TEST CASE 4' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-15")),
                        'oldState' => null,
                        'newState' => 'PAUSED'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-16")),
                        'oldState' => 'PAUSED',
                        'newState' => 'RUNNING'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-17")),
                        'oldState' => 'RUNNING',
                        'newState' => 'PAUSED'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-18")),
                        'oldState' => 'PAUSED',
                        'newState' => 'RUNNING'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-18 12:00:00")),
                        'oldState' => 'RUNNING',
                        'newState' => 'PAUSED'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-19")),
                        'oldState' => 'PAUSED',
                        'newState' => 'RUNNING'
                    ),
                ),
                null,
                null,
                StateUtils::STATE_RUNNING,
                $now,
                $now - date("U", strtotime("2015-10-19")) + (24 * 60 * 90),
            ),

            'TEST CASE 5' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-15")),
                        'oldState' => null,
                        'newState' => 'PAUSED'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-16")),
                        'oldState' => 'PAUSED',
                        'newState' => 'RUNNING'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-17")),
                        'oldState' => 'RUNNING',
                        'newState' => 'PAUSED'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-18")),
                        'oldState' => 'PAUSED',
                        'newState' => 'RUNNING'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-18 12:00:00")),
                        'oldState' => 'RUNNING',
                        'newState' => 'PAUSED'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-19")),
                        'oldState' => 'PAUSED',
                        'newState' => 'RUNNING'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-20")),
                        'oldState' => 'RUNNING',
                        'newState' => 'COMPLETE'
                    )
                ),
                null,
                null,
                StateUtils::STATE_RUNNING,
                $now,
                (24 * 60 * 150),
            ),

            'TEST CASE 6' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-13")),
                        'oldState' => null,
                        'newState' => 'PAUSED'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-14")),
                        'oldState' => 'PAUSED',
                        'newState' => 'RUNNING'
                    )
                ),
                date("U", strtotime("2015-10-15")),
                null,
                StateUtils::STATE_RUNNING,
                $now,
                $now - date("U", strtotime("2015-10-15")),
            ),

            'TEST CASE 7' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-13")),
                        'oldState' => null,
                        'newState' => 'PAUSED'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-16")),
                        'oldState' => 'PAUSED',
                        'newState' => 'RUNNING'
                    )
                ),
                date("U", strtotime("2015-10-15")),
                null,
                StateUtils::STATE_RUNNING,
                $now,
                $now - date("U", strtotime("2015-10-16")),
            ),

            'TEST CASE 8' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-15")),
                        'oldState' => null,
                        'newState' => 'PAUSED'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-16")),
                        'oldState' => 'PAUSED',
                        'newState' => 'RUNNING'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-17")),
                        'oldState' => 'RUNNING',
                        'newState' => 'PAUSED'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-18")),
                        'oldState' => 'PAUSED',
                        'newState' => 'RUNNING'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-18 12:00:00")),
                        'oldState' => 'RUNNING',
                        'newState' => 'PAUSED'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-19")),
                        'oldState' => 'PAUSED',
                        'newState' => 'RUNNING'
                    ),
                ),
                date("U", strtotime("2015-10-17")),
                null,
                StateUtils::STATE_RUNNING,
                $now,
                ($now - date("U", strtotime("2015-10-19"))) + (12 * 60 * 60),
            ),


            'TEST CASE 9' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-13")),
                        'oldState' => null,
                        'newState' => 'PAUSED'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-14")),
                        'oldState' => 'PAUSED',
                        'newState' => 'RUNNING'
                    )
                ),
                null,
                date("U", strtotime("2015-10-15")),
                StateUtils::STATE_RUNNING,
                $now,
                (24 * 60 * 60),
            ),

            'TEST CASE 10' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-13")),
                        'oldState' => null,
                        'newState' => 'PAUSED'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-14")),
                        'oldState' => 'PAUSED',
                        'newState' => 'RUNNING'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-15")),
                        'oldState' => 'RUNNING',
                        'newState' => 'COMPLETE'
                    )
                ),
                null,
                date("U", strtotime("2015-10-18")),
                StateUtils::STATE_RUNNING,
                $now,
                (24 * 60 * 60),
            ),

            'TEST CASE 11' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-15")),
                        'oldState' => null,
                        'newState' => 'PAUSED'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-16")),
                        'oldState' => 'PAUSED',
                        'newState' => 'RUNNING'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-17")),
                        'oldState' => 'RUNNING',
                        'newState' => 'RUNNING'
                    )
                ),
                null,
                null,
                StateUtils::STATE_RUNNING,
                $now,
                $now - date("U", strtotime("2015-10-16")),
            ),

            'TEST CASE 12' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-15")),
                        'oldState' => null,
                        'newState' => 'PAUSED'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-15")) + 1800,
                        'oldState' => 'PAUSED',
                        'newState' => 'PAUSED'
                    )
                ),
                null,
                null,
                StateUtils::STATE_RUNNING,
                $now,
                0,
            ),

            'empty' => array(
                array(),
                null,
                null,
                StateUtils::STATE_RUNNING,
                $now,
                0,
            ),

            'log not sorted' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-17")),
                        'oldState' => 'RUNNING',
                        'newState' => 'COMPLETE'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-15")),
                        'oldState' => null,
                        'newState' => 'PAUSED'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-16")),
                        'oldState' => 'PAUSED',
                        'newState' => 'RUNNING'
                    ),
                ),
                null,
                null,
                StateUtils::STATE_RUNNING,
                $now,
                date("U", strtotime("2015-10-17")) - date("U", strtotime("2015-10-16")),
            ),

            'before' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-13")),
                        'oldState' => null,
                        'newState' => 'RUNNING'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-14")),
                        'oldState' => 'RUNNING',
                        'newState' => 'PAUSED'
                    )
                ),
                date("U", strtotime("2015-10-15")),
                date("U", strtotime("2015-10-16")),
                StateUtils::STATE_RUNNING,
                $now,
                0,
            ),

            'before with start and end date in the future' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-13")),
                        'oldState' => null,
                        'newState' => 'RUNNING'
                    ),
                ),
                date("U", strtotime("2200-10-15")),
                date("U", strtotime("2200-10-16")),
                StateUtils::STATE_RUNNING,
                $now,
                0,
            ),

            'during' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-14")),
                        'oldState' => null,
                        'newState' => 'RUNNING'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-15")),
                        'oldState' => 'RUNNING',
                        'newState' => 'PAUSED'
                    )
                ),
                date("U", strtotime("2015-10-13")),
                date("U", strtotime("2015-10-16")),
                StateUtils::STATE_RUNNING,
                $now,
                (24 * 60 * 60),
            ),

            'after' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-17")),
                        'oldState' => null,
                        'newState' => 'RUNNING'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-18")),
                        'oldState' => 'RUNNING',
                        'newState' => 'PAUSED'
                    )
                ),
                date("U", strtotime("2015-10-15")),
                date("U", strtotime("2015-10-16")),
                StateUtils::STATE_RUNNING,
                $now,
                0,
            ),

            'starting' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-12")),
                        'oldState' => null,
                        'newState' => 'RUNNING'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-15")),
                        'oldState' => 'RUNNING',
                        'newState' => 'PAUSED'
                    )
                ),
                date("U", strtotime("2015-10-14")),
                date("U", strtotime("2015-10-16")),
                StateUtils::STATE_RUNNING,
                $now,
                (24 * 60 * 60),
            ),

            'ending' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-12")),
                        'oldState' => null,
                        'newState' => 'RUNNING'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-15")),
                        'oldState' => 'RUNNING',
                        'newState' => 'PAUSED'
                    )
                ),
                date("U", strtotime("2015-10-11")),
                date("U", strtotime("2015-10-13")),
                StateUtils::STATE_RUNNING,
                $now,
                (24 * 60 * 60),
            ),

            'more' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-12")),
                        'oldState' => null,
                        'newState' => 'RUNNING'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-15")),
                        'oldState' => 'RUNNING',
                        'newState' => 'PAUSED'
                    )
                ),
                date("U", strtotime("2015-10-13")),
                date("U", strtotime("2015-10-14")),
                StateUtils::STATE_RUNNING,
                $now,
                (24 * 60 * 60),
            ),

            'exactly' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-13")),
                        'oldState' => null,
                        'newState' => 'RUNNING'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-15")),
                        'oldState' => 'RUNNING',
                        'newState' => 'PAUSED'
                    )
                ),
                date("U", strtotime("2015-10-13")),
                date("U", strtotime("2015-10-15")),
                StateUtils::STATE_RUNNING,
                $now,
                (2 * 24 * 60 * 60),
            ),

            'state RUNNING' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-14")),
                        'oldState' => null,
                        'newState' => 'RUNNING'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-15")),
                        'oldState' => 'RUNNING',
                        'newState' => 'COMPLETE'
                    )
                ),
                date("U", strtotime("2015-10-13")),
                date("U", strtotime("2015-10-16")),
                StateUtils::STATE_RUNNING,
                $now,
                (24 * 60 * 60),
            ),

            'state PAUSED' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-14")),
                        'oldState' => null,
                        'newState' => 'PAUSED'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-15")),
                        'oldState' => 'PAUSED',
                        'newState' => 'RUNNING'
                    )
                ),
                date("U", strtotime("2015-10-13")),
                date("U", strtotime("2015-10-16")),
                StateUtils::STATE_PAUSED,
                $now,
                (24 * 60 * 60),
            ),

            'state COMPLETE' => array(
                array(
                    array(
                        'date' => date("U", strtotime("2015-10-14")),
                        'oldState' => null,
                        'newState' => 'COMPLETE'
                    ),
                    array(
                        'date' => date("U", strtotime("2015-10-15")),
                        'oldState' => 'COMPLETE',
                        'newState' => 'RUNNING'
                    )
                ),
                date("U", strtotime("2015-10-13")),
                date("U", strtotime("2015-10-16")),
                StateUtils::STATE_COMPLETE,
                $now,
                (24 * 60 * 60),
            ),

            'before and after 1970-01-01' => array(
                array(
                    array(
                        'date' => date("U", strtotime("1969-12-31")),
                        'oldState' => null,
                        'newState' => 'RUNNING'
                    ),
                    array(
                        'date' => date("U", strtotime("1970-01-02")),
                        'oldState' => 'RUNNING',
                        'newState' => 'COMPLETE'
                    )
                ),
                null,
                null,
                StateUtils::STATE_RUNNING,
                $now,
                (2 * 24 * 60 * 60),
            ),

            'before 1970' => array(
                array(
                    array(
                        'date' => date("U", strtotime("1900-01-01")),
                        'oldState' => null,
                        'newState' => 'RUNNING'
                    ),
                    array(
                        'date' => date("U", strtotime("1900-01-02")),
                        'oldState' => 'RUNNING',
                        'newState' => 'COMPLETE'
                    )
                ),
                null,
                null,
                StateUtils::STATE_RUNNING,
                $now,
                (24 * 60 * 60),
            ),

        );
    }

    public function testMissingLog() {

        $statusLog = array(
            array(
                'date' => date("U", strtotime("2015-10-15")),
                'oldState' => null,
                'newState' => 'PAUSED'
            ),
            array(
                'date' => date("U", strtotime("2015-10-16")),
                'oldState' => 'RUNNING',
                'newState' => 'COMPLETE'
            ),
        );
        $object = new SomeObject($statusLog);

        $this->expectException(InvalidArgumentException::class);
        StateUtils::calculateTimeInState($object, StateUtils::STATE_RUNNING);

    }

}
