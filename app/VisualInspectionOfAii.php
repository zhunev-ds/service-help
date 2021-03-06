<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class VisualInspectionOfAii extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $appends = [
        'photo',
    ];

    public $table = 'visual_inspection_of_aiis';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'quarter_id',
        'point_id',
        'result',
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

    public function quarter()
    {
        return $this->belongsTo(Report::class, 'quarter_id');
    }

    public function point()
    {
        return $this->belongsTo(Mpoint::class, 'point_id');
    }

    public function getPhotoAttribute()
    {
        $files = $this->getMedia('photo');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }
}
