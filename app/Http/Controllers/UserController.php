<?php

namespace App\Http\Controllers;

// Hamisor
use App\BusinessLogic\SiteDataProvider;
use App\BusinessLogic\Enums\Enum_UserInfoType;
// Lumen
use Illuminate\Http\Response;
// System
use Throwable;

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
	 */
	public function getBio(string $userId)
	{
		try
		{
			return response()->json($this->siteDataProvider->getUserInfo($userId, new Enum_UserInfoType(Enum_UserInfoType::USER_BIO)));
		}
		catch (Throwable $ex)
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
	 */
	public function getEducation(string $userId)
	{
		try
		{
			return response()->json($this->siteDataProvider->getUserInfo($userId, new Enum_UserInfoType(Enum_UserInfoType::USER_EDUCATION)));
		}
		catch (Throwable $ex)
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
	 */
	public function getSkills(string $userId)
	{
		try
		{
			return response()->json($this->siteDataProvider->getUserInfo($userId, new Enum_UserInfoType(Enum_UserInfoType::USER_SKILLS)));
		}
		catch (Throwable $ex)
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
	 */
	public function getWorkExperience(string $userId)
	{
		try
		{
			return response()->json($this->siteDataProvider->getUserInfo($userId, new Enum_UserInfoType(Enum_UserInfoType::USER_WORK_EXPERIENCE)));
		}
		catch (Throwable $ex)
		{
			return response()->json([
				"error_msg"	=> $ex->getMessage()
			], $ex->getCode());
		}
	}
}
