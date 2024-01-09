<?php

namespace App\Models;

use VulcanPhp\SimpleDb\Model;

class OrderItem extends Model
{
    public static function tableName(): string
    {
        return 'orderitems';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public static function fillable(): array
    {
        return ['order_id', 'product_id', 'quantity'];
    }
}
