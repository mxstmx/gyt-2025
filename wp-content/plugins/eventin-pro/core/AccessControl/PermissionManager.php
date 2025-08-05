<?php
/**
 * Manage access control
 * 
 * @package Eventin
 */
namespace EventinPro\AccessControl;

use Eventin\AccessControl\Permission;
use Eventin\Interfaces\HookableInterface;

/**
 * Permission manager class
 */
class PermissionManager implements HookableInterface {
    /**
     * Register all required hooks
     *
     * @return  void
     */
    public function register_hooks(): void {
        add_filter( 'eventin_role_permissions', [ $this, 'set_permissions' ] );
    }

    /**
     * Manage permissions
     *
     * @param   array  $caps     [$caps description]
     * @param   string  $cap      [$cap description]
     * @param   [type]  $user_id  [$user_id description]
     * @param   [type]  $args     [$args description]
     *
     * @return  [type]            [return description]
     */
    public function set_permissions( $permissions ) {
        return Permission::get_settings();
    }
}

