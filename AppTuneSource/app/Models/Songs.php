<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Songs extends Model
{
    use HasFactory;

    protected $table = 'songs';

    protected $primaryKey = 'SongID';

    protected $fillable = [
        'SongName',
        'SongImage',
        'SongAudio',
        'Lyrics',
        'GenreID',
        'ArtistID'
    ];
}
