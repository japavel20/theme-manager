<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Historiable
{
    public function histories()
    {
        $tableName = (property_exists(get_class($this), 'singularTableName') ? $this->singularTableName : null) ?? Str::singular($this->table);
        $historiesTable = $tableName . '_histories';
        $this->setTable($historiesTable);
        return new HasMany($this->newQuery(), $this, $historiesTable . '.' . $tableName . '_id', 'id');
    }

    public static function bootHistoriable()
    {
        static::created(function ($model) {
            $singularTableName = (property_exists($model, 'singularTableName') ? $model->singularTableName : null) ?? Str::singular($model->table);
            $historiesTable = $singularTableName . '_histories';
            $data = $model->attributes;
            $data[$singularTableName . '_id'] = $data['id'];
            $data['action'] = 'created';
            if (Schema::hasColumn($historiesTable, 'id')) {
                $columnType = Schema::getColumnType($historiesTable, 'id'); // Get column type

                if ($columnType === 'uuid' || $columnType === 'char') {
                    // ✅ If UUID, generate one
                    $data['id'] = Str::uuid()->toString();
                } else {
                    // ✅ If integer (auto-increment), remove 'id' so Laravel handles it
                    unset($data['id']);
                }
            }
            DB::connection($model->connection)->table($singularTableName . '_histories')->insert($data);
        });

        static::updated(function ($model) {
            $singularTableName = (property_exists($model, 'singularTableName') ? $model->singularTableName : null) ?? Str::singular($model->table);
            $historiesTable = $singularTableName . '_histories';
            $data = $model->attributes;
            $data[$singularTableName . '_id'] = $data['id'];
            $data['action'] = 'updated';
            if (Schema::hasColumn($historiesTable, 'id')) {
                $columnType = Schema::getColumnType($historiesTable, 'id'); // Get column type
                dd($columnType);
                if ($columnType === 'uuid' || $columnType === 'char') {
                    // ✅ If UUID, generate one
                    $data['id'] = Str::uuid()->toString();
                } else {
                    // ✅ If integer (auto-increment), remove 'id' so Laravel handles it
                    unset($data['id']);
                }
            }
            if (!Str::isUuid($data['id'])) {
                unset($data['id']);
            }
            DB::connection($model->connection)->table($singularTableName . '_histories')->insert($data);
        });

        static::deleted(function ($model) {
            $singularTableName = (property_exists($model, 'singularTableName') ? $model->singularTableName : null) ?? Str::singular($model->table);
            $historiesTable = $singularTableName . '_histories';
            $data = $model->attributes;
            $data[$singularTableName . '_id'] = $data['id'];
            $data['action'] = 'deleted';
            if (Schema::hasColumn($historiesTable, 'id')) {
                $columnType = Schema::getColumnType($historiesTable, 'id'); // Get column type

                if ($columnType === 'uuid' || $columnType === 'char') {
                    // ✅ If UUID, generate one
                    $data['id'] = Str::uuid()->toString();
                } else {
                    // ✅ If integer (auto-increment), remove 'id' so Laravel handles it
                    unset($data['id']);
                }
            }
            if (!Str::isUuid($data['id'])) {
                unset($data['id']);
            }
            DB::connection($model->connection)->table($singularTableName . '_histories')->insert($data);
        });
    }
}
