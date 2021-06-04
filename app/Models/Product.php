<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\Products\Product as ContractProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model implements ContractProduct
{
    use HasFactory;
}
