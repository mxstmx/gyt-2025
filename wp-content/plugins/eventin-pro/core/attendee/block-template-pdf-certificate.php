<?php
wp_head();

// Required scripts to generate Certificate PDF
wp_enqueue_script('html-to-image');
wp_enqueue_script('etn-pdf-gen');

?>

<!-- Viewport meta overwritten because of pdf layout. It should not be changed even in mobile device. -->
<meta name="viewport" content="width=900 initial-scale=1">

<!-- Layout wrapper -->
<div class="etn-certificate-container">

    <div class="eventin-container-block" id="etn-pdf-container">
        <?php echo $certificate_content ?>
    </div>
    <div class="etn-control-header">
        <button id="etn-certificate-download" class="etn-certificate-download etn-btn">
            <?php echo esc_html__('Download Certificate', 'eventin-pro'); ?>
        </button>
    </div>

</div>
<!-- Layout wrapper end -->
<?php     
    wp_footer();
?>