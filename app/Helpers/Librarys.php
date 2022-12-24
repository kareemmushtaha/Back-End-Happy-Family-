<?php


namespace App\Helpers;


class Librarys
{

    public static function sendResponse($result, $message)
    {
        $response = [
            'code' => 200,
            'success' => true,
            'message' => $message,
            'data' => $result,
        ];
        return response()->json($response, 200);
    }

    public static function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'code' => 404,
            'success' => false,
            'message' => $error
        ];
        if (!empty($errorMessages)) {

            $response['date'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

}
