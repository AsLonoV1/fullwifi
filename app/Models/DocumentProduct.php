<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentProduct extends Model
{
    use HasFactory;
    protected $table = 'document_products';

    protected $primaryKey = 'id';

    protected $fillable = [
        'document_id',
        'title',
        'measure',
        'count',
        'price'
    ];
}
