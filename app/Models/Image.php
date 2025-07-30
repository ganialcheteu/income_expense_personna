<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'path',
        'type',
        'type_id',
    ];
    //relation polymorphe
    public function related()
    {
        return $this->morphTo(__FUNCTION__, 'type', 'type_id');
    }

}
