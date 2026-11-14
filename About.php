<?php
require_once 'settings.php';
$result = mysqli_query($conn, "SELECT * FROM about ORDER BY member_id");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>About Us | Opentra</title>

    <link href="style/Styling.css" rel="stylesheet">

    <style>
        .current-page {
            font-weight: bold;
        }
    </style>
</head>

<body>
    
     <?php include 'includes/header.inc'; ?>     
    
    <main>
        <section class="about-intro">
            <p style="letter-spacing: 2px;">MEET THE TEAM</p>

            <h1>About Our Team</h1>

            <p>
                We are the Opentra team, working together to build an
                accessible and responsive recruitment website using
                HTML5 and CSS3.
            </p>

        </section>

        <section>
            <h2>Group Information</h2>
            <ul class="group-info">
                <li>
                    <strong>Group Name:</strong> Opentra
                    <ul>
                        <li>
                            <strong>Class Days:</strong>
                            Monday and Thursday
                        </li>
                        <li>
                            <strong>Class Time:</strong>
                            2:00 PM - 4:00 PM
                        </li>
                    </ul>
                </li>
            </ul>
        </section>

       <section class="team-section">
    <h2>Our Team</h2>

    <figure class="team-photo">
        <img
            src="pictures/GroupPicture.png"
            alt="Members of the Opentra project team"
        >
        <figcaption>
            The Opentra team working together on the Applied Web Project.
        </figcaption>
    </figure>

    <div class="team-members">
<?php while ($member = mysqli_fetch_assoc($result)) { ?>

    <article class="team-member">
        <img src="<?php echo $member['photo']; ?>"
             alt="<?php echo $member['full_name']; ?>"
             class="member-photo">

        <h3><?php echo $member['full_name']; ?></h3>

        <p class="student-id">Student ID: <?php echo $member['student_id']; ?></p>

        <p><?php echo $member['role']; ?></p>

        <h4>Project 1</h4>
        <ul>
            <?php foreach (explode("\n", $member['project1_contributions']) as $item) { ?>
                <li><?php echo $item; ?></li>
            <?php } ?>
        </ul>

        <h4>Project 2</h4>
        <ul>
            <?php foreach (explode("\n", $member['project2_contributions']) as $item) { ?>
                <li><?php echo $item; ?></li>
            <?php } ?>
        </ul>
    </article>

<?php } ?>
        
    </div>
</section>

        <section>
            <h2>Words From Our Team</h2>
            <dl class="quotes">
                <dt>Jia Yu Tan</dt>
                <dd>
                    <blockquote lang="en">
                        “I love cats.”
                    </blockquote>
                    <p>
                        <strong>English:</strong>
                        I love cats.
                    </p>
                </dd>
                <dt>Milikely Wendy Santaca Matuce</dt>
                <dd>
                    <blockquote lang="pt">
                        “Água mole em pedra dura, tanto bate até que fura.”
                    </blockquote>
                    <p>
                        <strong>English:</strong>
                        Constant dripping wears away the stone.
                    </p>
                </dd>
                <dt>Yati Myat Aye</dt>
                <dd>
                    <blockquote lang="my">
                        “ကိစ္စတစ်ခုက မဖြစ်နိုင်တဲ့အရာဖြစ်နေရင်တောင် ကြိုးစားကြည့်ပါ”
                    </blockquote>
                    <p>
                        <strong>English:</strong>
                        Attempt the impossible.
                    </p>
                </dd>
                <dt>Abdullah Al Shafayet Sporsho</dt>

                <dd>
                    <blockquote lang="bn">
                        “একসাথে কাজ করলে কঠিন কাজও সহজ হয়ে যায়।”
                    </blockquote>
                    <p>
                        <strong>English:</strong>
                        Working together makes difficult tasks easier.
                    </p>
                </dd>
            </dl>
        </section>

        <section>
            <h2>Team Fun Facts</h2>
            <div class="table-container">
                <table class="fun-facts">
                    <caption>
                        A few fun facts about the Opentra team
                    </caption>
                    <thead>
                        <tr>
                            <th scope="col">Member</th>
                            <th scope="col">Dream Job</th>
                            <th scope="col">Favourite Snack</th>
                            <th scope="col">Hometown</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Jia Yu Tan</td>
                            <td>UX/UI Designer</td>
                            <td>Ice-cream</td>
                            <td>Shah Alam</td>
                        </tr>
                        <tr>
                            <td>Milikely Wendy Santaca Matuce</td>
                            <td>Software Engineer</td>
                            <td>Cheesecake</td>
                            <td>Maputo</td>
                        </tr>
                        <tr>
                            <td>Yati Myat Aye</td>
                            <td>Front-End Developer</td>
                            <td>Grape Milk Soda</td>
                            <td>Yangon</td>
                        </tr>
                        <tr>
                            <td>Abdullah Al Shafayet Sporsho</td>
                            <td>Web Developer</td>
                            <td>Gummy Bears</td>
                            <td>Dhaka</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="acknowledgement">
    <h2>Acknowledgement of Country</h2>

    <p>
        Opentra acknowledges the Traditional Custodians of the lands on which
        we study, work and create. We pay our respects to Aboriginal and
        Torres Strait Islander peoples, their cultures, and their Elders
        past and present.
    </p>
</section>
    </main>
     <?php include 'includes/footer.inc'; ?>     
<?php mysqli_close($conn); ?>