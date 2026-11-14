<?php require_once 'settings.php';

$search = "";
$matchingCourses = [];
$noResults = false;

$courseTitles = [
    "course-digital-platforms" => "Digital Learning Platforms Management",
    "course-collaborative-programmes" => "Collaborative Programmes Management",
    "course-digital-tools" => "Digital Tools for Teaching",
    "course-online-course" => "Online Course Design",
    "course-assessment" => "Assessment and Evaluation in Online Learning",
    "course-ai-teachers" => "AI integration in Education",
    "course-foundations" => "Foundations in Digital Skills",
    "course-advanced-digital" => "Advanced Digital Skills",
    "course-ai-students" => "AI in Education"
];

$courseLevels = [
    "course-digital-platforms" => "Advanced",
    "course-collaborative-programmes" => "Intermediate",
    "course-digital-tools" => "Beginner",
    "course-online-course" => "Intermediate",
    "course-assessment" => "Advanced",
    "course-ai-teachers" => "Advanced",
    "course-foundations" => "Beginner",
    "course-advanced-digital" => "Advanced",
    "course-ai-students" => "Intermediate"
];

if (isset($_GET['search'])) {

    $search = trim($_GET['search']);

    if ($search !== "") {

        // Search course titles and difficulty levels
        foreach ($courseTitles as $id => $title) {

            if (
                stripos($title, $search) !== false ||
                stripos($courseLevels[$id], $search) !== false
            ) {
                $matchingCourses[] = $id;
            }
        }

        // If courses are found, jump to the first matching course
        if (!empty($matchingCourses) && !isset($_GET['show'])) {

            $firstCourse = $matchingCourses[0];

            header(
                "Location: index.php?search=" .
                urlencode($search) .
                "&show=1#" . $firstCourse
            );

            exit;
        }

        // If no course matches, search the jobs database
        if (empty($matchingCourses) && !isset($_GET['show'])) {

            $sql = "SELECT job_id FROM jobs
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

            $jobResult = mysqli_stmt_get_result($stmt);

            // Navigate to the first matching job
            if ($job = mysqli_fetch_assoc($jobResult)) {

                header(
                    "Location: jobs.php?search=" .
                    urlencode($search) .
                    "&show=1#job-" . (int)$job['job_id']
                );

                exit;

            } else {

                $noResults = true;
            }

            mysqli_stmt_close($stmt);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Opentra Home Page</title>

    <style>

        #search-box {
            width: 70%;
            max-width: 500px;
            padding: 16px 18px;
            border: none;
            border-radius: 8px 0 0 8px;
            font-size: 15px;
            outline: none;
        }

        .search-highlight {
            background-color: #fff8df !important;
            border: 3px solid #d6a84b !important;
            box-shadow: 0 0 15px rgba(214, 168, 75, 0.5);
            scroll-margin-top: 30px;
        }

        .search-message {
            padding: 20px;
            margin: 20px;
            background-color: #fff8df;
            color: #4d3423;
            border-radius: 8px;
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

<main>

    <?php if ($noResults) { ?>

        <div class="search-message">
            <h2>No Results Found</h2>
            <p>
                Sorry, we couldn't find a matching course or job.
                Please try another search.
            </p>
        </div>

    <?php } ?>

    <section class="description"
        style="background-image: url(style/Banner.png);
        background-size: cover; height:auto;">

        <div class="description-text">

            <h1>Opening Minds Develops the World</h1>

            <p>
                Opentra is an Educational Technology Company that
                develops digital tools to catalyse learning and development.
                Moved by the belief that education is the most powerful weapon,
                and that technology is not the modern day's enemy, but a tool
                to be used to facilitate human evolution, Opentra provides
                platforms and materials to make the learning and teaching process
                more accessible and efficient.
            </p>

            <!-- Unified Search Bar -->

            <form action="index.php" method="get" role="search">

                <br>

                <label id="search-label" for="search-box">
                    Type in your Search query:
                </label>

                <br>

                <input
                    type="search"
                    id="search-box"
                    name="search"
                    placeholder="Search for courses, topics, or jobs..."
                    value="<?php echo htmlspecialchars($search); ?>"
                >

                <button type="submit"
                    style="padding: 16px 28px;
                    border: none;
                    font-size: 15px;
                    cursor: pointer;
                    border-radius: 0 8px 8px 0;
                    transition: 0.3s;
                    background-color: #4d3423;
                    color: #ffffff;">

                    Search

                </button>

            </form>

        </div>

    </section>

    <!-- Courses Section -->

    <section class="courses">

        <h2>Courses</h2>

        <p>
            Opentra offers a wide range of courses to help you
            learn and grow. Explore our courses below:
        </p>

        <br>

        <table>

            <thead>
                <tr>
                    <th>Targeted to</th>
                    <th>Course Name</th>
                    <th>Description</th>
                    <th>Level</th>
                    <th>Duration</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <th rowspan="2">Institutions</th>

                    <td id="course-digital-platforms"
                        class="<?php echo in_array('course-digital-platforms', $matchingCourses) ? 'search-highlight' : ''; ?>">
                        Digital Learning Platforms Management
                    </td>

                    <td>
                        Learn how to effectively manage and implement digital
                        learning platforms in educational institutions.
                    </td>

                    <td>Advanced</td>
                    <td>3 weeks</td>
                </tr>

                <tr>
                    <td id="course-collaborative-programmes"
                        class="<?php echo in_array('course-collaborative-programmes', $matchingCourses) ? 'search-highlight' : ''; ?>">
                        Collaborative Programmes Management
                    </td>

                    <td>
                        Gain skills in managing collaborative educational programs
                        and partnerships.
                    </td>

                    <td>Intermediate</td>
                    <td>2 weeks</td>
                </tr>

                <tr>
                    <th rowspan="4">Teachers</th>

                    <td id="course-digital-tools"
                        class="<?php echo in_array('course-digital-tools', $matchingCourses) ? 'search-highlight' : ''; ?>">
                        Digital Tools for Teaching
                    </td>

                    <td>
                        Discover how to integrate digital tools into your teaching
                        methods for enhanced learning experiences.
                    </td>

                    <td>Beginner</td>
                    <td>1 week</td>
                </tr>

                <tr>
                    <td id="course-online-course"
                        class="<?php echo in_array('course-online-course', $matchingCourses) ? 'search-highlight' : ''; ?>">
                        Online Course Design
                    </td>

                    <td>
                        Learn the principles of designing effective online courses
                        that engage and educate students.
                    </td>

                    <td>Intermediate</td>
                    <td>2 weeks</td>
                </tr>

                <tr>
                    <td id="course-assessment"
                        class="<?php echo in_array('course-assessment', $matchingCourses) ? 'search-highlight' : ''; ?>">
                        Assessment and Evaluation in Online Learning
                    </td>

                    <td>
                        Explore strategies for effectively assessing and evaluating
                        student learning in online environments.
                    </td>

                    <td>Advanced</td>
                    <td>2 weeks</td>
                </tr>

                <tr>
                    <td id="course-ai-teachers"
                        class="<?php echo in_array('course-ai-teachers', $matchingCourses) ? 'search-highlight' : ''; ?>">
                        AI integration in Education
                    </td>

                    <td>
                        Understand how to integrate artificial intelligence into
                        educational settings for improved learning outcomes without
                        promoting plagiarism.
                    </td>

                    <td>Advanced</td>
                    <td>3 weeks</td>
                </tr>

                <tr>
                    <th rowspan="3">Students</th>

                    <td id="course-foundations"
                        class="<?php echo in_array('course-foundations', $matchingCourses) ? 'search-highlight' : ''; ?>">
                        Foundations in Digital Skills
                    </td>

                    <td>
                        Build essential digital skills for academic and
                        professional success.
                    </td>

                    <td>Beginner</td>
                    <td>3 weeks</td>
                </tr>

                <tr>
                    <td id="course-advanced-digital"
                        class="<?php echo in_array('course-advanced-digital', $matchingCourses) ? 'search-highlight' : ''; ?>">
                        Advanced Digital Skills
                    </td>

                    <td>
                        Enhance your digital skills for advanced applications
                        in various fields.
                    </td>

                    <td>Advanced</td>
                    <td>6 weeks</td>
                </tr>

                <tr>
                    <td id="course-ai-students"
                        class="<?php echo in_array('course-ai-students', $matchingCourses) ? 'search-highlight' : ''; ?>">
                        AI in Education
                    </td>

                    <td>
                        Learn how artificial intelligence is transforming education
                        and how to leverage it for learning.
                    </td>

                    <td>Intermediate</td>
                    <td>2 weeks</td>
                </tr>

            </tbody>

        </table>

    </section>

    <!-- Testimonials -->

    <section class="Testimonials">

        <h2>Check out some testimonials</h2>

        <article>
            <p>
                "I noticed a significant improvement on our school's
                results ever since we started implementing Opentra's methods"
                - Esteves Diagonal (Principal)
            </p>
        </article>

        <article>
            <p>
                "The courses provided by Opentra have significantly improved
                my digital skills and prepared me for the modern workforce."
                - Xiluva Nhate (Student)
            </p>
        </article>

        <article>
            <p>
                "I appreciate the practical approach to learning
                and the support from the instructors."
                - Jane Macavel (Student)
            </p>
        </article>

        <article>
            <p>
                "Opentra's platforms have contributed significantly
                to our students' academic results."
                - Dr. Maria Silva (Teacher)
            </p>
        </article>

    </section>

    <!-- Employment Announcements -->

    <section class="Employment-announcements">

        <h2>Want to join our Team?</h2>

        <p>
            Opentra is hiring! Check out our current
            <a href="Jobs.php">job openings</a> and
            <a href="Apply.php">apply</a> to be part of
            the team shaping the future.
        </p>

    </section>

    <!-- Statistics -->

    <section class="Statistics">

        <h2>Our Impact</h2>

        <div>
            <h3>100K+</h3>
            <p>Students Enrolled</p>
        </div>

        <div>
            <h3>50K+</h3>
            <p>Teachers implementing our methods</p>
        </div>

        <div>
            <h3>150+</h3>
            <p>Institutions using our platforms</p>
        </div>

    </section>

</main>

<?php include 'includes/footer.inc'; ?>

<?php mysqli_close($conn);?>

</body>
</html>
