<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Common\Contracts\UniqueIdGenerator;
use Modules\Common\Services\Filterables\PostFilters;
use Modules\Common\Traits\BelongsToCategory;
use Modules\Common\Traits\Sortable;
use Modules\Core\Models\User;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PostFilters;
    use BelongsToCategory;
    use Sortable;
    use UniqueIdGenerator;

    /**
     * Define for post factory
     *
     * @return Modules\Common\Database\factories\PostFactory
     */
    protected static function newFactory()
    {
        return \Modules\Common\Database\factories\PostFactory::new ();
    }

    /**
     * Define table name
     *
     * @var string
     */
    public $table = 'posts';

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
        'subject',
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
}
