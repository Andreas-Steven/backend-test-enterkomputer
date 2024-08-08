<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = ['name', 'price'];

    public function transactionPromo()
    {
        return $this->hasMany(TransactionPromo::class);
    }
}
