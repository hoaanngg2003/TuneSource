<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Albums extends Model
{
    use HasFactory;

    protected $table = 'albums';

    protected $primaryKey = 'AlbumID';


    protected $fillable = [
        'AlbumName',
        'ReleaseDate',
        'CoverImage',
        'ArtistID',
    ];

}
