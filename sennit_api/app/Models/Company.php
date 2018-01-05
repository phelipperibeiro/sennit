<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\User as Authenticatable; 


class Company extends Authenticatable
{

    private static $file = 'company-data-base.json';

    public static function createQueryDataBase($data)
    {
        #/conifg/filesystems.php

        $dir = storage_path("app/company-data-base");

        if (!is_dir($dir)) {
            mkdir($dir, 0775, true); // argumento true criar pastas recursivamente
        }

        if (Storage::disk('company-data-base')->exists(self::$file)) {
            $dataBase = json_decode(Storage::disk('company-data-base')->get(self::$file), true);
            $dataBase[] = $data;
        } else {
            $dataBase = [];
            $dataBase[] = $data;
        }

        self::saveDatabase($dataBase);
    }

    public static function hasCompany($email)
    {
        $dataBase = [];
        if (Storage::disk('company-data-base')->exists(self::$file)) {
            $dataBase = json_decode(Storage::disk('company-data-base')->get(self::$file), true);
            $dataBase = self::sanitizeCompanyDataBase($dataBase);
        }

        if (isset($dataBase[$email])) {
            return $dataBase[$email];
        }

        return [];
    }

    public static function checkPassword($Hash1, $Hash2)
    {
        if ($Hash1 === $Hash2) {
            return true;
        }

        return false;
    }

    private static function saveDatabase($data)
    {
        $data = json_encode(array_values(self::sanitizeCompanyDataBase($data)));

        Storage::disk('company-data-base')->put(self::$file, $data);
    }

    public static function sanitizeCompanyDataBase($data)
    {
        $sanitizeData = [];
        foreach ($data as $key => $value) {
            if (isset($value['email'])) {
                $sanitizeData[$value['email']] = $value;
            }
        }

        return $sanitizeData;
    }

    public static function getCepDataBaseAll()
    {
        if (Storage::disk('company-data-base')->exists(self::$file)) {
            return json_decode(Storage::disk('company-data-base')->get(self::$file), true);
        }

        return [];
    }

    public static function deleteCepDataBase($company)
    {
        $dataBase = json_decode(Storage::disk('company-data-base')->get(self::$file), true);
        $dataBase = self::sanitizeCepDataBase($dataBase);

        if (!isset($dataBase[$company])) {
            return false;
        }

        unset($dataBase[$company]);
        self::saveDatabase($dataBase);

        return true;
    }

}
