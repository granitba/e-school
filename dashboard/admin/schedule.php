<html lang="en">
<head>
    <?php
    include_once 'admin_head.php';
    include_once '../actions/getusers.php';
    include_once '../actions/getschedule.php';
    $teachers = getTeachers();
    $schedules = getSchedule();
    $weekdays = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
    $periods = array(1, 2, 3, 4, 5);
    ?>
</head>
<body>
<?php
include_once 'admin_sidebar.php';
?>
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
    <div class="schedule">
        <form class="schedule-form" method="post" action="../actions/addschedule.php">
            <select class="text-input" style="text-align-last: center;" name="weekday">
                <option value="" disabled selected>Select the weekday</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
            </select>
            <select class="text-input" style="text-align-last: center;" name="period">
                <option value="" disabled selected>Select the period</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <select class="text-input" style="text-align-last: center;" name="teacher_id">
                <option value="" disabled selected>Select the teacher</option>
                <?php foreach ($teachers as $teacher): ?>
                    <option value="<?= $teacher['Id'] ?>"><?= $teacher['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <p style="color:red" id="error" align="center"></p>
            <input class="submit" type="submit" value="Change schedule" align="center">
        </form>
    </div>
</div>
<script>
    $link = document.getElementById('schedule');
    $link.classList.add('active');
</script>
</body>
</html>
