<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    use HasFactory;

    /**
     * Define table name
     *
     * @var string
     */
    public $table = 'id_regencies';

    /**
     * Define fillable columns
     *
     * @var array
     */
    protected $fillable = [
        'province_id', 'name',
    ];

    /**
     * Define province relation
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */


    public function districts()
    {
        return $this->hasMany(District::class);
    }


    public function partners()
    {
        return $this->hasMany(Partner::class, 'regencies_id', 'id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'provinces_id', 'id');
    }
}
