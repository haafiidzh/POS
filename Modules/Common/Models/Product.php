<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Common\Contracts\UniqueIdGenerator;
use Modules\Common\Services\Filterables\ProductFilters;
use Modules\Common\Traits\BelongsToCategory;
use Modules\Common\Traits\BelongsToUser;
use Modules\Common\Traits\Sortable;
use Modules\Core\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use ProductFilters;
    use BelongsToCategory;
    use Sortable;
    use UniqueIdGenerator;
    use BelongsToUser;

    /**
     * Define for post factory
     *
     * @return Modules\Common\Database\factories\PostFactory
     */
    protected static function newFactory()
    {
        return \Modules\Common\Database\factories\ProductFactory::new ();
    }

    /**
     * Define table name
     *
     * @var string
     */
    public $table = 'products';

    /**
     * Define this table is not using auto_increment
     *
     * @var bool
     */
    public $incrementing = false;

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
        'title',
        'slug_title',
        'category_id',
        'sub_category_id',
        'type_id',
        'thumbnail',
        'thumbnail_source',
        'price',
        'description',
        'tags',
        'reading_time',
        'number_of_views',
        'number_of_shares',
        'author',
        'published_at',
        'published_by',
        'archived_at',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by'
    ];

    /**
     * Define author relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function writer()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Define editor relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'id');
    }
}
