<?php

namespace App\Enums;

//   ProjectStatus:
//     - draft
//     - active
//     - on_hold
//     - prepared
//     - scheduled
//     - installation
//     - completed
//     - maintenance
//     - cancelled

enum ProjectStatus: string
{
    case Draft = 'draft';
    case Active = 'active';
    case OnHold = 'on_hold';
    case Prepared = 'prepared';
    case Scheduled = 'scheduled';
    case Installation = 'installation';
    case Completed = 'completed';
    case Maintenance = 'maintenance';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Active => 'Active',
            self::OnHold => 'On Hold',
            self::Prepared => 'Prepared',
            self::Scheduled => 'Scheduled',
            self::Installation => 'Installation',
            self::Completed => 'Completed',
            self::Maintenance => 'Maintenance',
            self::Cancelled => 'Cancelled',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Draft => 'bg-gray-100 text-gray-800',
            self::Active => 'bg-green-100 text-green-800',
            self::OnHold => 'bg-yellow-100 text-yellow-800',
            self::Prepared => 'bg-blue-100 text-blue-800',
            self::Scheduled => 'bg-purple-100 text-purple-800',
            self::Installation => 'bg-orange-100 text-orange-800',
            self::Completed => 'bg-teal-100 text-teal-800',
            self::Maintenance => 'bg-indigo-100 text-indigo-800',
            self::Cancelled => 'bg-red-100 text-red-800',
        };
    }
}
