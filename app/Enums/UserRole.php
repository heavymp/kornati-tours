<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case AGENT = 'agent';

    public function getLabel(): string
    {
        return match($this) {
            self::ADMIN => 'Administrator',
            self::AGENT => 'Agent',
        };
    }

    public function getPermissions(): array
    {
        return match($this) {
            self::ADMIN => [
                'user.view',
                'user.create',
                'user.update',
                'user.delete',
                'booking.view',
                'booking.create',
                'booking.update',
                'booking.delete',
            ],
            self::AGENT => [
                'booking.view',
                'booking.create',
                'booking.update',
            ],
        };
    }
} 