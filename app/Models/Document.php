<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table = 'documents';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'senior_id',
        'title',
        'address',
        'status',
        'ir_returned'
    ];

    public function products()
    {
        return $this->hasMany(DocumentProduct::class,'document_id','id');
    }
}
