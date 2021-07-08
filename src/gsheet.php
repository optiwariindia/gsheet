<?php

namespace optiwariindia;

use Exception;

class gsheet
{
    private static $credentials, $sheetid, $client, $range;
    public static function init($credentials, $sheetid)
    {
        self::$credentials = $credentials;
        self::$sheetid = $sheetid;
        $cl = new \Google\Client();
        $cl->setApplicationName("Google Seheet");
        $cl->setScopes([\Google\Service\Sheets::SPREADSHEETS]);
        $cl->setAccessType("offline");
        $cl->setAuthConfig(self::$credentials);
        self::$client = $cl;
    }
    public static function getData($range)
    {
        $service = new \Google\Service\Sheets(self::$client);
        $response = $service->spreadsheets_values->get(self::$sheetid, $range);
        return $response->getValues();
    }
    public static function addData($range, $data)
    {
        $service = new \Google\Service\Sheets(self::$client);
        $body = new \Google\Service\Sheets\ValueRange([
            "values" => $data
        ]);
        $params = [
            "valueInputOption" => "RAW",
        ];
        $insert = [
            "insertDataOption" => "INSERT_ROWS"
        ];
        $service->spreadsheets_values->append(self::$sheetid, $range, $body, $params, $insert);
    }
    public static function updateData($range, $data)
    {
        $service = new \Google\Service\Sheets(self::$client);
        $body = new \Google\Service\Sheets\ValueRange([
            "values" => $data
        ]);
        $params = [
            "valueInputOption" => "RAW",
        ];
        $service->spreadsheets_values->update(self::$sheetid, $range, $body, $params);
    }
    public static function find($range, $data, $col)
    {
        $info=[];
        foreach (self::getData($range) as $key => $value) {
            if ($value[$col] == $data) {
                $info[$key]=$value;
            }
        }
        return $info;
    }
    public static function deleteData($range)
    {
        $service = new \Google\Service\Sheets(self::$client);
        $body = new \Google\Service\Sheets\ClearValuesRequest();
        $service->spreadsheets_values->clear(self::$sheetid, $range, $body);
    }

}
