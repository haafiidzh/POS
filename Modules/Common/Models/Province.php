<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    /**
     * Define table name
     *
     * @var string
     */
    public $table = 'id_provinces';

    /**
     * Define fillable columns
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];


    public $timestamps = true;

    public function regencies()
    {
        return $this->hasMany(Regency::class);
    }

    public function partners()
    {
        return $this->hasMany(Partner::class, 'provinces_id', 'id');
    }

}
