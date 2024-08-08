<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionPromo extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = ['transaction_id', 'promo_id', 'quantity', 'price'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }
}
