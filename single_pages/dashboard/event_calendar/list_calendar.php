<?php defined('C5_EXECUTE') or die('Access denied.');
?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Event Calendar')); ?>

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

    <h3><?php echo t('List of calendars') ?></h3>
    
    <div class="alert alert-success" id="success" style="display: none">
        <?php echo t('Calendar with all events was deleted') ?>
    </div>
    <div class="alert alert-danger" id="error" style="display: none">
        <?php echo t('Something wrong in delete. Try again') ?>
    </div>

<?php if (empty($calendars)): ?>
    <div class="alert alert-info">
        <?php echo t('There is no calendars. Go to Add calendar to add new calendar.') ?>
    </div>
<?php else: ?>


    <table id="listcalendar" class="table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th><?php echo t('ID') ?></th>
            <th><?php echo t('Calendar title') ?></th>
            <th><?php echo t('Events in calendar') ?></th>
            <th><?php echo t('Options') ?></th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th><?php echo t('ID') ?></th>
            <th><?php echo t('Calendar title') ?></th>
            <th><?php echo t('Events in calendar') ?></th>
            <th><?php echo t('Options') ?></th>
        </tr>
        </tfoot>

        <tbody>
        <?php foreach ($calendars as $cal): ?>
            <tr>
                <td>
                    <?php echo $cal['calendarID']; ?>
                </td>
                <td><input class="calendarID" type="hidden"
                           value="<?php echo $cal['calendarID']; ?>"><?php echo $cal['title']; ?>
                </td>

                <td>
                    <?php if ($cal['total_events'] > 0): ?>
                        <span class="badge badge-important"><?php echo $cal['total_events']; ?></span>
                    <?php else: ?>
                        <span class="badge badge-success"><?php echo $cal['total_events']; ?></span>
                    <?php endif; ?>

                </td>
                <td>
                    <a href="<?php echo View::url('dashboard/event_calendar/list_event/show/' . $cal['calendarID']) ?>"
                       class="btn btn-success"><?php echo t('Show events') ?></a>
                    <a href="<?php echo View::url('dashboard/event_calendar/calendar/update/' . $cal['calendarID']) ?>"
                       class="btn btn-warning edit"><?php echo t('Edit') ?></a>
                    <a href="<?php echo View::url('dashboard/event_calendar/list_event/clearEvents/' . $cal['calendarID']) ?>"
                       class="btn btn-info edit"><?php echo t('Remove all events') ?></a>
                    <button class="btn btn-danger delete"><?php echo t('Delete') ?></button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function () {
            $(".delete").click(function () {
                var elem = $(this);
                var count_evetns = elem.closest('tr').children('td').children('span.badge').html();
                var conf = confirm("Are you sure to delete this calendar with all events? Events in this calendar: " + count_evetns);
                if (conf) {
                    var id = elem.closest('tr').children('td').children('input.calendarID').val();
                    elem.closest('tr').addClass('toRemove');

                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->url('dashboard/event_calendar/list_calendar/delete'); ?>",
                        data: {"id": id},
                        success: function (data) {
                            if (data == "OK") {
                                $("#success").fadeIn(1000).delay(2000).fadeOut(1000);
                                $('.toRemove').remove();
                            }
                            else {
                                $("#error").fadeIn(1000).delay(2000).fadeOut(1000);
                            }
                        }
                    });
                }
                else
                    return false;
            });
        });
    </script>

<?php endif; ?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(); ?>