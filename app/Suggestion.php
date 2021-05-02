<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $table = 'suggestions';

    /**
     * Method responsible for providing relationship with suggestion and type
     */
    public function type(){
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    /**
     * Method responsible for providing relationship with suggestion and brand
     */
    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
}
