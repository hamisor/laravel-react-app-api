<?php

namespace App\Exceptions;

// Lumen
use Illuminate\Http\Response;
// System
use Exception;
use Throwable;

class EmptyUserIdException extends Exception
{
	private const MESSAGE		= "USER ID EMPTY";
	private const RESPONSE_CODE	= Response::HTTP_BAD_REQUEST;

	public function __construct(Throwable $previous = null)
	{
		parent::__construct(self::MESSAGE, self::RESPONSE_CODE, $previous);
	}
}