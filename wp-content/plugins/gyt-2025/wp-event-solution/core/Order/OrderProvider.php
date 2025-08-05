<?php
namespace Eventin\Order;

use Eventin\Abstracts\Provider;
/**
 * Order Provider
 */
class OrderProvider extends Provider {
    /**
     * Holds classes that should be instantiated
     *
     * @var array
     */
    protected $services = [
        OrderTicket::class,
        OrderAttendee::class,
    ];
}
