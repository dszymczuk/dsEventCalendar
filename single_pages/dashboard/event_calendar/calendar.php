<?php defined('C5_EXECUTE') or die('Access denied.');
$form = Loader::helper('form');
?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Event Calendar')); ?>
    <h3><?php echo t('Add / edit event') ?></h3>


    <div class="btn-group" style="margin-top: 15px;">
        <a class="btn" href="<?php echo View::url('dashboard//event_calendar/list_calendar') ?>">Return to calendar list</a>

    </div>

    <form method="post" id="ccm-multilingual-page-report-form" style="margin-top: 35px;">
        <fieldset>
            <label><?php echo t('Calendar title') ?></label>

            <div style="margin-top: 15px;">
                <input type="text" name="calendar_title" id="calendar_title" value="<?php echo $calendar_title; ?>">
            </div>
        </fieldset>
        <fieldset>
            <div class="clearfix">
                <div style="margin-top: 10px;">
                    <input class="btn" type="submit" value="<?php echo t('Add calendar') ?>">

                </div>
            </div>
        </fieldset>
    </form>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(); ?>