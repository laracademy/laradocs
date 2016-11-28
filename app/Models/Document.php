<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'documents';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'version_id',
        'slug',
        'title',
        'markdown',
        'html',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    // Relationships

    public function version()
    {
        return $this->hasOne(\App\Models\Version::class, 'id', 'version_id');
    }

}