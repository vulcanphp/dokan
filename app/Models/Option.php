<?php

namespace App\Models;

use VulcanPhp\SimpleDb\Model;

class Option extends Model
{
    public static function tableName(): string
    {
        return 'options';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public static function fillable(): array
    {
        return ['name', 'value'];
    }
}
