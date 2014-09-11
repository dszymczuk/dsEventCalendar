<?php defined('C5_EXECUTE') or die('Access denied.');
?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Event Calendar')); ?>
    <div class="alert alert-success" id="success" style="display: none">
        <?php echo t('Event was deleted') ?>
    </div>
    <div class="alert alert-danger" id="error" style="display: none">
        <?php echo t('Something wrong in delete. Try again') ?>
    </div>

    <h3><?php echo t('List of events') ?></h3>


<?php if (empty($events)): ?>
    <div class="alert alert-info">
        <?php echo t('There is no events. Go to Add event to add new event.') ?>
    </div>
<?php else: ?>


    <table id="listevent" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th><?php echo t('Event title') ?></th>
            <th><?php echo t('Event date') ?></th>
            <th><?php echo t('Event type') ?></th>
            <th><?php echo t('Event description') ?></th>
            <th><?php echo t('Event URL') ?></th>
            <th><?php echo t('Calendar Title') ?></th>
            <th><?php echo t('Options') ?></th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th><?php echo t('Event title') ?></th>
            <th><?php echo t('Event date') ?></th>
            <th><?php echo t('Event type') ?></th>
            <th><?php echo t('Event description') ?></th>
            <th><?php echo t('Event URL') ?></th>
            <th><?php echo t('Calendar Title') ?></th>
            <th><?php echo t('Options') ?></th>
        </tr>
        </tfoot>

        <tbody>
        <?php foreach ($events as $e): ?>
            <tr>
                <td><input class="eventID" type="hidden" value="<?php echo $e['eventID']; ?>"><?php echo $e['title']; ?>
                </td>
                <td><?php echo $e['date']; ?></td>
                <td><?php echo $e['type_name']; ?></td>
                <td><?php echo $e['description']; ?></td>
                <td><?php echo $e['url']; ?></td>
                <td><?php echo $e['title_cal']; ?></td>
                <td><a href="<?php echo View::url('dashboard/event_calendar/event/update/' . $e['eventID']) ?>"
                       class="btn btn-warning edit"><?php echo t('Edit') ?></a>
                    <button class="btn btn-danger delete"><?php echo t('Delete') ?></button>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>


    <script>
        $(document).ready(function () {

//        $('#listevent').hide();

            var listevent = $('#listevent').dataTable({
                "order": [
                    [ 1, "desc" ]
                ],
                "aoColumns": [
                    {},
                    {sWidth: '10%'},
                    {},
                    {},
                    {},
                    {},
                    {}
                ],
                "language": {
                    "lengthMenu": "Display _MENU_ records per page",
                    "zeroRecords": "Nothing found - sorry",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                },
                "initComplete": function () {
//                $('#listevent').show();
                }
            });

            $("tr").on('click', 'button.delete', function () {
                var elem = $(this);
                var conf = confirm("Are you sure to delete this event?");
                if (conf) {
                    var id = elem.closest('tr').children('td').children('input.eventID').val();
                    elem.closest('tr').addClass('toRemove');
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->url('dashboard/event_calendar/list_event/delete'); ?>",
                        data: {"id": id},
                        success: function (data) {
                            if (data == "OK") {
                                $("#success").fadeIn(1000).delay(2000).fadeOut(1000);
                                listevent.fnDeleteRow(elem.closest('tr'));
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