<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $appends = [
        'xid',
    ];

    protected $fillable = [
        'sku',
        'name',
        'price',
        'quantity',
    ];

    public function getXidAttribute()
    {
        return Crypt::encrypt($this->attributes['id']);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d-M-Y H:i:s');
    }

    // public function getAllProducts(){
    //     return $this->
    // }
}
