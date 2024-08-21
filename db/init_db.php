<?php
define('DB_PATH', __DIR__ . '/saas_platform.db');

try {
    $conn = new PDO('sqlite:' . DB_PATH);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create tables
    $conn->exec("CREATE TABLE IF NOT EXISTS events (
        id INTEGER PRIMARY KEY,
        name TEXT NOT NULL,
        date TEXT NOT NULL,
        venue TEXT NOT NULL,
        description TEXT
    )");

    $conn->exec("CREATE TABLE IF NOT EXISTS attendees (
        id INTEGER PRIMARY KEY,
        event_id INTEGER NOT NULL,
        name TEXT NOT NULL,
        email TEXT NOT NULL,
        FOREIGN KEY (event_id) REFERENCES events(id)
    )");

    echo "Database and tables created successfully!";
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
