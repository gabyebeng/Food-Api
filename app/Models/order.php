<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function createWithFood($orderData, $items)
    {
        $order = self::create($orderData);

        foreach ($items as $item) {
            $order->foods()->attach($item, ['id'], ['quantity' => $item('quantity')]);


            return $order;
            # code...
        }

    }
}
