<?php

namespace App\Concerns;

use Illuminate\Support\Str;

trait HasUuid
{
    protected static function bootHasUuid(): void
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid7();
            }
        });
    }

    public static function findByUuid(string $uuid): ?static
    {
        return static::where(static::getUuidColumn(), $uuid)->first();
    }

    public static function findByUuidOrFail(string $uuid): static
    {
        return static::where(static::getUuidColumn(), $uuid)->firstOrFail();
    }

    public function scopeWhereUuid($query, string $uuid)
    {
        return $query->where(static::getUuidColumn(), $uuid);
    }

    public static function getUuidColumn(): string
    {
        return 'uuid';
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
