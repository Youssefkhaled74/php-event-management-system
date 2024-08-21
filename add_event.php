<?php
require 'templates/header.php';
require 'db/init_db.php';

$conn = new PDO('sqlite:' . __DIR__ . '/db/saas_platform.db');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $venue = $_POST['venue'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO events (name, date, venue, description) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $date, $venue, $description]);

    header('Location: index.php');
    exit;
}
?>

<h1 class="text-center">Add New Event</h1>
<form method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Event Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Event Date</label>
        <input type="date" name="date" id="date" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="venue" class="form-label">Venue</label>
        <input type="text" name="venue" id="venue" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Add Event</button>
</form>

<?php require 'templates/footer.php'; ?>
