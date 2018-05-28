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

		switch ($userInfoType)
		{
			case Enum_UserInfoType::USER_BIO:
				$filterBy = "_id";
				break;
			default:
				$filterBy = "user_id";
		}

		return $this->db
			->selectCollection(Map_UserInfoTypeToDbCollectionName::getCollectionName($userInfoType))
			->find(
				[ $filterBy		=> new ObjectId($userId)],
				["projection" 	=> ["_id" => 0]])
			->toArray();
	}
}