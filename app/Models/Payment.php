<?php

namespace App\Models;

use VulcanPhp\SimpleDb\Model;

class Payment extends Model
{
    public static function tableName(): string
    {
        return 'payments';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public static function fillable(): array
    {
        return ['order_id', 'subtotal', 'total', 'method', 'payment_id', 'status'];
    }
}
