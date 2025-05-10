<?php

namespace App\Imports;

use App\Models\RechargeCard;
use Maatwebsite\Excel\Concerns\ToModel;

class RechargeCardsImport implements ToModel
{
    public function model(array $row)
    {
        return new RechargeCard([
            'name' => $row[0], // رقم الكارت
            'product_id' => $row[1], // id المنتج المرتبط
        ]);
    }
}