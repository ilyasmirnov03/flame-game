<?php

namespace App\Enums;

enum UserRole: string{
    case MEMBER = 'member';
    case REDACTOR = 'redactor';
    case ADMIN = 'administrator';
}
