<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    //protected $fillable = ['title', 'company', 'description', 'tags', 'email', 'location', 'website'];

    public function scopeFilter($query, array $filters) {
        //dd($filters['tags']);
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orwhere('description', 'like', '%' . request('search') . '%')
                ->orwhere('tags', 'like', '%' . request('search') . '%')
                ->orwhere('company', 'like', '%' . request('search') . '%');
        }
    }

    //Relationship with user
    public function user() {
        return $this->belongsTo(User::class, 'user_Id');
    }
}
