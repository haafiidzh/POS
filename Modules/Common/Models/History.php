<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Common\Contracts\UniqueIdGenerator;
use Modules\Common\Services\Filterables\ProductFilters;
use Modules\Common\Traits\BelongsToCategory;
use Modules\Common\Traits\Sortable;
use Modules\Core\Models\User;

class History extends Model
{
    use HasFactory;
    use ProductFilters;
    use BelongsToCategory;
    use Sortable;

  
    /**
     * Define table name
     *
     * @var string
     */
    public $table = 'history_retributions';

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
    protected $with = [
        'category:id,name,slug',
    ];

    /**
     * Define fillable column in the post table
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'partner_id',
        'start_date',
        'end_date',
        'payment_date',
        'nominal',
        'created_at',
        'updated_at',
    ];

    /**
     * Define author relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    
}
