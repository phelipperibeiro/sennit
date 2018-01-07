<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;

class Cep
{

    private static $file = 'cep-data-base.json';

    public static function addCepDataBase($data)
    {
        #/conifg/filesystems.php

        $dir = storage_path("app/cep-data-base");

        if (!is_dir($dir)) {
            mkdir($dir, 0775, true); // argumento true criar pastas recursivamente
        }

        if (Storage::disk('cep-data-base')->exists(self::$file)) {
            $dataBase = json_decode(Storage::disk('cep-data-base')->get(self::$file), true);
            $dataBase[] = $data;
        } else {
            $dataBase = [];
            $dataBase[] = $data;
        }

        self::saveDatabase($dataBase);
    }

    private static function saveDatabase($data)
    {
        $data = json_encode(array_values(self::sanitizeCepDataBase($data)));

        Storage::disk('cep-data-base')->put(self::$file, $data);
    }

    public static function sanitizeCepDataBase($data)
    {
        $sanitizeData = [];
        foreach ($data as $key => $value) {
            if (isset($value['cep'])) {
                $sanitizeData[$value['cep']] = $value;
            }
        }

        return $sanitizeData;
    }

    public static function getCepDataBaseAll()
    {
        if (Storage::disk('cep-data-base')->exists(self::$file)) {
            return json_decode(Storage::disk('cep-data-base')->get(self::$file), true);
        }

        return [];
    }

    public static function deleteCepDataBase($cep)
    {
        $dataBase = json_decode(Storage::disk('cep-data-base')->get(self::$file), true);
        $dataBase = self::sanitizeCepDataBase($dataBase);

        if (!isset($dataBase[$cep])) {
            return false;
        }

        unset($dataBase[$cep]);
        self::saveDatabase($dataBase);

        return true;
    }

}
