<?php
class Authorization
{
    private static $roles = [
        'directeur' => ['create', 'read', 'update', 'delete'],
        'responsable' => ['create', 'read', 'update'],
        'employé' => ['read', 'update'],
    ];

    public static function hasPermission($role, $action)
    {
        $permissions = self::$roles[$role] ?? [];
        return in_array($action, $permissions);
    }
}
