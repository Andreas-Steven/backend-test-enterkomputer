<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = ['table_id', 'total'];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function transactionItem()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function transactionPromo()
    {
        return $this->hasMany(TransactionPromo::class);
    }
}
