<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = ['lead_type','f_name','m_name','l_name','address', 'contact_no','email','location','type','lot_area_min','lot_area_max','price_min', 'price_max','price_per_sqm','price_total'];
}
