<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    use HasFactory;

    protected $tables = 'transaction_headers';

    protected $guarded = [];

    public static function boot() {
        parent::boot();

        static::created(function($model) {
            $model->document_code = 'TRX';
            $model->document_number = str_pad($model->id, 3, '0', STR_PAD_LEFT);
            $model->save();
        });
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionHeader::class, 'document_number', 'document_number');
    }
}
