<?php

namespace App\Enums;

enum RolesEnum: string
{
    // case NAMEINAPP = 'name-in-database';

    case SUPERADMIN = 'superadmin';
    case ADMIN = 'admin';
    case STUDENT = 'student';

    // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
    public function label(): string
    {
        return match ($this) {
            static::SUPERADMIN => 'Superadmin',
            static::ADMIN => 'Admin',
            static::STUDENT => 'Student',
        };
    }
}
