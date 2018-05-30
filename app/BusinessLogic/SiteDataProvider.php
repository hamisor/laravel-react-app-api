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
	 * Get user bio
	 *
	 * @param string $userId
	 *
	 * @return array
	 *
	 * @throws EmptyUserIdException
	 * @throws UnknownUserInfoTypeException
	 */
	public function getUserBio(string $userId) : array
	{
		if (empty($userId))
			throw new EmptyUserIdException();

		return $this->db
			->selectCollection(Map_UserInfoTypeToDbCollectionName::getCollectionName(new Enum_UserInfoType(Enum_UserInfoType::USER_BIO)))
			->findOne(
				["_id" => new ObjectId($userId)],
				["projection" => ["_id" => 0]])
			->getArrayCopy();
	}

	/**
	 * Get user education
	 *
	 * @param string $userId
	 *
	 * @return array
	 *
	 * @throws EmptyUserIdException
	 * @throws UnknownUserInfoTypeException
	 */
	public function getUserEducation(string $userId) : array
	{
		if (empty($userId))
			throw new EmptyUserIdException();

		return $this->db
			->selectCollection(Map_UserInfoTypeToDbCollectionName::getCollectionName(new Enum_UserInfoType(Enum_UserInfoType::USER_EDUCATION)))
			->find(
				[ "user_id"		=> new ObjectId($userId)],
				["projection" 	=> ["_id" => 0, "start_date" => 0 ], "sort" => ["start_date" => -1]])
			->toArray();
	}

	/**
	 * Get user skills
	 *
	 * @param string $userId
	 *
	 * @return array
	 *
	 * @throws EmptyUserIdException
	 * @throws UnknownUserInfoTypeException
	 */
	public function getUserSkills(string $userId) : array
	{
		if (empty($userId))
			throw new EmptyUserIdException();

		return $this->db
			->selectCollection(Map_UserInfoTypeToDbCollectionName::getCollectionName(new Enum_UserInfoType(Enum_UserInfoType::USER_SKILLS)))
			->findOne(
				[ "user_id"		=> new ObjectId($userId)],
				[ "projection" 	=> ["_id" => 0]])
			->getArrayCopy();
	}

	/**
	 * Get user experience
	 *
	 * @param string $userId
	 *
	 * @return array
	 *
	 * @throws EmptyUserIdException
	 * @throws UnknownUserInfoTypeException
	 */
	public function getUserWorkExperience(string $userId) : array
	{
		if (empty($userId))
			throw new EmptyUserIdException();

		return $this->db
			->selectCollection(Map_UserInfoTypeToDbCollectionName::getCollectionName(new Enum_UserInfoType(Enum_UserInfoType::USER_WORK_EXPERIENCE)))
			->find(
				[ "user_id"		=> new ObjectId($userId)],
				["projection" 	=> ["_id" => 0], "sort" => ["start_date" => -1]])
			->toArray();
	}

	/**
	 * Get user projects
	 *
	 * @param string $userId
	 *
	 * @return array
	 *
	 * @throws EmptyUserIdException
	 * @throws UnknownUserInfoTypeException
	 */
	public function getUserProjects(string $userId) : array
	{
		if (empty($userId))
			throw new EmptyUserIdException();

		return $this->db
			->selectCollection(Map_UserInfoTypeToDbCollectionName::getCollectionName(new Enum_UserInfoType(Enum_UserInfoType::USER_PROJECTS)))
			->find(
				[ "user_id"		=> new ObjectId($userId)],
				["projection" 	=> ["_id" => 0, "start_date" => 0 ], "sort" => ["start_date" => -1]])
			->toArray();
	}

}