<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$host = "localhost";
$dbname = "opentra_db";
$dbuser = "root";
$dbpass = "";

try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $dbuser,
        $dbpass
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    die("Database connection failed.");
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        !isset($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        die("Invalid request. Please try again.");
    }

    if (isset($_POST['delete_eois'])) {
        $jobRef = $_POST['delete_job_ref'] ?? '';

        if (in_array($jobRef, ['WD101', 'UX202'], true)) {
            $sql = "DELETE FROM eoi WHERE jobref = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$jobRef]);
            $message = $stmt->rowCount() . " EOI(s) deleted successfully.";
        } else {
            $message = "Please select a valid job reference.";
        }
    }

    if (isset($_POST['update_status'])) {
        $eoiNumber = filter_var(
            $_POST['eoi_id'] ?? '',
            FILTER_VALIDATE_INT
        );
        $status = $_POST['new_status'] ?? '';
        $allowedStatuses = ['New', 'Current', 'Final'];

        if (
            $eoiNumber !== false &&
            $eoiNumber !== null &&
            in_array($status, $allowedStatuses, true)
        ) {
            $sql = "UPDATE eoi SET status = ? WHERE eoi_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$status, $eoiNumber]);
            $message = "EOI status updated successfully.";
        } else {
            $message = "Invalid EOI number or status.";
        }
    }
}

$conditions = [];
$params = [];

if (!empty($_GET['jobref'])) {
    $conditions[] = "jobref = ?";
    $params[] = trim($_GET['jobref']);
}

if (!empty($_GET['firstname'])) {
    $conditions[] = "firstname LIKE ?";
    $params[] = "%" . trim($_GET['firstname']) . "%";
}

if (!empty($_GET['lastname'])) {
    $conditions[] = "lastname LIKE ?";
    $params[] = "%" . trim($_GET['lastname']) . "%";
}

$allowedSortFields = [
    'eoi_id', 'status', 'jobref', 'firstname', 'lastname',
    'birthdate', 'gender', 'town', 'state', 'postalcode',
    'email', 'phone'
];

$sortField = $_GET['sort'] ?? 'eoi_id';

if (!in_array($sortField, $allowedSortFields, true)) {
    $sortField = 'eoi_id';
}

$sortOrder = $_GET['order'] ?? 'ASC';

if (!in_array($sortOrder, ['ASC', 'DESC'], true)) {
    $sortOrder = 'ASC';
}

$sql = "SELECT * FROM eoi";

if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$sql .= " ORDER BY `" . $sortField . "` " . $sortOrder;

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$eois = $stmt->fetchAll(PDO::FETCH_ASSOC);

