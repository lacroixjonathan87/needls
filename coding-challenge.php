<?php
function calculateTimeInState() {
  
  //your code goes here.
  
}

//test case 1
$startDate = date("U", strtotime("next week"));
$stopDate = null;

$statusLog = array(
	array(
		'date' => date("U", strtotime("2015-10-15")),
		'oldState' => null,
		'newState' => 'PAUSED'
	)
);

$answer = 0;

//test case 2
$startDate = null;
$stopDate = null;
$statusLog = array(
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
);

$answer = time() - date("U", strtotime("2015-10-16"));

//test case 3
$startDate = null;
$stopDate = null;

$statusLog = array(
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
);

$answer = time() - date("U", strtotime("2015-10-18")) + (24 * 60 * 60);

//test case 4
$startDate = null;
$stopDate = null;

$statusLog = array(
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
);

$answer = time() - date("U", strtotime("2015-10-19")) + (24 * 60 * 60 * 1.5);

//test case 5
$startDate = null;
$stopDate = null;

$statusLog = array(
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
);

$answer = (24 * 60 * 60 * 2.5);

//test case 6
$startDate = date("U", strtotime("2015-10-15"));
$stopDate = null;

$statusLog = array(
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
);

$answer = time() - date("U", strtotime("2015-10-15"));

//test case 7
$startDate = date("U", strtotime("2015-10-15"));
$stopDate = null;
$statusLog = array(
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
);

$answer = time() - date("U", strtotime("2015-10-16"));

//test case 8
$startDate = date("U", strtotime("2015-10-17"));
$stopDate = null;
$statusLog = array(
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
);

$answer = (time() - date("U", strtotime("2015-10-19"))) + (12 * 60 * 60);


//test case 9
$startDate = null;
$stopDate = date("U", strtotime("2015-10-15"));
$statusLog = array(
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
);

$answer = 24 * 60 * 60;

//test case 10
$startDate = null;
$stopDate = date("U", strtotime("2015-10-18"));
$statusLog = array(
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
);

$answer = 24 * 60 * 60;

//test case 11
$startDate = null;
$stopDate = null;

$statusLog = array(
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
);

$answer = time() - date("U", strtotime("2015-10-16"));

//test case 12
$startDate = null;
$stopDate = null;

$statusLog = array(
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
);

$answer = 0;

?>