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

class  TransactionDetail extends Model
{
    use HasFactory;
    use Sortable;
    
    protected $table = 'transaction_details';

    protected $fillable = [
        'id',
        'transaction_id',
        'product_id',
        'quantity',
        'price',
        'subtotal',
        'transaction_date',
        'created_at',
        'updated_at',
    ];

    /**
     * Relasi ke model `Transaction`.
     * Setiap detail transaksi akan memiliki relasi ke satu transaksi.
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    /**
     * Relasi ke model `Product`.
     * Setiap detail transaksi berhubungan dengan satu produk.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
