<?php defined('C5_EXECUTE') or die('Access denied.');
?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Event Calendar')); ?>
<h3><?php echo t('List of calendars') ?></h3>

<?php foreach ($calendars as $c): ?>
    <div>
        <input type="text" value="<?php echo $c['calendarID']; ?>">
        <?php echo $c['title']; ?>
        <button class="btn btn-danger delete">Usuń</button>
    </div>
<?php endforeach; ?>


<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(); ?>

<script>
    $(document).ready(function () {
        $(".delete").click(function () {
            var elem = $(this);
            var conf = confirm("Are you sure to delete this calendar with all events?");
            if (conf) {
                var id = elem.siblings('input').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->url('dashboard/event_calendar/list_calendar/delete'); ?>",
                    data: {"id": id},
                    success: function (data) {
                        /*
                         todo success / error messages
                         */
                        if (data == "OK")
                            elem.parent().remove();
                    }
                });
            }
            else
                return false;
        });
    });
</script>