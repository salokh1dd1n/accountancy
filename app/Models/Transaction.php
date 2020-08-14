<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Transaction
 * @package App\Models
 */
class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'date', 'amount', 'is_income',
        'description', 'category_id', 'user_id',
    ];

    /**
     * Transaction belongs to user creator relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Transaction belongs to category relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getDateOnlyAttribute()
    {
        $day = Carbon::parse($this->date)->day;
        return $day;
    }

    public function getAmountWithSeparationAttribute()
    {
        if (!$this->is_income){
            return '-' . $this->amount;
        }
        else{
            return $this->amount;
        }
    }

    public function getFormatedAmountAttribute()
    {
        return number_format($this->amount, 0, '', ' ');
    }

    public function scopeFilterCategory($query)
    {
        return
        $query->when(request('category_id'), function ($q, $categoryId) {
                if ($categoryId == 'null') {
                    $q->whereNull('category_id');
                } else {
                    $q->where('category_id', $categoryId);
                }
            });
    }
    public function scopeFilterDescription($query)
    {
        return
        $query->when(request('query'), function ($q, $query) {
                $q->where('description', 'like', '%'.$query.'%');
            });
    }
}