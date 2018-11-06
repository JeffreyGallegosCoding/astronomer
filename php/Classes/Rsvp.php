<?php
namespace BackyardAstronomer\Astronomer;

require_once("Autoload.php");
require_once(dirname(__DIR__,2) . "/classes/Autoload.php");


use Ramsey\Uuid\Uuid;

class Rsvp implements \JsonSerializable {
	use ValidateUuid;
	use ValidateDate;

	/**
	 * id of this rsvp Id ; this is a Primary key also a composite of rsvpProfileId and rsvpEventID
	 * @var Uuid $rsvpId
	 **/
	private $rsvpId;
	/**
	 * id for this rsvp Profile Id; this is a foreign key
	 * @var Uuid $rsvpProfileId
	 **/
	private $rsvpProfileId;
	/**
	 * id of this rsvp Event ID ; this is a foreign key
	 * @var Uuid $rsvpEventID
	 **/
	private $rsvpEventID;

	/**
	 * This integer that counts the number of people that RSVP to an event
	 * @var TINYINT $rsvpEventCounter
	 **/
	private $rsvpEventCounter;

	/**
	 * constructor EventTypes
	 *
	 * @param string|Uuid $rsvpId id of this event. composite of rsvpProfileId and rsvpEventID
	 * @param string|Uuid $rsvpProfileId id of rsvp to profile Id
	 * @param string|Uuid $rsvpEventID id of rsvp to event Id
	 * @param string rsvpEventCounter this counts the number of people RSVP to an event
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newRsvpId, $newRsvpProfileId, $newRsvpEventID, $newRsvpEventCounter = null) {
		try {
			$this->setRsvpId($newRsvpId);
			$this->setRsvpProfileId($newRsvpProfileId);
			$this->setRsvpEventID($newRsvpEventID);
			$this->setRsvpEventCounter($newRsvpEventCounter);
		}
			//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
}

	/**
	 * accessor method for rsvp id
	 *
	 * @return Uuid value of rsvp id
	 **/
	public function getRsvpId() : Uuid {
		return($this->rsvpId);
	}

	/**
	 * mutator method for rsvp id
	 *
	 * @param Uuid|string $newRsvpId new value of Rsvp Id
	 * @throws \RangeException if $newRsvpId is not positive
	 * @throws \TypeError if $newRsvpId is not a uuid or string
	 **/
	public function setRsvpId( $newRsvpId) : void {
		try {
			$uuid = self::validateUuid($newRsvpId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the rsvp Id
		$this->rsvpId = $uuid;
	}

	/**
	 * accessor method for rsvp profile Id
	 *
	 * @return Uuid value of rsvpProfileId
	 **/
	public function getRsvpProfileId() : Uuid {
		return($this->rsvpProfileId);
	}

	/**
	 * mutator method for rsvp profile Id
	 *
	 * @param Uuid|string $newRsvpProfileId new value of rsvp Profile Id
	 * @throws \RangeException if $newRsvpProfileId is not positive
	 * @throws \TypeError if $newRsvpProfileId is not a uuid or string
	 **/
	public function setRsvpProfileId( $newRsvpProfileId) : void {
		try {
			$uuid = self::validateUuid($newRsvpProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the rsvp Profile Id
		$this->rsvpProfileId = $uuid;
	}







}


?>