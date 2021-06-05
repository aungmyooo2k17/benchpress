<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\Products\Product as ProductContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model implements ProductContract
{
    use HasFactory;
}
