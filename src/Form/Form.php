<?php

namespace App\Form;

//stockage de nos names de balises et regex

interface Form
{
    Const 
    
    EMAIL_NAME="email",
    PSW_NAME="pswd",
    PSW_CONFIRM_NAME = "confirm",
    PSWD_REGEX = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/",
    
    CHANNEL_NAME="channel_name",
    CHANNEL_DESCR="channel_descr",
    CHANNEL_CAPACITY="channel_capacity";
    
}