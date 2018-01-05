<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Token
{

    private static $file = 'token-data-base.json';

    public static function createTokenDataBase($data)
    {
        #/conifg/filesystems.php

        $dir = storage_path("app/token-data-base");

        if (!is_dir($dir)) {
            mkdir($dir, 0775, true);
        }

        if (Storage::disk('token-data-base')->exists(self::$file)) {
            $dataBase = json_decode(Storage::disk('token-data-base')->get(self::$file), true);
            $dataBase[] = $data;
        } else {
            $dataBase = [];
            $dataBase[] = $data;
        }

        self::saveDatabase($dataBase);
    }

    public static function isValidToken($token)
    {
        $dataBase = [];
        if (Storage::disk('token-data-base')->exists(self::$file)) {
            $dataBase = json_decode(Storage::disk('token-data-base')->get(self::$file), true);
            $dataBase = self::sanitizeTokensDataBase($dataBase);
        }

        if (isset($dataBase[$token])) {
            return array_values($dataBase[$token]);
        }

        return [];
    }

    private static function saveDatabase($data)
    {
        $data = json_encode($data);

        Storage::disk('token-data-base')->put(self::$file, $data);
    }

    public static function sanitizeTokensDataBase($data)
    {
        $sanitizeData = [];
        foreach ($data as $key => $value) {
            if (isset($value['access_token'])) {
                $sanitizeData[$value['access_token']] = $value;
            }
        }

        return $sanitizeData;
    }

    public static function deleteTokenDataBase($token)
    {
        $dataBase = json_decode(Storage::disk('token-data-base')->get(self::$file), true);
        $dataBase = self::sanitizeCepDataBase($dataBase);

        if (!isset($dataBase[$token])) {
            return false;
        }

        unset($dataBase[$token]);

        self::saveDatabase(array_keys($dataBase));

        return true;
    }

}
