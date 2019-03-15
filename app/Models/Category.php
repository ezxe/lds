<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';
    protected $primaryKey = 'id';
    //campos de tabla
    protected $fillable = ['name'];
    //campo tiempo
    public $timestamps = true;
    protected $dates = ['deleted_at'];

    //RELACIONES DE UNO A MUCHOS, una categoria puede tener muchas noticias
    //plural
    public function news(){
    	return $this->hasMany(News::class);
         
    }
}
