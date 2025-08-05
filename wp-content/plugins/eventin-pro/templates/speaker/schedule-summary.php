<?php
defined( 'ABSPATH' ) || exit;

$author_id = get_queried_object_id();
$etn_speaker_summary = get_user_meta( $author_id, 'etn_speaker_summery', true);

if( !empty( $etn_speaker_summary ) ){
    ?>
    <div class="speaker-summery">
        <p class="etn-speaker-desc"> <?php echo \Etn_Pro\Utils\Helper::render($etn_speaker_summary); ?></p>
    </div>
    <?php
}