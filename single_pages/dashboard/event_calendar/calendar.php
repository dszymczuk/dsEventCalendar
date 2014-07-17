<?php defined('C5_EXECUTE') or die('Access denied.');
$form = Loader::helper('form');
?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Event Calendar')); ?>
    <h3><?php echo t('Add / edit calendar') ?></h3>


    <div class="btn-group" style="margin-top: 15px;">
        <a class="btn"
           href="<?php echo View::url('dashboard/event_calendar/list_calendar') ?>"><?php echo t('Return to calendar list'); ?></a>
    </div>

    <form class="form-horizontal" method="post" id="ccm-multilingual-page-report-form" style="margin-top: 35px;">
        <fieldset class="control-group">
            <label class="control-label"><?php echo t('Calendar title') ?></label>

            <div class="controls">
                <input maxlength="255" type="text" name="calendar_title" id="calendar_title" value="<?php echo $calendar_title; ?>">
            </div>
        </fieldset>


        <fieldset class="control-group offset2">
            <div class="clearfix">
                <div style="margin-top: 10px;">
                    <input class="<?php echo $button['class'] ?>" type="submit" value="<?php echo $button['label'] ?>">
                </div>
            </div>
        </fieldset>
    </form>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(); ?>