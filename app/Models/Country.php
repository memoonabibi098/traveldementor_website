<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'urdu_name',
        'code',
        'img',
    ];


    public function countryEmbassy()
    {
        return $this->hasOne(CountryEmbassy::class); // get the row in country_embassy for this country
    }

    public function embassies()
    {
        return $this->hasOne(CountryEmbassy::class)->with('embassyModels');
    }
}
