<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class AiisWithOremRequirement extends Model
{
    use SoftDeletes;

    public $table = 'aiis_with_orem_requirements';

    protected $dates = [
        'data',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const STATE_PF_4_SELECT = [
        'true'  => 'Соответствует',
        'false' => 'Не соответствует',
    ];

    const STATE_PF_8_SELECT = [
        'true'  => 'Соответствует',
        'false' => 'Не соответствует',
    ];

    const STATE_PF_7_SELECT = [
        'true'  => 'Соответствует',
        'false' => 'Не соответствует',
    ];

    const STATE_PF_9_SELECT = [
        'true'  => 'Соответствует',
        'false' => 'Не соответствует',
    ];

    const STATE_PF_2_SELECT = [
        'true'  => 'Соответствует',
        'false' => 'Не соответствует',
    ];

    const STATE_P_315_SELECT = [
        'true'  => 'Соответствует',
        'false' => 'Не соответствует',
    ];

    const STATE_P_314_SELECT = [
        'true'  => 'Соответствует',
        'false' => 'Не соответствует',
    ];

    const STATE_P_313_SELECT = [
        'true'  => 'Соответствует',
        'false' => 'Не соответствует',
    ];

    const STATE_PF_10_SELECT = [
        'true'  => 'Соответствует',
        'false' => 'Не соответствует',
    ];

    const STATE_PF_11_SELECT = [
        'true'  => 'Соответствует',
        'false' => 'Не соответствует',
    ];

    const STATE_PF_13_SELECT = [
        'true'  => 'Соответствует',
        'false' => 'Не соответствует',
    ];

    const STATE_PF_16_SELECT = [
        'true'  => 'Соответствует',
        'false' => 'Не соответствует',
    ];

    const STATE_PF_24_SELECT = [
        'true'  => 'Соответствует',
        'false' => 'Не соответствует',
    ];

    const STATE_PF_28_SELECT = [
        'true'  => 'Соответствует',
        'false' => 'Не соответствует',
    ];

    const STATE_PF_32_SELECT = [
        'true'  => 'Соответствует',
        'false' => 'Не соответствует',
    ];

    const STATE_PF_40_SELECT = [
        'true'  => 'Соответствует',
        'false' => 'Не соответствует',
    ];

    const STATE_PF_41_SELECT = [
        'true'  => 'Соответствует',
        'false' => 'Не соответствует',
    ];

    const STATE_PF_42_SELECT = [
        'true'  => 'Соответствует',
        'false' => 'Не соответствует',
    ];

    protected $fillable = [
        'data',
        'state_p_313',
        'state_p_314',
        'state_p_315',
        'state_pf_2',
        'state_pf_4',
        'state_pf_7',
        'state_pf_8',
        'state_pf_9',
        'state_pf_10',
        'state_pf_11',
        'state_pf_13',
        'state_pf_16',
        'state_pf_24',
        'state_pf_28',
        'state_pf_32',
        'state_pf_40',
        'state_pf_41',
        'state_pf_42',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getDataAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDataAttribute($value)
    {
        $this->attributes['data'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
