<?php

namespace App\BusinessLogic;

// Hamisor
use App\BusinessLogic\Enums\Enum_UserInfoType;
use App\BusinessLogic\Maps\Map_UserInfoTypeToDbCollectionName;
use App\Exceptions\EmptyUserIdException;
use App\Exceptions\UnknownUserInfoTypeException;
// Third Party
use Jenssegers\Mongodb\Connection;
// MongoDB Extension
use MongoDB\Database;
use MongoDB\BSON\ObjectId;

class SiteDataProvider
{
	/** @var Database */
	private $db;

	/**
	 * SiteDataProvider constructor.
	 *
	 * @param array $dbConfig
	 */
	public function __construct(array $dbConfig)
	{
		if(!empty($dbConfig))
			$this->db = (new Connection($dbConfig))->getMongoDB();
	}

	// Todo: This function is becoming a kitchen sink, split query types into relevant functions
	/**
	 * Get user info by user id and info type
	 *
	 * @param string            $userId
	 * @param Enum_UserInfoType $userInfoType
	 *
	 * @return array
	 *
	 * @throws EmptyUserIdException
	 * @throws UnknownUserInfoTypeException
	 */
	public function getUserInfo(string $userId, Enum_UserInfoType $userInfoType) : array
	{
		if (empty($userId))
			throw new EmptyUserIdException();

		$collection =  $this->db->selectCollection(Map_UserInfoTypeToDbCollectionName::getCollectionName($userInfoType));

		switch ($userInfoType)
		{
			case Enum_UserInfoType::USER_BIO:
				return $collection->findOne(
					[ "_id"			=> new ObjectId($userId)],
					[ "projection" 	=> ["_id" => 0]])
					->getArrayCopy();
			case Enum_UserInfoType::USER_SKILLS:
				return $collection->findOne(
					[ "user_id"		=> new ObjectId($userId)],
					[ "projection" 	=> ["_id" => 0]])
					->getArrayCopy();
            case Enum_UserInfoType::USER_WORK_EXPERIENCE:
                return $collection->find(
                    [ "user_id"		=> new ObjectId($userId)],
                    ["projection" 	=> ["_id" => 0], "sort" => ["start_date" => -1]])
                    ->toArray();
			default:
				return $collection->find(
					[ "user_id"		=> new ObjectId($userId)],
					["projection" 	=> ["_id" => 0]])
					->toArray();
		}
	}
}