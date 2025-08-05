<?php

namespace Etn_Pro\Core\Event;

use Etn_Pro\Utils\Helper;

defined( 'ABSPATH' ) || exit;

class Event {

	use \Etn\Traits\Singleton;

	/**
	 * Call hooks
	 */
	public function init() {
		// add email remainder.

	}

	/**
	 * Returns event totaL sold ticket count
	 */
	public function get_event_sold_ticket_count( $post_id ) {
		$ticket_qty        = get_post_meta( $post_id, "etn_total_sold_tickets", true );
		$total_sold_ticket = isset( $ticket_qty ) && is_numeric( $ticket_qty ) ? intval( $ticket_qty ) : 0;

		return $total_sold_ticket;
	}

	/**
	 * Returns event total ticket
	 */
	public function get_event_total_ticket_count( $post_id ) {
		$ticket_qty   = get_post_meta( $post_id, "etn_total_avaiilable_tickets", true );
		$total_ticket = isset( $ticket_qty ) && is_numeric( $ticket_qty ) ? intval( $ticket_qty ) : 0;

		return $total_ticket;
	}

	/**
	 * Takes seconds and returns human readable time
	 */
	public function seconds_to_human( $seconds ) {
		// $s = $seconds % 60;
		// $m = floor( ( $seconds % 3600 ) / 60);
		$h = floor( ( $seconds % 86400 ) / 3600 );
		$d = floor( ( $seconds % 2592000 ) / 86400 );
		$M = floor( $seconds / 2592000 );

		return "$M months, $d days, $h hours";
	}
}