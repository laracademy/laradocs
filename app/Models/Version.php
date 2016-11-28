<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Version extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'versions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag',
        'slug',
        'is_default',
        'active',
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
        'is_default' => 'boolean',
        'active' => 'boolean',
    ];

    // Relationships

    public function navigation()
    {
        return $this->hasMany(\App\Models\Navigation::class, 'version_id', 'id');
    }

    public function documents()
    {
        return $this->hasMany(\App\Models\Document::class, 'version_id', 'id');
    }

    // helper

    public function setDefault($isDefault)
    {
        // cast
        $isDefault = (bool)$isDefault;

        if($this->is_default != $isDefault)
        {
            // write sql to quickly change rest
            DB::statement('UPDATE versions SET is_default = 0');

            // set new default
            $this->is_default = $isDefault;
            $this->save();
        }
    }

}