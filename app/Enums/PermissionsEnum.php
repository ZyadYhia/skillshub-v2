<?php

namespace App\Enums;

enum PermissionsEnum: string
{
    // case NAMEINAPP = 'name-in-database';

    case CAN_ENTER_DASHBOARD = 'can enter dashboard';
    case CAN_ENTER_EXAM = 'can enter exam';

    // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
    public function label(): string
    {
        return match ($this) {
            static::CAN_ENTER_DASHBOARD => 'Can Enter Dashboard',
            static::CAN_ENTER_EXAM => 'Can Enter Exam',
        };
    }
}
