<?php

namespace App\Enums;

enum ProjectScope: string
{
    case New = 'new';
    case Expansion = 'expansion';

    public function label(): string
    {
        return match ($this) {
            self::New => 'New',
            self::Expansion => 'Expansion',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::New => 'bg-blue-100 text-blue-800',
            self::Expansion => 'bg-violet-100 text-violet-800',
        };
    }

    public function options(): array
    {
        return array_map(
            fn (ProjectScope $s) => [
                'value' => $s->value,
                'label' => $s->label(),
            ],
            self::cases()
        );
    }
}
