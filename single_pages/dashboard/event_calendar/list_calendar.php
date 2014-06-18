<?php defined('C5_EXECUTE') or die('Access denied.');
?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Event Calendar')); ?>
<div class="alert alert-success" id="success" style="display: none">
    Calendar with all events was deleted
</div>
<div class="alert alert-danger" id="error" style="display: none">
    Something wrong in delete. Try again
</div>

<h3><?php echo t('List of calendars') ?></h3>

<?php if(empty($calendars)): ?>
    <div class="alert alert-info">
        There is no calendars. Go to Add calendar to add new calendar.
    </div>
<?php else: ?>


<table id="listcalendar" class="table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Calendar title</th>
        <th>Events in calendar</th>
        <th>Options</th>
    </tr>
    </thead>

    <tfoot>
    <tr>
        <th>Calendar title</th>
        <th>Events in calendar</th>
        <th>Options</th>
    </tr>
    </tfoot>

    <tbody>
    <?php foreach ($calendars as $cal): ?>
        <tr>
            <td><input class="calendarID" type="text" value="<?php echo $cal['calendarID']; ?>"><?php echo $cal['title']; ?>
            </td>
            <td>
                <?php if($cal['total_events'] > 0): ?>
                    <span class="badge badge-important"><?php echo $cal['total_events']; ?></span>
                <?php else: ?>
                    <span class="badge badge-success"><?php echo $cal['total_events']; ?></span>
                <?php endif; ?>

            </td>
            <td><a href="#" class="btn btn-warning edit">Edit</a>
                <button class="btn btn-danger delete">Delete</button>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<!--<div id="dialog-confirm" title="Empty the recycle bin?" style="display: none">-->
<!--    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>These items will be permanently deleted and cannot be recovered. Are you sure?</p>-->
<!--</div>-->



<script>
    $(document).ready(function () {


//        $(function() {
//            $( "#dialog-confirm" ).dialog({
//                resizable: false,
//                modal: true,
//                buttons: {
//                    "Delete all items": function() {
//                        $( this ).dialog( "close" );
//                    },
//                    Cancel: function() {
//                        $( this ).dialog( "close" );
//                    }
//                }
//            });
//        });


        $(".delete").click(function () {
            var elem = $(this);
            var count_evetns = elem.closest('tr').children('td').children('span.badge').html();
            console.log(count_evetns);
            var conf = confirm("Are you sure to delete this calendar with all events? Events in this calendar: "+count_evetns);
            if (conf) {
                var id = elem.closest('tr').children('td').children('input.calendarID').val();
                elem.closest('tr').addClass('toRemove');
                console.log(id);
                $('.toRemove').remove();
//                $.ajax({
//                    type: "POST",
<!--                    url: "--><?php //echo $this->url('dashboard/event_calendar/list_calendar/delete'); ?><!--",-->
//                    data: {"id": id},
//                    success: function (data) {
                        /*
                         todo success / error messages
                         */
//                        if (data == "OK")
//                            elem.parent().remove();
//                    }
//                });
            }
            else
                return false;
        });
    });
</script>

<?php endif; ?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(); ?>