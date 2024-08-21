<?php
require 'templates/header.php';
require 'db/init_db.php';

$conn = new PDO('sqlite:' . __DIR__ . '/db/saas_platform.db');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$eventId = $_GET['event_id'];
$event = $conn->query("SELECT * FROM events WHERE id = $eventId")->fetch();
$attendees = $conn->query("SELECT * FROM attendees WHERE event_id = $eventId")->fetchAll();
?>

<h1 class="text-center">Attendees for <?php echo htmlspecialchars($event['name']); ?></h1>
<a href="add_attendee.php?event_id=<?php echo $eventId; ?>" class="btn btn-success mb-4">Add Attendee</a>
<ul class="list-group">
    <?php foreach ($attendees as $attendee): ?>
        <li class="list-group-item">
            <?php echo htmlspecialchars($attendee['name']); ?> (<?php echo htmlspecialchars($attendee['email']); ?>)
        </li>
    <?php endforeach; ?>
</ul>

<?php require 'templates/footer.php'; ?>
