<?php

namespace App\Enums;

enum TaskStatus: string
{
    case Created = 'created';
    case Assigned = 'assigned';
    case Done = 'done';
}
