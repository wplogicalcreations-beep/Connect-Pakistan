<?php

namespace App\Contracts;

interface IRole
{
    public const SUPER_ADMIN = 'super_admin';
    public const CUSTOMER = 'customer';
    public const ORGANIZATION_ADMIN = 'organization_admin';
}
