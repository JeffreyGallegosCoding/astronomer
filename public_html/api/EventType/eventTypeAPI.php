<?php

require_once dirname(__DIR__, 3) . "../vendor/autoload.php";
require_once dirname(__DIR__, 3) . "../php/classes/autoload.php";
require_once dirname(__DIR__, 3) . "../php/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "../php/lib/uuid.php";
require_once dirname(__DIR__, 3) . "../php/lib/jwt.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use BackyardAstronomer\Astronomer\ {
	EventType
};


/**
* api for eventType
*
* @author Dayn Augustson
* @version 1.0
*/
//verify the session, if it is not active start it
if(session_status() !== PHP_SESSION_ACTIVE) {
session_start();
}
//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;
try {
//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/cohort22/astronomers.ini");

//determine which HTTP method was used
	$method = $_SERVER["HTTP_X_HTTP_METHOD"] ?? $_SERVER["REQUEST_METHOD"];

// sanitize input
	$evenTypeId = filter_input(INPUT_GET, "evenTypeId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$eventTypeName = filter_input(INPUT_GET, "eventTypeName ", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);


	// make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($evenTypeId) === true)) {
		throw(new InvalidArgumentException("EventTypeID cannot be empty or negative", 405));
	}

// handle GET request - if evenTypeId is present, that EventType is returned, otherwise all EventType are returned
	if($method === "GET") {

		//set XSRF cookie
		setXsrfCookie();
		//get a specific Event type or all Event type and update reply
		if(empty($evenTypeId) === false) {
			$reply->data = EventType::getEventTypeByEventTypeId($pdo, $evenTypeId);
		}
	}



}