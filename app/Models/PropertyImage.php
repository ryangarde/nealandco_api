<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;
    protected $fillable = ['name','property_id','type'];

    public function property()
    {
        return $this->belongsTo(User::class);
    }
}
