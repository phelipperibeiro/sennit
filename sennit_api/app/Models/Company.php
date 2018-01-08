<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{

    private static $file = 'company-data-base.json';

    public static function addCompanyDataBase($data)
    {
        $dir = storage_path("app/company-data-base");

        if (!is_dir($dir)) {
            mkdir($dir, 0775, true); // argumento true criar pastas recursivamente
        }

        if (isset($data['token'])) {
            unset($data['token']);
        }

        $data['id'] = md5(uniqid(rand(), true));
        $data['password'] = md5($data['password']);

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
            $dataBase = self::sanitizeCompanyDataBase($dataBase, 'email');
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

    public static function sanitizeCompanyDataBase($data, $key = 'id')
    {
        $sanitizeData = [];
        
        foreach ($data as $value) {
            if (isset($value[$key])) {
                $sanitizeData[$value[$key]] = $value;
            }
        }
        return $sanitizeData;
    }

    public static function getCompanyDataBaseAll()
    {
        if (Storage::disk('company-data-base')->exists(self::$file)) {
            return json_decode(Storage::disk('company-data-base')->get(self::$file), true);
        }

        return [];
    }

    public static function findCompanyDataBase($id)
    {
        $dataBase = json_decode(Storage::disk('company-data-base')->get(self::$file), true);
        $dataBase = self::sanitizeCompanyDataBase($dataBase);

        if (!isset($dataBase[$id])) {
            return [];
        }

        return $dataBase[$id];
    }

    public static function deleteCompanyDataBase($id)
    {
        $dataBase = json_decode(Storage::disk('company-data-base')->get(self::$file), true);
        $dataBase = self::sanitizeCompanyDataBase($dataBase);

        if (!isset($dataBase[$id])) {
            return false;
        }

        unset($dataBase[$id]);
        self::saveDatabase($dataBase);

        return true;
    }

    public static function updateCompanyDataBase($data, $id)
    {
        $dataBase = json_decode(Storage::disk('company-data-base')->get(self::$file), true);
        $dataBase = self::sanitizeCompanyDataBase($dataBase);

        if (!isset($dataBase[$id])) {
            return false;
        }

        if (isset($data['token'])) {
            unset($data['token']);
        }

        $dataBase[$id]['email'] = isset($data['email']) ? $data['email'] : $dataBase[$id]['email'];
        $dataBase[$id]['company'] = isset($data['company']) ? $data['company'] : $dataBase[$id]['company'];
        $dataBase[$id]['password'] = isset($data['password']) ? md5($data['password']) : $dataBase[$id]['password'];

        self::saveDatabase($dataBase);

        return true;
    }

}
