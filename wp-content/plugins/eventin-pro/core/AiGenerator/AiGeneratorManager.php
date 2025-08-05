<?php
namespace EventinPro\AiGenerator;

use WP_Error;

/**
 * AiGeneratorManager Class
 */
class AiGeneratorManager {
    /**
     * Generate content for Module like event title
     *
     * @param   string  $module  Module name (Ex: event)
     * @param   string  $type    title, description
     * @param   string   $data    Keyword for data generator
     *
     * @return  mixed   generated content for 
     */
    public static function generateContent( string $module, string $type, string $data ): mixed {
        try {
            // Get the correct generator
            $generator = AiGeneratorFactory::create( $module, $type );
            return ['status' => 'success', 'data' => $generator->generate( $data ) ];
        } catch (\Exception $e) {
            return new WP_Error( 'content_generator_error', $e->getMessage(), ['status' => 422] );
        }
    }
}
