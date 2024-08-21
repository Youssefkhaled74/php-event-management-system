<?php
require 'templates/header.php';
require 'db/init_db.php';

$conn = new PDO('sqlite:' . __DIR__ . '/db/saas_platform.db');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$events = $conn->query("SELECT * FROM events")->fetchAll();
?>

<h1 class="text-center">Upcoming Events</h1>
<a href="add_event.php" class="btn btn-success mb-4">Add New Event</a>
<ul class="list-group">
    <?php foreach ($events as $event): ?>
        <li class="list-group-item">
            <strong><?php echo htmlspecialchars($event['name']); ?></strong> - <?php echo htmlspecialchars($event['date']); ?> at <?php echo htmlspecialchars($event['venue']); ?>
            <a href="view_attendees.php?event_id=<?php echo $event['id']; ?>" class="btn btn-primary btn-sm float-end">View Attendees</a>
        </li>
    <?php endforeach; ?>
</ul>

<?php require 'templates/footer.php'; ?>
