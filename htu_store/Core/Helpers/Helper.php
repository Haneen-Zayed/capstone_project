<?php

namespace Core\Helpers;

use Core\Model\User;

class Helper
{
    public static function redirect(string $url): void
    {
        header("Location: $url");
    }

    public static function check_permission(array $permissions_set): bool
    {
        $display = true;

        if (!isset($_SESSION['user'])) {
            return false;
        }

        $user = new User;
        $assigned_permissions = $user->get_permissions();
        if (!array_intersect($permissions_set, $assigned_permissions)) {
            //  no element of permissions_set is present in assigned_permissions At least
            return false;
        } 
        return $display;
    }

}
