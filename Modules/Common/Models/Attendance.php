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

class Attendance extends Model
{
    use HasFactory;
    use Sortable;
    
    protected $table = 'attendances';

    protected $fillable = [
        'id',
        'partner_id',
        'attendance_date',
        'check_in_time',
        'check_out_time',
        'location',
        'status',
        'created_at',
        'updated_at',
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

   
}
