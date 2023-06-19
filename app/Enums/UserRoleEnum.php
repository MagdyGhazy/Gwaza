<?php

namespace App\Enums;

enum UserRoleEnum:int
{
    case ADMIN = 1;
    case PROVIDER = 2;
    case VISITOR  = 3;

}
