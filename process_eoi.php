<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: Apply.php");
    exit();
}

// Check that the required form fields were submitted
$requiredFields = [
    "jobref",
    "firstname",
    "lastname",
    "birthdate",
    "gender",
    "street",
    "town",
    "state",
    "postalcode",
    "email",
    "phone"
];

$errors = [];

foreach ($requiredFields as $field) {
    if (
        !isset($_POST[$field]) ||
        !is_string($_POST[$field]) ||
        trim($_POST[$field]) === ""
    ) {
        $errors[] = ucfirst($field) . " is required.";
    }
}

//clean input funcation
function cleanInput($value) {
    return trim(stripslashes($value));
}


//collect from data

$jobref = cleanInput($_POST["jobref"]);
$firstname = cleanInput($_POST["firstname"]);
$lastname = cleanInput($_POST["lastname"]);
$birthdate = cleanInput($_POST["birthdate"]);
$gender = cleanInput($_POST["gender"]);
$street = cleanInput($_POST["street"]);
$town = cleanInput($_POST["town"]);
$state = cleanInput($_POST["state"]);
$postalcode = cleanInput($_POST["postalcode"]);
$email = cleanInput($_POST["email"]);
$phone = cleanInput($_POST["phone"]);

$errors = [];


//VALIDATION Recheck always recheck here

// Job reference
$validJobRefs = ["WD101", "UX202"];

if (!in_array($jobref, $validJobRefs, true)) {
    $errors[] = "Please select a valid job reference.";
}


// First name
if (
    $firstname === "" ||
    strlen($firstname) > 50 ||
    !preg_match("/^[A-Za-z ]+$/", $firstname)
) {
    $errors[] = "Please enter a valid first name.";
}


// Last name
if (
    $lastname === "" ||
    strlen($lastname) > 50 ||
    !preg_match("/^[A-Za-z ]+$/", $lastname)
) {
    $errors[] = "Please enter a valid last name.";
}


// Birthdate: dd/mm/yyyy to yyyy-mm-dd
$date = DateTime::createFromFormat("!d/m/Y", $birthdate);
$dateErrors = DateTime::getLastErrors();

if (
    !$date ||
    ($dateErrors !== false &&
        ($dateErrors["warning_count"] > 0 ||
         $dateErrors["error_count"] > 0)) ||
    $date->format("d/m/Y") !== $birthdate ||
    $date > new DateTime("today")
) {
    $errors[] = "Please enter a valid birthdate in dd/mm/yyyy format.";
} else {
    // Convert into MySQL DATE format
    $birthdate = $date->format("Y-m-d");
}


// Gender
$validGenders = [
    "Female",
    "Male",
    "Other",
    "Prefer not to say"
];

if (!in_array($gender, $validGenders, true)) {
    $errors[] = "Please select a valid gender.";
}


// Street
if ($street === "" || strlen($street) > 100) {
    $errors[] = "Please enter a valid street address.";
}


// Town
if ($town === "" || strlen($town) > 50) {
    $errors[] = "Please enter a valid town or suburb.";
}


// State
$validStates = [
    "VIC",
    "NSW",
    "QLD",
    "NT",
    "WA",
    "SA",
    "TAS",
    "ACT"
];

if (!in_array($state, $validStates, true)) {
    $errors[] = "Please select a valid state.";
}


// Postcode
if (!preg_match("/^[0-9]{1,4}$/", $postalcode)) {
    $errors[] = "Please enter a valid postcode containing a maximum of 4 digits.";
}


// Email
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 100) {
    $errors[] = "Please enter a valid email address.";
}


// Phone
if (!preg_match("/^[0-9]{8,12}$/", $phone)) {
    $errors[] = "Please enter a valid phone number containing 8 to 12 digits.";
}

$validSkills = [
    "HTML",
    "CSS",
    "Web Development",
    "UI Design",
    "UX Design",
    "Communication"
];

$selectedSkills = [];

if (!isset($_POST["skills"]) || !is_array($_POST["skills"])) {
    $errors[] = "Please select at least one skill.";
} else {
    foreach ($_POST["skills"] as $skill) {
        if (!is_string($skill) || !in_array($skill, $validSkills, true)) {
            $errors[] = "Please select valid skills.";
            break;
        }

        $selectedSkills[] = $skill;
    }

    if (empty($selectedSkills)) {
        $errors[] = "Please select at least one skill.";
    }
}


