<?php

namespace App\Enums;

enum GroupMemberRole: string {
    case MEMBER = 'member';
    case OWNER = 'owner';
}
