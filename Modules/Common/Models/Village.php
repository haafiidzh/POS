<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    /**
     * Define table name
     *
     * @var string
     */
    public $table = 'id_villages';

    public $timestamps = false;

    /**
     * Define fillable column
     *
     * @var array
     */
    protected $fillable = [
        'district_id', 'name',
    ];

    /**
     * Define district relation
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function partners()
    {
        return $this->hasMany(Partner::class, 'villages_id', 'id');
    }

}
