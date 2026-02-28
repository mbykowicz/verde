<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

trait HasUniqueNumber
{
    public static function bootHasUniqueNumber(): void
    {
        static::creating(function (Model $model) {
            $column = $model->getUniqueNumberColumn();

            if (empty($model->{$column})) {
                $model->{$column} = static::generateUniqueNumber();
            }
        });

        static::updating(function (Model $model) {
            $column = $model->getUniqueNumberColumn();

            if ($model->isDirty($column)) {
                if (Gate::denies('edit-unique-number', $model)) {
                    $model->{$column} = $model->getOriginal($column);
                }
            }
        });
    }

    public static function generateUniqueNumber(): string
    {
        $prefix = static::getUniqueNumberPrefix();
        $year = now()->year;
        $column = (new static)->getUniqueNumberColumn();

        $latest = static::query()
            ->where($column, 'like', "{$prefix}-{$year}-%")
            ->orderByDesc($column)
            ->value($column);

        $sequence = 1;

        if ($latest) {
            $parts = explode('-', $latest);
            $sequence = ((int) end($parts)) + 1;
        }

        return "{$prefix}-{$year}-{$sequence}";
    }

    protected static function getUniqueNumberPrefix(): string
    {
        return defined('static::UNIQUE_NUMBER_PREFIX')
            ? static::UNIQUE_NUMBER_PREFIX
            : strtoupper(substr(class_basename(static::class), 0, 2));
    }

    public function getUniqueNumberColumn(): string
    {
        return 'unique_number';
    }
}
