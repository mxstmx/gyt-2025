<?php
/**
 * Extentions class
 * 
 * @package Eventin
 */
namespace Eventin\Extensions;

use Eventin\Ens\Config;
use Eventin\Ens\Flow\Flow;
use Exception;

/**
 * Class extention
 */
class ImportAutomation {

    public static function create_automation_flows() {
        $result = array(
            'flow_ids' => array(),
            'errors'   => array(),
        );

        $automation_flows = [
            [
                'name' => 'Purchase Email Automation For Attendee',
                'trigger' => 'event_ticket_purchase',
                'flow_config' => [
                    'nodes' => [
                        [
                            'id' => 'node_1',
                            'type' => 'trigger',
                            'name' => 'trigger',
                            'data' => [
                                'label' => 'trigger: event_ticket_purchase',
                                'subtitle' => 'Event Ticket Purchase',
                                'triggerValue' => 'event_ticket_purchase',
                            ],
                            'position' => [
                                'x' => 200,
                                'y' => 50,
                            ],
                        ],
                        [
                            'id' => 'node_2',
                            'type' => 'end',
                            'name' => 'end',
                            'data' => [
                                'label' => 'end_flow',
                                'subtitle' => 'End execution path',
                            ],
                            'position' => [
                                'x' => 200,
                                'y' => 410,
                            ],
                        ],
                        [
                            'id' => 'node_3',
                            'type' => 'action',
                            'name' => 'email',
                            'data' => [
                                'actionType' => 'send_email',
                                'label' => 'send_email',
                                'subtitle' => 'Subject: Attendee ticket purchase',
                                'receiverType' => 'attendee_email',
                                'from' => 'admin@gmail.com',
                                'subject' => 'Ticket purchase successful',
                                'body' => '',
                            ],
                            'position' => [
                                'x' => 200,
                                'y' => 230,
                            ],
                        ],
                    ],
                    'edges' => [
                        [
                            'id' => 'edge_node_1-node_3',
                            'type' => 'smoothstep',
                            'markerEnd' => [
                                'type' => 'arrowclosed',
                            ],
                            'source' => 'node_1',
                            'target' => 'node_3',
                            'data' => [],
                        ],
                        [
                            'id' => 'edge_node_3-node_2',
                            'type' => 'smoothstep',
                            'markerEnd' => [
                                'type' => 'arrowclosed',
                            ],
                            'source' => 'node_3',
                            'target' => 'node_2',
                            'data' => [],
                        ],
                    ],
                ],
                'status' => 'draft',
            ],
            [
                'name' => 'Purchase Email Automation For Customer',
                'trigger' => 'event_ticket_purchase',
                'flow_config' => [
                    'nodes' => [
                        [
                            'id' => 'node_1',
                            'type' => 'trigger',
                            'name' => 'trigger',
                            'data' => [
                                'label' => 'trigger: event_ticket_purchase',
                                'subtitle' => 'Event Ticket Purchase',
                                'triggerValue' => 'event_ticket_purchase',
                            ],
                            'position' => [
                                'x' => 200,
                                'y' => 50,
                            ],
                        ],
                        [
                            'id' => 'node_2',
                            'type' => 'end',
                            'name' => 'end',
                            'data' => [
                                'label' => 'end_flow',
                                'subtitle' => 'End execution path',
                            ],
                            'position' => [
                                'x' => 200,
                                'y' => 410,
                            ],
                        ],
                        [
                            'id' => 'node_3',
                            'type' => 'action',
                            'name' => 'email',
                            'data' => [
                                'actionType' => 'send_email',
                                'label' => 'send_email',
                                'subtitle' => 'Subject: Customer ticket purchase',
                                'receiverType' => 'customer_email',
                                'from' => 'admin@gmail.com',
                                'subject' => 'You have successfully purchased a ticket',
                                'body' => '',
                            ],
                            'position' => [
                                'x' => 200,
                                'y' => 230,
                            ],
                        ],
                    ],
                    'edges' => [
                        [
                            'id' => 'edge_node_1-node_3',
                            'type' => 'smoothstep',
                            'markerEnd' => [
                                'type' => 'arrowclosed',
                            ],
                            'source' => 'node_1',
                            'target' => 'node_3',
                            'data' => [],
                        ],
                        [
                            'id' => 'edge_node_3-node_2',
                            'type' => 'smoothstep',
                            'markerEnd' => [
                                'type' => 'arrowclosed',
                            ],
                            'source' => 'node_3',
                            'target' => 'node_2',
                            'data' => [],
                        ],
                    ],
                ],
                'status' => 'draft',
            ],
            [
                'name' => 'Purchase Email Automation For Admin',
                'trigger' => 'event_ticket_purchase',
                'flow_config' => [
                    'nodes' => [
                        [
                            'id' => 'node_1',
                            'type' => 'trigger',
                            'name' => 'trigger',
                            'data' => [
                                'label' => 'trigger: event_ticket_purchase',
                                'subtitle' => 'Event Ticket Purchase',
                                'triggerValue' => 'event_ticket_purchase',
                            ],
                            'position' => [
                                'x' => 200,
                                'y' => 50,
                            ],
                        ],
                        [
                            'id' => 'node_2',
                            'type' => 'end',
                            'name' => 'end',
                            'data' => [
                                'label' => 'end_flow',
                                'subtitle' => 'End execution path',
                            ],
                            'position' => [
                                'x' => 200,
                                'y' => 410,
                            ],
                        ],
                        [
                            'id' => 'node_3',
                            'type' => 'action',
                            'name' => 'email',
                            'data' => [
                                'actionType' => 'send_email',
                                'label' => 'send_email',
                                'subtitle' => 'Subject: Admin purchase confirmetion',
                                'receiverType' => 'admin_email',
                                'from' => 'admin@gmail.com',
                                'subject' => 'Customer has successfully purchased ticket',
                                'body' => '',
                            ],
                            'position' => [
                                'x' => 200,
                                'y' => 230,
                            ],
                        ],
                    ],
                    'edges' => [
                        [
                            'id' => 'edge_node_1-node_3',
                            'type' => 'smoothstep',
                            'markerEnd' => [
                                'type' => 'arrowclosed',
                            ],
                            'source' => 'node_1',
                            'target' => 'node_3',
                            'data' => [],
                        ],
                        [
                            'id' => 'edge_node_3-node_2',
                            'type' => 'smoothstep',
                            'markerEnd' => [
                                'type' => 'arrowclosed',
                            ],
                            'source' => 'node_3',
                            'target' => 'node_2',
                            'data' => [],
                        ],
                    ],
                ],
                'status' => 'draft',
            ],
            [
                'name' => 'RSVP Automation',
                'trigger' => 'event_rsvp_email',
                'flow_config' => [
                    'nodes' => [
                        [
                            'id' => 'node_1',
                            'type' => 'trigger',
                            'name' => 'trigger',
                            'data' => [
                                'label' => 'trigger: event_rsvp_email',
                                'subtitle' => 'RSVP Email',
                                'triggerValue' => 'event_rsvp_email',
                            ],
                            'position' => [
                                'x' => 200,
                                'y' => 50,
                            ],
                        ],
                        [
                            'id' => 'node_2',
                            'type' => 'end',
                            'name' => 'end',
                            'data' => [
                                'label' => 'end_flow',
                                'subtitle' => 'End execution path',
                            ],
                            'position' => [
                                'x' => 200,
                                'y' => 410,
                            ],
                        ],
                        [
                            'id' => 'node_3',
                            'type' => 'action',
                            'name' => 'email',
                            'data' => [
                                'actionType' => 'send_email',
                                'label' => 'send_email',
                                'subtitle' => 'Subject: RSVP ATTENDEES REMINDER',
                                'receiverType' => 'attendee_email',
                                'from' => 'admin@gmail.com',
                                'subject' => 'Event Reminder',
                                'body' => '',
                            ],
                            'position' => [
                                'x' => 175.74853493583362,
                                'y' => 239.09429939906244,
                            ],
                        ],
                    ],
                    'edges' => [
                        [
                            'id' => 'edge_node_1-node_3',
                            'type' => 'smoothstep',
                            'markerEnd' => [
                                'type' => 'arrowclosed',
                            ],
                            'source' => 'node_1',
                            'target' => 'node_3',
                            'data' => [],
                        ],
                        [
                            'id' => 'edge_node_3-node_2',
                            'type' => 'smoothstep',
                            'markerEnd' => [
                                'type' => 'arrowclosed',
                            ],
                            'source' => 'node_3',
                            'target' => 'node_2',
                            'data' => [],
                        ],
                    ],
                ],
                'status' => 'draft',
            ],
            [
                'name' => 'Event Reminder',
                'trigger' => 'event_reminder_email',
                'flow_config' => [
                    'nodes' => [
                        [
                            'id' => 'node_1',
                            'type' => 'trigger',
                            'name' => 'trigger',
                            'data' => [
                                'label' => 'trigger: event_reminder_email',
                                'subtitle' => 'Event Reminder Email',
                                'triggerValue' => 'event_reminder_email',
                            ],
                            'position' => [
                                'x' => 200,
                                'y' => 50,
                            ],
                        ],
                        [
                            'id' => 'node_2',
                            'type' => 'end',
                            'name' => 'end',
                            'data' => [
                                'label' => 'end_flow',
                                'subtitle' => 'End execution path',
                            ],
                            'position' => [
                                'x' => 200,
                                'y' => 590,
                            ],
                        ],
                        [
                            'id' => 'node_3',
                            'type' => 'action',
                            'name' => 'delay',
                            'data' => [
                                'actionType' => 'add_delay',
                                'label' => 'add_delay',
                                'subtitle' => 'Wait for 10 minutes',
                                'delay' => 10,
                                'delayUnit' => 'minutes',
                                'delayCondition' => 'before_event_date',
                            ],
                            'position' => [
                                'x' => 200,
                                'y' => 230,
                            ],
                        ],
                        [
                            'id' => 'node_4',
                            'type' => 'action',
                            'name' => 'email',
                            'data' => [
                                'actionType' => 'send_email',
                                'label' => 'send_email',
                                'subtitle' => 'Subject: Remin you',
                                'receiverType' => 'attendee_email',
                                'from' => 'eventin@admin.com',
                                'subject' => 'Event Reminder',
                                'body' => '',
                            ],
                            'position' => [
                                'x' => 200,
                                'y' => 410,
                            ],
                        ],
                    ],
                    'edges' => [
                        [
                            'id' => 'edge_node_1-node_3',
                            'type' => 'smoothstep',
                            'markerEnd' => [
                                'type' => 'arrowclosed',
                            ],
                            'source' => 'node_1',
                            'target' => 'node_3',
                            'data' => [],
                        ],
                        [
                            'id' => 'edge_node_3-node_4',
                            'type' => 'smoothstep',
                            'markerEnd' => [
                                'type' => 'arrowclosed',
                            ],
                            'source' => 'node_3',
                            'target' => 'node_4',
                            'data' => [],
                        ],
                        [
                            'id' => 'edge_node_4-node_2',
                            'type' => 'smoothstep',
                            'markerEnd' => [
                                'type' => 'arrowclosed',
                            ],
                            'source' => 'node_4',
                            'target' => 'node_2',
                            'data' => [],
                        ],
                    ],
                ],
                'status' => 'draft',
            ]
        ];
        try {
            Config::set( 'general_prefix', 'eve' );
            foreach ( $automation_flows as $key => $automation_flow ) {                
                $flow = new Flow( 0 );
                $flow->set_props( $automation_flow );
                $flow_id = $flow->save();
                if ( $flow_id ) {
                    $result['flow_ids'][] = $flow_id;
                }
            }

            update_option( 'etn_email_automation_migrated', true );           
        } catch ( Exception $e ) {
            $result['errors'][] = 'Failed to create service: ' . $e->getMessage();
        }

        return $result;
    }
}
