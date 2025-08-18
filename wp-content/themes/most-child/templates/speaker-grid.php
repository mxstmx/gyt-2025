<?php
/**
 * Custom speaker template with event grid.
 */

defined( 'ABSPATH' ) || exit;

use \Etn\Utils\Helper;

$author_id         = get_queried_object_id();
$author_name       = get_the_author_meta( 'display_name', $author_id );
$author_bio        = get_the_author_meta( 'description', $author_id );
$speaker_thumbnail = get_user_meta( $author_id, 'image', true );
$logo              = get_user_meta( $author_id, 'etn_speaker_company_logo', true );
$events            = Helper::events_by_author( $author_id );
?>
<div class="speaker-page">
    <header class="speaker-header" style="<?php echo $speaker_thumbnail ? 'background-image:url(' . esc_url( $speaker_thumbnail ) . ');' : ''; ?>">
        <div class="speaker-container">
            <h1 class="speaker-title"><?php echo esc_html( $author_name ); ?></h1>
            <?php if ( $author_bio ) : ?>
                <p class="speaker-bio"><?php echo esc_html( $author_bio ); ?></p>
            <?php endif; ?>
        </div>
    </header>

    <div class="speaker-container">
        <?php if ( $logo ) : ?>
            <div class="speaker-logo">
                <img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( $author_name ); ?>">
            </div>
        <?php endif; ?>

        <?php if ( ! empty( $events ) ) : ?>
            <div class="speaker-events-grid">
                <?php foreach ( $events as $event ) :
                    $thumb          = get_the_post_thumbnail_url( $event->ID, 'speaker-event' );
                    $date           = get_post_meta( $event->ID, 'etn_start_date', true );
                    $formatted_date = $date ? date_i18n( get_option( 'date_format' ), strtotime( $date ) ) : '';
                    ?>
                    <div class="event-item">
                        <a href="<?php echo esc_url( get_permalink( $event->ID ) ); ?>">
                            <?php if ( $thumb ) : ?>
                                <div class="event-thumb">
                                    <img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( get_the_title( $event->ID ) ); ?>">
                                </div>
                            <?php endif; ?>
                            <h3 class="event-title"><?php echo esc_html( get_the_title( $event->ID ) ); ?></h3>
                            <?php if ( $formatted_date ) : ?>
                                <div class="event-date"><?php echo esc_html( $formatted_date ); ?></div>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
