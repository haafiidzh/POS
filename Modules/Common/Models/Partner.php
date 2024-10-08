<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Common\Contracts\UniqueIdGenerator;
use Modules\Common\Services\Filterables\PartnerFilters;
use Modules\Common\Traits\BelongsToCategory;
use Modules\Common\Traits\Sortable;
use Modules\Core\Models\User;

class Partner extends Model
{
    use HasFactory;
    use PartnerFilters;
    use BelongsToCategory;
    use Sortable;
    use UniqueIdGenerator;


    /**
     * Define this table is not using auto_increment
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Define id data type is a string
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Cast post id
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
    ];

    /**
     * Default with relation
     *
     * @var array
     */
   

    /**
     * Define fillable column in the post table
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'address',
        'phone',
        'status',
        'provinces_id',
        'districts_id',
        'regencies_id',
        'villages_id',
        'name',
        'identify_number',
        'maps_link',
        'created_at',
        'updated_at',
    ];


     // Relasi dengan Province
     public function province()
     {
         return $this->belongsTo(Province::class, 'provinces_id', 'id');
     }
 
     // Relasi dengan Regency
     public function regency()
     {
         return $this->belongsTo(Regency::class, 'regencies_id', 'id');
     }
 
     // Relasi dengan District
     public function district()
     {
         return $this->belongsTo(District::class, 'districts_id', 'id');
     }
 
     // Relasi dengan Village
     public function village()
     {
         return $this->belongsTo(Village::class, 'villages_id', 'id');
     }
    /**
     * Define author relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Define editor relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function editor()
    {
        return $this->belongsTo(User::class, 'published_by', 'id');
    }

    public function retributions()
    {
        return $this->hasMany(History::class);
    }
}
