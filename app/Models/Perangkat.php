<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perangkat extends Model
{
    use HasFactory;
    protected $table ='perangkat';
    protected $primaryKey ='id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'no_referensi', 'status', 'kondisi'];
}
