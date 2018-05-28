<?php

namespace App\Exceptions;

// Lumen
use Illuminate\Http\Response;
// System
use Exception;
use Throwable;

class UnknownUserInfoTypeException extends Exception
{
	private const MESSAGE		= "UNKNOWN USER INFO TYPE";
	private const RESPONSE_CODE	= Response::HTTP_INTERNAL_SERVER_ERROR;

	public function __construct(Throwable $previous = null)
	{
		parent::__construct(self::MESSAGE, self::RESPONSE_CODE, $previous);
	}
}