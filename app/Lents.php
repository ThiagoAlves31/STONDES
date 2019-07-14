<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lents extends Model
{   
    protected $fillable = [
        'contact_id', 'product_id','len_date'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\Account\User');
    }
}
