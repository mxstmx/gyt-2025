<?php
namespace EventinPro\AiGenerator;

use EventinPro\Event\EventTitleGenerator;
use EventinPro\Event\EventDescriptionGenerator;
use EventinPro\Event\EventImageGenerator;
use EventinPro\Event\EventFaqGenerator;

/**
 * Ai Generator Factory Class
 */
class AiGeneratorFactory {
    /**
     * Create content for module and certain field
     *
     * @param   string                $module  Module name (Ex: event, schedule)
     * @param   string                $type    Contenet generator type (Ex: title)
     *
     * @return  AiGeneratorInterface
     */
    public static function create(string $module, string $type): AiGeneratorInterface {
        $generators = [
            'event' => [
                'title'       => EventTitleGenerator::class,
                'description' => EventDescriptionGenerator::class,
                'image'       => EventImageGenerator::class,
                'faq'         => EventFaqGenerator::class,
            ],
        ];

        if ( ! isset( $generators[$module][$type] ) ) {
            throw new \InvalidArgumentException("Invalid type: $type for module: $module");
        }

        return new $generators[$module][$type]();
    }
}
