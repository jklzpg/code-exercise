<?php


namespace App\Services;


use Illuminate\Database\Eloquent\Model;

class ModelTableInfoService
{
    protected static array $tableNames = [];

    /**
     * @param string $modelClass
     * @return string
     */
    public static function getTableName(string $modelClass): string
    {

        if (!isset(self::$tableNames[$modelClass])){

            /** @var Model $model */
            $model = new $modelClass;

            self::$tableNames[$modelClass] = $model->getTable();
        }

        return self::$tableNames[$modelClass];
    }


}
