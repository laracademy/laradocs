<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'navigation';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'version_id',
        'document_id',
        'title',
        'is_heading',
        'sorting',
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

    public function document()
    {
        return $this->hasOne(\App\Models\Document::class, 'id', 'document_id');
    }

    public function sub_navigation()
    {
        return $this->hasMany(\App\Models\Navigation::class, 'parent_id', 'id');
    }

    // helpers

    /**
     * will build the entire navigation for a version
     */
    public static function buildAll($version_id)
    {
        $navigation = Navigation::where('version_id', $version_id)->where('is_heading', true)->orderBy('sorting')->get();
        $navigation = $navigation->map(function($item, $index) {
            return [
                'id'             => $item->id,
                'version_id'     => $item->version_id,
                'title'          => $item->title,
                'sub_navigation' => $item->sub_navigation()->orderBy('sorting')->get(),
            ];
        });


        return $navigation;
    }

}