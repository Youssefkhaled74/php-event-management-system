<?php
require 'templates/header.php';
require 'db/init_db.php';

$conn = new PDO('sqlite:' . __DIR__ . '/db/saas_platform.db');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$eventId = $_GET['event_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO attendees (event_id, name, email) VALUES (?, ?, ?)");
    $stmt->execute([$eventId, $name, $email]);

    header('Location: view_attendees.php?event_id=' . $eventId);
    exit;
}

$event = $conn->query("SELECT name FROM events WHERE id = $eventId")->fetch();
?>

<h1 class="text-center">Add Attendee to <?php echo htmlspecialchars($event['name']); ?></h1>
<form method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Attendee Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Attendee</button>
</form>

<?php require 'templates/footer.php'; ?>
