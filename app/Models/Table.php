<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = ['name'];

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