function clean($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Opentra management dashboard.">
    <title>Opentra | Management</title>
</head>

<body>

<?php include 'includes/header.inc'; ?>

<main>
    <div class="manage-intro">
        <h1>Management Dashboard</h1>
        <p>Welcome, <?php echo clean($_SESSION['username']); ?>!</p>
        <p>Manage Expressions of Interest submitted to Opentra.</p>
        <a class="logout-link" href="logout.php">Logout</a>
    </div>

    <?php if ($message !== ""): ?>
        <p class="manage-message"><?php echo clean($message); ?></p>
    <?php endif; ?>

    <section>
        <h2>Search and Filter EOIs</h2>

        <form class="manage-form" method="get" action="manage.php">
            <div class="form-group">
                <label for="jobref">Job Reference:</label>
                <select name="jobref" id="jobref">
                    <option value="">All Job References</option>
                    <option value="WD101" <?php echo (($_GET['jobref'] ?? '') === 'WD101') ? 'selected' : ''; ?>>
                        WD101
                    </option>
                    <option value="UX202" <?php echo (($_GET['jobref'] ?? '') === 'UX202') ? 'selected' : ''; ?>>
                        UX202
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input
                    type="text"
                    name="firstname"
                    id="firstname"
                    value="<?php echo clean($_GET['firstname'] ?? ''); ?>"
                >
            </div>

            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input
                    type="text"
                    name="lastname"
                    id="lastname"
                    value="<?php echo clean($_GET['lastname'] ?? ''); ?>"
                >
            </div>

            <div class="form-group">
                <label for="sort">Sort Results By:</label>
                <select name="sort" id="sort">
                    <?php foreach ($allowedSortFields as $field): ?>
                        <option
                            value="<?php echo clean($field); ?>"
                            <?php echo ($sortField === $field) ? 'selected' : ''; ?>
                        >
                            <?php echo clean($field); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="order">Sort Order:</label>
                <select name="order" id="order">
                    <option value="ASC" <?php echo ($sortOrder === 'ASC') ? 'selected' : ''; ?>>
                        Ascending
                    </option>
                    <option value="DESC" <?php echo ($sortOrder === 'DESC') ? 'selected' : ''; ?>>
                        Descending
                    </option>
                </select>
            </div>

            <div class="form-buttons">
                <button type="submit">Search EOIs</button>
                <a href="manage.php">Show All EOIs</a>
            </div>
        </form>
    </section>

    <section>
        <h2>EOI Records</h2>
        <p>Total records found: <?php echo count($eois); ?></p>

        <?php if (count($eois) > 0): ?>
            <div class="manage-table-container">
                <table class="manage-table">
                    <thead>
                        <tr>
                            <th>EOI ID</th>
                            <th>Status</th>
                            <th>Job Reference</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Birthdate</th>
                            <th>Gender</th>
                            <th>Street</th>
                            <th>Town</th>
                            <th>State</th>
                            <th>Postal Code</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Skills</th>
                            <th>Update Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($eois as $eoi): ?>
                            <tr>
                                <td><?php echo clean($eoi['eoi_id']); ?></td>
                                <td><?php echo clean($eoi['status']); ?></td>
                                <td><?php echo clean($eoi['jobref']); ?></td>
                                <td><?php echo clean($eoi['firstname']); ?></td>
                                <td><?php echo clean($eoi['lastname']); ?></td>
                                <td><?php echo clean($eoi['birthdate']); ?></td>
                                <td><?php echo clean($eoi['gender']); ?></td>
                                <td><?php echo clean($eoi['street']); ?></td>
                                <td><?php echo clean($eoi['town']); ?></td>
                                <td><?php echo clean($eoi['state']); ?></td>
                                <td><?php echo clean($eoi['postalcode']); ?></td>
                                <td><?php echo clean($eoi['email']); ?></td>
                                <td><?php echo clean($eoi['phone']); ?></td>
                                <td><?php echo clean($eoi['skills']); ?></td>
                                <td>
                                    <form class="status-form" method="post" action="manage.php">
                                        <input
                                            type="hidden"
                                            name="csrf_token"
                                            value="<?php echo clean($_SESSION['csrf_token']); ?>"
                                        >
                                        <input
                                            type="hidden"
                                            name="eoi_id"
                                            value="<?php echo clean($eoi['eoi_id']); ?>"
                                        >
                                        <select name="new_status" aria-label="New status for EOI <?php echo clean($eoi['eoi_id']); ?>">
                                            <option value="New" <?php echo ($eoi['status'] === 'New') ? 'selected' : ''; ?>>New</option>
                                            <option value="Current" <?php echo ($eoi['status'] === 'Current') ? 'selected' : ''; ?>>Current</option>
                                            <option value="Final" <?php echo ($eoi['status'] === 'Final') ? 'selected' : ''; ?>>Final</option>
                                        </select>
                                        <button type="submit" name="update_status" value="1">Update</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No EOI records found.</p>
        <?php endif; ?>
    </section>

    <section>
        <h2>Delete EOIs by Job Reference</h2>
        <p>
            This action permanently deletes all EOIs associated
            with the selected job reference.
        </p>

        <form
            class="manage-form delete-form"
            method="post"
            action="manage.php"
            onsubmit="return confirm('Are you sure you want to delete all EOIs for this job reference?');"
        >
            <input
                type="hidden"
                name="csrf_token"
                value="<?php echo clean($_SESSION['csrf_token']); ?>"
            >

            <div class="form-group">
                <label for="delete_job_ref">Job Reference:</label>
                <select name="delete_job_ref" id="delete_job_ref" required>
                    <option value="">Select Job Reference</option>
                    <option value="WD101">WD101</option>
                    <option value="UX202">UX202</option>
                </select>
            </div>

            <div class="form-buttons">
                <button type="submit" name="delete_eois" value="1">Delete EOIs</button>
            </div>
        </form>
    </section>
</main>

<?php include 'includes/footer.inc'; ?>

</body>
</html>
