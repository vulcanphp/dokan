<?php

namespace App\Models;

use VulcanPhp\SimpleDb\Model;

class Order extends Model
{
    public static function tableName(): string
    {
        return 'orders';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public static function fillable(): array
    {
        return ['name', 'email', 'phone', 'address', 'status'];
    }
}
