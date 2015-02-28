<?php defined('C5_EXECUTE') or die('Access denied.');
?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Help for dsEventCalendar')); ?>

	<div class="dsMenu">
		<div class="btn-toolbar">
			<div class="btn-group">
				<a class="btn btn-primary" href="<?php echo View::url('dashboard/event_calendar/list_calendar') ?>"><?php echo t('Calendars list'); ?>&nbsp;/&nbsp;<?php echo t('Manage events'); ?></a>
			</div>
			<div class="btn-group">
				<a class="btn btn-success" href="<?php echo View::url('dashboard/event_calendar/calendar') ?>"><?php echo t('Add / edit calendar'); ?></a>
				<a class="btn btn-success" href="<?php echo View::url('dashboard/event_calendar/event') ?>"><?php echo t('Add / edit event'); ?></a>
			</div>
			<div class="btn-group">
				<a class="btn" href="<?php echo View::url('dashboard/event_calendar/types') ?>"><?php echo t('Type of events'); ?></a>
				<a class="btn" href="<?php echo View::url('dashboard/event_calendar/settings') ?>"><?php echo t('Settings'); ?></a>
			</div>
		</div>
	</div>

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