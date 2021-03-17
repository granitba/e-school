<html lang="en">
<head>
    <?php
    include_once 'teacher_head.php';
    include_once '../actions/getusers.php';
    include_once '../actions/getschedule.php';
    $teachers = getTeachers();
    $schedules = getSchedule();
    $weekdays = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
    $periods = array(1, 2, 3, 4, 5);
    ?>
</head>
<body>
<?php include_once 'teacher_sidebar.php' ?>
<div class="content">
    <h1 class="title">Schedule</h1>
    <table>
        <thead>
        <tr>
            <th scope="col"></th>
            <th scope="rowgroup">Monday</th>
            <th scope="rowgroup">Tuesday</th>
            <th scope="rowgroup">Wednesday</th>
            <th scope="rowgroup">Thursday</th>
            <th scope="rowgroup">Friday</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($periods as $period) {
        $period_schedule = array_filter($schedules, function ($var) use ($period) {
            return ($var['period'] == $period);
        });
        if (!empty($period_schedule)) {
            ?>
            <tr>
                <th data-label="<?= $weekdays[$period - 1] ?>"><span class="hide"><?= $period ?></span></th>
                <?php
                $i = 1;
                foreach ($weekdays as $weekday) {
                    $weekday_schedule = array_filter($period_schedule, function ($var) use ($weekday) {
                        return ($var['weekday'] == $weekday);
                    });
                    if (!empty($weekday_schedule)) {
                        // Per me qu ne index 0, se delke ne index 1,2,3 etc.
                        $weekday_schedule = array_values($weekday_schedule);
                        $weekday_schedule = $weekday_schedule[0]; ?>
                        <td data-label="<?= $i ?>"><?= $weekday_schedule['name'] ?></td>
                    <?php } else { ?>
                        <td data-label="<?= $i ?>">&nbsp</td>
                    <?php }
                    $i++;
                } ?>
            </tr>
        <?php } else { ?>
        <tr>
            <th data-label="<?= $weekdays[$period - 1] ?>"><span class="hide"><?= $period ?></span></th>
            <?php
            $i = 1;
            foreach ($weekdays as $weekday) { ?>
                <td data-label="<?= $i ?>">&nbsp</td>
                <?php $i++;
            }
            }
            } ?>
        </tr>
    </table>
</div>
<script>
    $link = document.getElementById('schedule');
    $link.classList.add('active');
</script>
</body>
</html>

