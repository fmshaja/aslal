<?php
// contact.php
require_once 'config/database.php';

$message_sent = false;
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!empty($name) && !empty($email) && !empty($message)) {
        // Optional: Insert into database if you have set up the `contacts` table
        /*
        try {
            $stmt = $pdo->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $message]);
            $message_sent = true;
        } catch(PDOException $e) {
            $error_message = "Database Error. Message not saved.";
        }
        */
        
        // For demonstration, we just set true
        $message_sent = true;
    } else {
        $error_message = "Please fill in all fields.";
    }
}

require_once 'includes/header.php';
?>

<h1 style="text-align: center; margin-bottom: 2rem;">Contact Us</h1>

<?php if ($message_sent): ?>
    <div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 4px; text-align: center; margin-bottom: 2rem;">
        Thank you for contacting AZLAL (Pvt) Ltd.! We will get back to you shortly.
    </div>
<?php endif; ?>

<?php if ($error_message): ?>
    <div style="background: #f8d7da; color: #721c24; padding: 1rem; border-radius: 4px; text-align: center; margin-bottom: 2rem;">
        <?php echo htmlspecialchars($error_message); ?>
    </div>
<?php endif; ?>

<form action="contact.php" method="POST">
    <div class="form-group">
        <label for="name">Your Name</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="message">Message</label>
        <textarea id="message" name="message" rows="5" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
</form>

<?php
require_once 'includes/footer.php';
?>
