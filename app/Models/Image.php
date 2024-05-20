<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['path'];


    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }


    public function url()
    {
        return Str::contains($this->path, 'https://') ?
            $this->path :
            Storage::url($this->path);
    }
}
