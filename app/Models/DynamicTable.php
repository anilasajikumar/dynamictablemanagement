<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class DynamicTable extends Model
{
    use HasFactory;

    protected $fillable = ['table_name', 'columns'];

    protected $casts = [
        'columns' => 'array',
    ];

    public function rows()
    {
        return $this->hasMany(DynamicTableRow::class, 'table_id');
    }

    
}
