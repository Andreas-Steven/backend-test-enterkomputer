<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = ['name', 'category', 'variant', 'price'];

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
