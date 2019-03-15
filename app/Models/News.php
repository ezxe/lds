<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;
    protected $table = 'news';
    protected $primaryKey = 'id';
    protected $fillable = ['category_id','title','subtitle','date','content','outstanding','url_pdf','url_video'];
    
    public $timestamps = true;
    protected $dates = ['deleted_at'];

    /*/RELACIONES DE MUCHOS A UNO, muchas noticias tiene una categoria/*/
    public function category(){
    	return $this->belongsTo(Category::class, 'category_id', 'id');       
    }

    public function image(){
        return $this->belongsToMany(Image::class);       
    }
}