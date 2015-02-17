<?php defined('C5_EXECUTE') or die('Access denied.');
?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Help for dsEventCalendar')); ?>

    <?php include_once('dsEventCalendarMenu.php'); ?>

<div class="row">
	<div class="span12">
		<h3>AAA</h3>
		<p>aaa</p>
	</div>
	<div class="span12">
		<h3>BBB</h3>
		<p>bbb</p>
	</div>
</div>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(); ?>