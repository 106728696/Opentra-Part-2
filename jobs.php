<?php
require_once 'settings.php';

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
    <title>Jobs - Opentra</title>

    <link href="style/Styling.css" rel="stylesheet">

    <style>
        main {
            padding: 20px;
        }

        aside {
            float: right;
            width: 20%;
            margin: 10px;
            padding: 15px;
            border: 1px solid black;
            box-sizing: border-box;
        }

        section {
            display: inline-block;
            vertical-align: top;
            width: 34%;
            margin: 10px;
            padding: 15px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
    </style>
</head>

<body>

<header>
    <div class="Brand">
        <a href="index.html">
            <img src="style/FullLogo1.png" alt="Opentra Logo" style="width: 15%;">
        </a>
        <p>Opening minds develops the World</p>
    </div>

    <nav>
        <a href="index.html">Home</a>
        <a href="jobs.php">Jobs</a>
        <a href="Apply.html">Apply</a>
        <a href="About.html">About</a>
    </nav>

    <hr>
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

    <!-- Job Search -->
    <form method="GET" action="jobs.php">
        <input
            type="text"
            name="search"
            placeholder="Search jobs..."
            value="<?php echo htmlspecialchars($search); ?>"
        >
        <button type="submit">Search</button>
        <a href="jobs.php">Show All Jobs</a>
    </form>

    <!-- Display Jobs from Database -->
    <?php if (mysqli_num_rows($result) > 0) { ?>

        <?php while ($job = mysqli_fetch_assoc($result)) { ?>

            <section>

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
                    ?>
                        <li><?php echo htmlspecialchars($item); ?></li>
                    <?php } ?>
                </ol>

                <h4>Essential Requirements</h4>
                <ul>
                    <?php
                    $essential = explode("\n", $job['essential_requirements']);

                    foreach ($essential as $item) {
                    ?>
                        <li><?php echo htmlspecialchars($item); ?></li>
                    <?php } ?>
                </ul>

                <h4>Preferable Requirements</h4>
                <ul>
                    <?php
                    $preferable = explode("\n", $job['preferable_requirements']);

                    foreach ($preferable as $item) {
                    ?>
                        <li><?php echo htmlspecialchars($item); ?></li>
                    <?php } ?>
                </ul>

            </section>

        <?php } ?>

    <?php } else { ?>

        <p>No jobs found. Please try another search.</p>

    <?php } ?>

    <p style="text-align:center; clear:both;">
        <strong>
            Interested in joining Opentra? Visit our Apply page.
        </strong>
    </p>

</main>

<footer>

    <nav class="footer-nav">
        <a href="index.html">Home</a>
        <a href="jobs.php">Jobs</a>
        <a href="Apply.html">Apply</a>
        <a href="About.html">About</a>
    </nav>

    <div class="footer-links">
        <p>
            <a href="https://github.com/106728696/Opentra-COS10026-WebTechProject-.git" target="_blank">
                Our GitHub Repository
            </a> |

            <a href="https://webprojectcos10026group4.atlassian.net/jira/software/projects/SCRUM/boards/1?filter=assignee%20%3D%20712020%3A55e128ab-8704-4aef-9166-c0e524ca37be&groupBy=none" target="_blank">
                Our Jira
            </a> |

            <a href="mailto:info@opentra.com">
                Email us: info@opentra.com
            </a>
        </p>
    </div>

    <p>Group: Opentra | G04</p>
    <p>&copy; 2026 Opentra. All rights reserved.</p>

</footer>

</body>
</html>

<?php
mysqli_close($conn);
?>
