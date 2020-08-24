<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class AiisDocumentationUpdate extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'aiis_documentation_updates';

    protected $appends = [
        'verification_si',
        'verification_aiis',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'year',
        'actual_metr_data',
        'mapping',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getVerificationSiAttribute()
    {
        return $this->getMedia('verification_si');
    }

    public function getVerificationAiisAttribute()
    {
        return $this->getMedia('verification_aiis');
    }
}
