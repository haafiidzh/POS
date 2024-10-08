<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Common\Contracts\UniqueIdGenerator;
use Modules\Common\Traits\BelongsToCategory;
use Modules\Common\Traits\Sortable;
use Modules\Core\Models\User;

class Retribution extends Model
{
    use HasFactory;
    use BelongsToCategory;
    use Sortable;
    use UniqueIdGenerator;



    /**
     * Define table name
     *
     * @var string
     */
    public $table = 'retributions';

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
        'number_of_days',
        'category_id',
        'nominal',
        'is_active',
        'created_at',
        'updated_at',
    ];

    /**
     * Define author relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function writer()
    {
        return $this->belongsTo(User::class, 'author', 'id');
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

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
