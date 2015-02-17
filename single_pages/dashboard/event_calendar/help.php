<?php defined('C5_EXECUTE') or die('Access denied.');
?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Help')); ?>

    <?php include_once('dsEventCalendarMenu.php'); ?>

    <h3><?php echo t('Help for dsEventCalendar') ?></h3>



<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(); ?>