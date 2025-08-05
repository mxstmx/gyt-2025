<?php
namespace EventinPro\License;

class Utils {
    /**
     * Essential license functions.
     *
     * @package License
     */

    /**
     * Get license data.
     *
     * @return  array
     */
    public static function get_license() {
        $data = get_option( '_etn_license' );

        return $data;
    }

    /**
     * Check the license is valid or invalid
     *
     * @return  bool
     */
    public static function is_valid_license() {
        $data = self::get_license();

        if ( ! empty( $data['license'] ) && 'valid' == $data['license'] ) {
            return true;
        }

        return false;
    }

    /**
     * Update license key
     *
     * @param   string  $license_key  Activation license key
     *
     * @return  void
     */
    public static function update_user( $args ) {
        $defaults = [
            'name'        => '',
            'email'       => '',
            'license_key' => '',
        ];
        $args = wp_parse_args( $args, $defaults );

        update_option( '_etn_license_user', $args );
    }

    /**
     * Get user details
     *
     * @return  array
     */
    public static function get_user_details() {
        return get_option( '_etn_license_user' );
    }

    /**
     * Get license user name
     *
     * @return  string
     */
    public static function get_name() {
        $data = self::get_user_details();

        $name = ! empty( $data['name'] ) ? $data['name'] : '';

        return $name;
    }

    /**
     * Get license user email
     *
     * @return  email
     */
    public static function get_email() {
        $data = self::get_user_details();

        $email = ! empty( $data['email'] ) ? $data['email'] : '';

        return $email;
    }

    /**
     * Get license key
     *
     * @return  string
     */
    public static function get_license_key() {
        $data = self::get_user_details();

        $license_key = ! empty( $data['license_key'] ) ? $data['license_key'] : '';

        return $license_key;
    }

    /**
     * Delete etn user details
     *
     * @return  bool
     */
    public static function delete_user_details() {
        return delete_option( '_etn_license_user' );
    }

    /**
     * Delete etn license
     *
     * @return bool
     */
    public static function delete_license_details() {
        return delete_option( '_etn_license' );
    }
}


