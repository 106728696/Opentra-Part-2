<?php require_once 'settings.php';

$search = "";

if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
}

if ($search !== "") {

    $sql = "SELECT * FROM jobs
            WHERE job_ref LIKE ?
            OR job_title LIKE ?
            OR job_description LIKE ?
            ORDER BY job_id";

    $stmt = mysqli_prepare($conn, $sql);

    $keyword = "%" . $search . "%";

    mysqli_stmt_bind_param(
        $stmt,
        "sss",
        $keyword,
        $keyword,
        $keyword
    );

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

} else {

    $sql = "SELECT * FROM jobs ORDER BY job_id";
    $result = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Jobs at Opentra">
    <meta name="author" content="Opentra">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Jobs - Opentra</title>

    <link href="style/Styling.css" rel="stylesheet">

    <style>
        {
             .search-form input {
            padding: 12px;
            width: 250px;
            max-width: 65%;
            font: inherit;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
        }

        .search-form input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-soft);
        }

        .search-form button {
            padding: 12px 20px;
            font: inherit;
            font-weight: 600;
            color: #ffffff;
            background-color: var(--primary);
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .search-form button:hover {
            background-color: var(--primary-dark);
        }

        .search-form a {
            margin-left: 8px;
            font-size: 0.9rem;
        }
        .job-page section.search-highlight {
            border: 2px solid var(--accent);
            background-color: #fffdf8;
            box-shadow: 0 0 12px rgba(184, 153, 111, 0.2);
            scroll-margin-top: 100px;
        }
    </style>
</head>

<body>

<header>

    <div class="Brand">
        <a href="index.php">
            <img src="style/FullLogo1.png"
                 alt="Opentra Logo" style="width: 15%;">
        </a>

        <p>Opening minds develops the World</p>
    </div>

    <?php include 'includes/navigation.inc'; ?>

</header>

<main class="job-page">

    <aside>
        <h2>Why Work With Us?</h2>

        <ul>
            <li>Friendly team</li>
            <li>Learn new skills</li>
            <li>Flexible workplace</li>
            <li>Meaningful EdTech projects</li>
        </ul>
    </aside>

    <h2>Job Opportunities</h2>

    <p>
        Join Opentra and help us create better digital learning experiences.
    </p>

    <!-- Shared website search -->
    <form method="GET" action="index.php" class="search-form">

        <input
            type="search"
            name="search"
            placeholder="Search for courses or jobs..."
            value="<?php echo htmlspecialchars($search); ?>"
        >

        <button type="submit">Search</button>

        <a href="jobs.php">Show All Jobs</a>

    </form>

    <?php if (mysqli_num_rows($result) > 0) { ?>

        <?php while ($job = mysqli_fetch_assoc($result)) { ?>

            <section
                class="job-card <?php echo $search !== '' ? 'search-highlight' : ''; ?>"
                id="job-<?php echo (int)$job['job_id']; ?>"
            >

                <h3>
                    <?php echo htmlspecialchars($job['job_title']); ?>
                </h3>

                <p>
                    <strong>Reference:</strong>
                    <?php echo htmlspecialchars($job['job_ref']); ?>
                </p>

                <p>
                    <?php echo htmlspecialchars($job['job_description']); ?>
                </p>

                <p>
                    <strong>Salary:</strong>
                    <?php echo htmlspecialchars($job['salary']); ?>
                </p>

                <p>
                    <strong>Reports to:</strong>
                    <?php echo htmlspecialchars($job['reports_to']); ?>
                </p>

                <h4>Responsibilities</h4>

                <ol>
                    <?php
                    $responsibilities = explode("\n", $job['responsibilities']);

                    foreach ($responsibilities as $item) {
                        if (trim($item) !== "") {
                    ?>
                        <li><?php echo htmlspecialchars(trim($item)); ?></li>
                    <?php
                        }
                    }
                    ?>
                </ol>

                <h4>Essential Requirements</h4>

                <ul>
                    <?php
                    $essential = explode("\n", $job['essential_requirements']);

                    foreach ($essential as $item) {
                        if (trim($item) !== "") {
                    ?>
                        <li><?php echo htmlspecialchars(trim($item)); ?></li>
                    <?php
                        }
                    }
                    ?>
                </ul>

                <h4>Preferable Requirements</h4>

                <ul>
                    <?php
                    $preferable = explode("\n", $job['preferable_requirements']);

                    foreach ($preferable as $item) {
                        if (trim($item) !== "") {
                    ?>
                        <li><?php echo htmlspecialchars(trim($item)); ?></li>
                    <?php
                        }
                    }
                    ?>
                </ul>

                <p>
                    <a href="Apply.php">Apply for this position</a>
                </p>

            </section>

        <?php } ?>

    <?php } else { ?>

        <p>No jobs found. Please try another search.</p>

    <?php } ?>

    <p style="text-align:center; clear:both;">
        <strong>
            Interested in joining Opentra? Visit our Apply page.
            <a href="Apply.php">Apply here</a>.
        </strong>
    </p>

</main>

<?php include 'includes/footer.inc'; ?>

<?php mysqli_close($conn); ?>

</body>
</html>
