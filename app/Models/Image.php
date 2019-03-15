<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; /*/sofdelets es borrado logico/*/


class Image extends Model
{
    use SoftDeletes;
    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $fillable = ['album_id', 'url_image'];
    public $timestamps = true;
    protected $dates = ['deleted_at'];

     //RELACIONES DE UNO A MUCHOS, un album puede tener muchas imagenes
     //singular
    public function album(){
    	return $this->belongsTo(Album::class);}

    //RELACIONES DE MUCHOS a MUCHOS, una imagen tiene muchas noticias
    public function news(){
    	return $this->belongsToMany(News::class);       
    }
}
