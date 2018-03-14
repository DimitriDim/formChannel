<?php

namespace App\Role;

//stockage de nos names de balises et regex

interface Role
{
    Const
    
    SUPER_ADMIN_VALUE = 1,
    ADMIN_VALUE = 2,
    USER_VALUE = 3,
    VISITOR_VALUE = 4;
    
}