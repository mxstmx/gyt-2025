<?php
namespace Eventin\Ens\Email;

/**
 * Class EmailSender
 *
 * @package Eventin\Ens\Email
 *
 * @since 1.0.0
 */
class EmailSender {

    protected $to;
    protected $subject;
    protected $message;
    protected $action_data;
    protected $from;

    /**
     * EmailSender constructor.
     *
     * @since 1.0.0
     */
    public function __construct( $action_name, $receiverType, $to,$from, $subject, $message, $action_data, $count) {
        $this->to          = $to;
        $this->from        = $from;
        $this->subject     = $this->replace_placeholders( $subject, $action_data );
        $message_content   = $this->replace_placeholders( $message, $action_data );
        $this->message     = apply_filters( 'notification_sdk_email_message', $message_content, $receiverType, $action_name, $action_data, $count );
        $this->action_data = $action_data;
    }

    /**
     * Send an email.
     *
     * @since 1.0.0
     *
     * @param \WP_Post $flow
     * @param array    $data
     *
     * @return void
     */
    public function send() {
        // Temporarily set content type to HTML
        add_filter( 'wp_mail_content_type', function () {
            return 'text/html';
        } );

        $headers = $this->get_headers();

        $this->message = apply_filters( 'notification_sdk_email_header', $this->message );
        $this->message = apply_filters( 'notification_sdk_email_body', $this->message );
        $this->message = apply_filters( 'notification_sdk_email_footer', $this->message );
        
        wp_mail( $this->to, $this->subject, $this->message, $headers );

        // Remove the filter to avoid affecting other emails
        remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
    }

    /**
     * Get the headers for the email.
     *
     * @since 1.0.0
     *
     * @return array
     */
    protected function get_headers() {
        $mime_version = "MIME-Version: 1.0" . "\r\n";
        $content_type = "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        $headers = [
            $mime_version,
            $content_type,
        ];

        if ( ! empty( $this->from ) ) {
            $from = $this->from;
            $headers[] = "From: {$from}";
        }

        return apply_filters( 'eventin_email_headers', $headers );
    }

    /**
     * Replace placeholders in a template.
     *
     * @since 1.0.0
     *
     * @param string $template
     * @param array  $data
     *
     * @return string
     */
    public function replace_placeholders( $template, $data ) {
        foreach ( $data as $key => $value ) {
            if ( !is_array( $value ) ) {
                $template = str_replace( '{{' . $key . '}}', $value, $template );
                $template = str_replace( '{%' . $key . '%}', $value, $template );
            }
        }
        return $template;
    }
}