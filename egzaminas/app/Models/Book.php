<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'category_id', 'ISBN', 'pages'];

    const SORT_SELECT = [
        ['title_asc', 'Title A-Z'], 
        ['title_desc', 'Title Z-A'], 
        ['pages_asc', 'Pages MIN-MAX'], 
        ['pages_desc', 'Pages MAX-MIN'], 
    ];

    public function getCategory(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getPhotos(){
        return $this->hasMany(BookImage::class, 'book_id', 'id');
    }

    public function lasImageUrl(){
        return $this->getPhotos()->orderBy('id', 'desc')->first()->url;
    }

    public function addImages(?array $photos) :self{
        if($photos){
        $bookImage =[];
        $time =Carbon::now();
        foreach($photos as $photo){
            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name. '-' . rand(100000, 999999). '.' . $ext;
            $photo->move(public_path().'/images', $file);
            $bookImage[] = [ 'url' => asset('/images') . '/' . $file,
            'book_id' => $this->id,
            'created_at' => $time,
            'updated_at' => $time,          
            ];
        }

        BookImage::insert($bookImage);
        }
        return $this;
    }   

    public function removeImages(?array $photos) :self{
        if($photos){
            $toDelete = BookImage::whereIn('id', $photos)->get();
            foreach($toDelete as $photo){
                $file = public_path().'/images/' .pathinfo($photo->url, PATHINFO_FILENAME).'.'.pathinfo($photo->url, PATHINFO_EXTENSION);    
                if(file_exists($file)){
                    unlink($file);
                }           
            }
            BookImage::destroy($photos);
        }
        return $this;
    }

}
