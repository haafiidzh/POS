<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Common\Traits\Sortable;
use Modules\Common\Services\Filterables\SalesFilters;

class Transaction extends Model
{
    use SalesFilters;
    use HasFactory;
    use Sortable;
    
    protected $table = 'transactions';

    protected $fillable = [
        'id',
        'partner_id',
        'total_amount',
        'transaction_date',
        'value',
        'change_amount',
        'payment_method',
        'created_at',
        'updated_at',
    ];

    /**
     * Relasi ke tabel `partners`.
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id','id');
    }

    /**
     * Relasi ke tabel `transaction_details`.
     */
    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }
}
