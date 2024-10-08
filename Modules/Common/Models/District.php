<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    /**
     * Define table name
     *
     * @var string
     */
    public $table = 'id_districts';

    /**
     * Define fillable columns
     *
     * @var array
     */
    protected $fillable = [
        'regency_id', 'name',
    ];

    /**
     * Define regency relation
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */



    public function villages()
    {
        return $this->hasMany(Village::class);
    }

    public function partners()
    {
        return $this->hasMany(Partner::class, 'districts_id', 'id');
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class, 'regencies_id', 'id');
    }
}
