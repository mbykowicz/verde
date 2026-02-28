<?php

namespace App\Enums;

enum ProjectSector: string
{
    case Residential = 'residential';
    case Commercial = 'commercial';
    case Industrial = 'industrial';
    case Agricultural = 'agricultural';

    public function label(): string
    {
        return match ($this) {
            self::Residential => 'Residential',
            self::Commercial => 'Commercial',
            self::Industrial => 'Industrial',
            self::Agricultural => 'Agricultural',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Residential => 'bg-blue-100 text-blue-800',
            self::Commercial => 'bg-green-100 text-green-800',
            self::Industrial => 'bg-yellow-100 text-yellow-800',
            self::Agricultural => 'bg-purple-100 text-purple-800',
        };
    }

    public function options(): array
    {
        return array_map(
            fn (ProjectSector $s) => [
                'value' => $s->value,
                'label' => $s->label(),
            ],
            self::cases()
        );
    }
}