// Other skills
$otherSkills = "";

if (isset($_POST["other_skills"])) {
    if (!is_string($_POST["other_skills"])) {
        $errors[] = "Invalid additional skills submission.";
    } else {
        $otherSkills = cleanInput($_POST["other_skills"]);

        if (strlen($otherSkills) > 1000) {
            $errors[] = "Additional skills must not exceed 1000 characters.";
        }
    }
}


// Soft skills
$softSkills = "";

if (isset($_POST["soft_skills"])) {
    if (!is_string($_POST["soft_skills"])) {
        $errors[] = "Invalid soft skills submission.";
    } else {
        $softSkills = cleanInput($_POST["soft_skills"]);

        if (strlen($softSkills) > 1000) {
            $errors[] = "Soft skills must not exceed 1000 characters.";
        }
    }
}

//Combining all skills into one col

$allSkills = [];

if (!empty($selectedSkills)) {
    $allSkills[] = "Selected Skills: " . implode(", ", $selectedSkills);
}

if ($otherSkills !== "") {
    $allSkills[] = "Other Skills: " . $otherSkills;
}

if ($softSkills !== "") {
    $allSkills[] = "Soft Skills: " . $softSkills;
}

$skills = implode(" | ", $allSkills);

//connecting w8 database
require_once("settings.php");

// Create table if it doesn't exist btw

$createTable = "CREATE TABLE IF NOT EXISTS eoi (
    eoi_id INT AUTO_INCREMENT PRIMARY KEY,
    status ENUM('New', 'Current', 'Final') DEFAULT 'New',
    jobref ENUM('WD101', 'UX202'),
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    birthdate DATE,
    gender ENUM('Female', 'Male', 'Other', 'Prefer not to say'),
    street VARCHAR(100),
    town VARCHAR(50),
    state TEXT,
    postalcode VARCHAR(6),
    email VARCHAR(100),
    phone VARCHAR(12),
    skills TEXT
)";

if (!mysqli_query($conn, $createTable)) {
    $errors[] = "There was a database error. Please try again later.";
}


//insert that application form into db

$eoiNumber = null;

if (empty($errors)) {

    $sql = "INSERT INTO eoi (
        jobref,
        firstname,
        lastname,
        birthdate,
        gender,
        street,
        town,
        state,
        postalcode,
        email,
        phone,
        skills
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {

        mysqli_stmt_bind_param(
            $stmt,
            "ssssssssssss",
            $jobref,
            $firstname,
            $lastname,
            $birthdate,
            $gender,
            $street,
            $town,
            $state,
            $postalcode,
            $email,
            $phone,
            $skills
        );

        if (mysqli_stmt_execute($stmt)) {

            // Retrieve automatically generated EOI number
            $eoiNumber = mysqli_insert_id($conn);

        } else {
            $errors[] = "Your application could not be submitted. Please try again.";
        }

        mysqli_stmt_close($stmt);

    } else {
        $errors[] = "There was a database error. Please try again later.";
    }
}


mysqli_close($conn);


//showing result

include("includes/header.inc"); ?>

<main class="application-result">

    <?php if (!empty($errors)) { ?>

        <section class="result-message error-message">

            <h1>Application Not Submitted</h1>

            <p>Please correct the following issues:</p>

            <ul>
                <?php foreach ($errors as $error) { ?>
                    <li>
                        <?php echo htmlspecialchars($error, ENT_QUOTES, "UTF-8"); ?>
                    </li>
                <?php } ?>
            </ul>

            <a href="Apply.php">Return to Application Form</a>

        </section>

    <?php } else { ?>

        <section class="result-message success-message">

            <h1>Application Submitted Successfully!</h1>

            <p>Thank you for applying to Opentra.</p>

            <p>
                Your application has been successfully recorded.
            </p>

            <p>
                <strong>Your EOI Number:</strong>

                <?php
                echo htmlspecialchars((string)$eoiNumber, ENT_QUOTES, "UTF-8");
                ?>
            </p>

            <a href="index.php">Return to Home Page</a>

        </section>

    <?php } ?>

</main>

<?php include("includes/footer.inc"); ?>
