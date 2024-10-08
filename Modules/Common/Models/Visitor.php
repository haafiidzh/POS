<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    /**
     * Define table name
     *
     * @var string
     */
    public $table = 'visitors';

    protected $keyType = 'string';

    /**
     * Define fillable columns
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'ip_address',
        'user_agent',
        'url',
        'last_visit',
        'created_at',
        'updated_at',
    ];
}
