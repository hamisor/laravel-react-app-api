<?php

namespace App\BusinessLogic\Maps;

// Hamisor
use App\BusinessLogic\Enums\Enum_UserInfoType;
use App\Exceptions\UnknownUserInfoTypeException;

class Map_UserInfoTypeToDbCollectionName
{
	/**
	 * Get collection name
	 *
	 * @param Enum_UserInfoType $userInfoType
	 *
	 * @return string
	 *
	 * @throws UnknownUserInfoTypeException
	 */
	public static function getCollectionName(Enum_UserInfoType $userInfoType) : string
	{
		switch ($userInfoType)
		{
			case Enum_UserInfoType::USER_BIO:
				return "users";
			case Enum_UserInfoType::USER_EDUCATION:
				return "education";
			case Enum_UserInfoType::USER_SKILLS:
				return "skills";
			case Enum_UserInfoType::USER_WORK_EXPERIENCE:
				return "work_experience";
			default:
				throw new UnknownUserInfoTypeException();
		}
	}
}