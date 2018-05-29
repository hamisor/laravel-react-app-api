<?php

namespace App\Http\Controllers;

// Hamisor
use App\BusinessLogic\SiteDataProvider;
use App\BusinessLogic\Enums\Enum_UserInfoType;
use App\Exceptions\EmptyUserIdException;
use App\Exceptions\UnknownUserInfoTypeException;
// Lumen
use Illuminate\Http\Response;

class UserController extends Controller
{
	/** @var SiteDataProvider */
	private $siteDataProvider;

	/**
	 * UserController constructor.
	 *
	 * @param SiteDataProvider $siteDataProvider
	 */
	public function __construct(SiteDataProvider $siteDataProvider)
	{
		$this->siteDataProvider =$siteDataProvider;
	}
	/**
	 * Get user's bio
	 *
	 * @param string $userId
	 *
	 * @return Response
	 *
	 * @throws UnknownUserInfoTypeException
	 */
	public function getBio(string $userId)
	{
		try
		{
			return response()->json($this->siteDataProvider->getUserInfo($userId, new Enum_UserInfoType(Enum_UserInfoType::USER_BIO)));
		}
		catch (EmptyUserIdException $ex)
		{
			return response()->json([
				"error_msg"	=> $ex->getMessage()
			], $ex->getCode());
		}
	}
	/**
	 * Get user's education
	 *
	 * @param string $userId
	 *
	 * @return Response
	 *
	 * @throws UnknownUserInfoTypeException
	 */
	public function getEducation(string $userId)
	{
		try
		{
			return response()->json($this->siteDataProvider->getUserInfo($userId, new Enum_UserInfoType(Enum_UserInfoType::USER_EDUCATION)));
		}
		catch (EmptyUserIdException $ex)
		{
			return response()->json([
				"error_msg"	=> $ex->getMessage()
			], $ex->getCode());
		}
	}
	/**
	 * Get user's skills
	 *
	 * @param string $userId
	 *
	 * @return Response
	 *
	 * @throws UnknownUserInfoTypeException
	 */
	public function getSkills(string $userId)
	{
		try
		{
			return response()->json($this->siteDataProvider->getUserInfo($userId, new Enum_UserInfoType(Enum_UserInfoType::USER_SKILLS)));
		}
		catch (EmptyUserIdException $ex)
		{
			return response()->json([
				"error_msg"	=> $ex->getMessage()
			], $ex->getCode());
		}
	}
	/**
	 * Get user's work experience
	 *
	 * @param string $userId
	 *
	 * @return Response
	 *
	 * @throws UnknownUserInfoTypeException
	 */
	public function getWorkExperience(string $userId)
	{
		try
		{
			return response()->json($this->siteDataProvider->getUserInfo($userId, new Enum_UserInfoType(Enum_UserInfoType::USER_WORK_EXPERIENCE)));
		}
		catch (EmptyUserIdException $ex)
		{
			return response()->json([
				"error_msg"	=> $ex->getMessage()
			], $ex->getCode());
		}
	}
}
