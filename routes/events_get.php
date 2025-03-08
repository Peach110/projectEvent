<?php
if (!isset($_GET['keyword'])) {
    renderView('events_get');
} elseif ($_GET['keyword'] == '') {
    $result = getEvent();
    $events = $result->fetch_all(MYSQLI_ASSOC);
    renderView('events_get', array('events' => $events));
} else {
    $keyword = $_GET['keyword'] ?? null;
    $start_date = $_GET['start_date'] ?? null;
    $end_date = $_GET['end_date'] ?? null;

    $result = getEventsByKeywordAndDate($keyword, $start_date, $end_date);
    $events = $result->fetch_all(MYSQLI_ASSOC);

    renderView('events_get', ['events' => $events]);
}
