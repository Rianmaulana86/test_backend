<?php

namespace App\Responses;

class ServerResponse
{
    public const INTERNAL_SERVER_ERROR = [
        'rc' => '500',
        'message' => 'Internal Server Error',
        'data' => null
    ];

    public const UNAUTHORIZED = [
        'rc' => '401',
        'message' => 'Unauthenticated',
        'data' => null
    ];

    public const INVALID_CREDENTIALS = [
        'rc' => '401',
        'message' => 'Invalid Credentials',
        'data' => null

    ];

    public const FORBIDDEN = [
        'rc' => '403',
        'message' => 'You are not authorized to access this resource',
        'data' => null
    ];

    public const NOT_FOUND = [
        'rc' => '404',
        'message' => 'Not Found',
        'data' => null

    ];

    public const DATA_NOT_FOUND = [
        'rc' => '404',
        'message' => 'Data Not Found',
        'data' => null
    ];

    public const NOT_FOUND_EX = [
        'rc' => '404',
        'message' => ' Not Found',
        'data' => null
    ];

    public const METHOD_NOT_ALLOWED = [
        'rc' => '405',
        'message' => 'Method Not Allowed',
        'data' => null
    ];

    public const UNPROCESSABLE_ENTITY = [
        'rc' => '422',
        'message' => 'Unprocessable Entity',
        'data' => null
    ];

    public const TOO_MANY_REQUESTS = [
        'rc' => '429',
        'message' => 'Too Many Requests',
        'data' => null
    ];

    public const BAD_REQUEST = [
        'rc' => '400',
        'message' => 'Bad Request',
        'data' => null
    ];

    public const CONFLICT = [
        'rc' => '409',
        'message' => 'Data Already Exist',
        'data' => null
    ];

    public const VALIDATION = [
        'rc' => '400',
        'message' => 'Validation Error',
        'data' => null
    ];

    public const SUCCESS = [
        'rc' => '200',
        'message' => 'Successfully',
    ];

    public const SUCCESS_CREATE = [
        'rc' => '201',
        'message' => 'Successfully Create',
    ];
    public const SUCCESS_UPDATE = [
        'rc' => '201',
        'message' => 'Successfully Update',
    ];

    public const SUCCESS_DELETE = [
        'rc' => '201',
        'message' => 'Successfully Delete',
    ];

    public const SUCCESS_LOGIN = [
        'rc' => '200',
        'message' => 'Successfully logged in',
    ];

    public const SUCCESS_LOGOUT = [
        'rc' => '200',
        'message' => 'Successfully logged out',
    ];

}
