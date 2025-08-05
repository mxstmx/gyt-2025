<?php
namespace EventinPro\AiGenerator;

/**
 * Ai Generator Interface
 */
interface AiGeneratorInterface {
    /**
     * Generate content using AI
     *
     * @param   string  $data  Accept prompt data
     *
     * @return  mixed   Ai Content Response
     */
    public function generate( string $data ): mixed;
}
