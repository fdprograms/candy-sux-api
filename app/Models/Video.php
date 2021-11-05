<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    use HasFactory;

    protected $table = 'videos';

    protected $fillable = [
        'uuid',
        'name',
        'description',
        'file_name'
    ];

    protected $appends = ['url'];

    /**
     * roles.
     *
     * @return void
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'video_role');
    }


    public function getUrlAttribute() : string
    {
        return $url = Storage::disk('s3')->temporaryUrl(
            $this->file_name,
            now()->addDay()
        );
    }
}
