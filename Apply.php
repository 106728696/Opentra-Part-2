<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Apply for a position at Opentra.">

    <title>Opentra | Apply</title>

    <link href="style/Styling.css" rel="stylesheet">
    <style> 
        .application-intro {
            text-align: center;
            margin-bottom: 25px;
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>

<header>
        <div class="Brand">
            <a href = "index.html"> <img src="style/FullLogo1.png" alt="Opentra Logo" style="width: 15%;"> </a>
            <p> Opening minds develops the World </p> <!-- Slogan -->
        </div>  
        <nav>
            <a href = "index.html"> Home </a>
            <a href = "Jobs.html"> Jobs </a>
            <a href = "Apply.html"> Apply </a>
            <a href = "About.html"> About </a>
        </nav>
        <hr>
</header>

<main>
    <section class="application-intro">
        <h1>Job Application</h1>
        <p>
            Interested in joining Opentra?
            Complete the application form below.
        </p>

    </section>

    <form class="application-form"
          method="post" action="https://mercury.swin.edu.au/it000000/formtest.php">

        <fieldset>
            <legend>Job Information</legend>
            <div class="form-group">

                <label for="job-reference" >Job Reference Number*
                    <span class="required"></span>
                </label>
                <select id="job-reference" name="job-reference" required>
                    
                    <option value="-">
                        Select a Job Reference Number
                    </option>

                    <option value="WD101">
                        WD101
                    </option>

                    <option value="UX202">
                        UX202
                    </option>
                </select>
            </div>

        </fieldset>

        <fieldset>
            <legend>Personal Information</legend>
            <div class="form-group">

                <label for="first-name"> First Name *</label>
                <input
                    type="text"
                    id="first-name"
                    name="first-name"
                    maxlength="20"
                    pattern="[A-Za-z ]+"
                    required
                    title="No more than 20 characters."
                    placeholder="First name">
            </div>

            <div class="form-group">
                <label for="last-name"> Last Name *</label>
                <input
                    type="text"
                    id="last-name"
                    name="last-name"
                    maxlength="20"
                    pattern="[A-Za-z ]+"
                    required
                    title="No more than 20 characters."
                    placeholder="Last name">

            </div>

            <div class="form-group">
                <label for="dob">Date of Birth *</label>
                    <input
                        type="text"
                        id="dob"
                        name="dob"
                        placeholder="dd/mm/yyyy"
                        pattern="(0[1-9]|1[0-9]|2[0-8])/(0[1-9]|1[0-2])/(196[6-9]|19[7-9][0-9]|200[0-8])|29/(0[13-9]|1[0-2])/(196[6-9]|19[7-9][0-9]|200[0-8])|30/(0[13-9]|1[0-2])/(196[6-9]|19[7-9][0-9]|200[0-8])|31/(01|03|05|07|08|10|12)/(196[6-9]|19[7-9][0-9]|200[0-8])|29/02/(1968|1972|1976|1980|1984|1988|1992|1996|2000|2004|2008)"
                        required
                        title="Enter a valid date of birth in dd/mm/yyyy format.">
            </div>

            <fieldset class="gender-fieldset">
                <legend>Gender *</legend>
                <label>
                    <input
                        type="radio"
                        name="gender"
                        value="female"
                        required>
                    Female
                </label>

                <label>
                    <input
                        type="radio"
                        name="gender"
                        value="male">
                    Male
                </label>

                <label>
                    <input
                        type="radio"
                        name="gender"
                        value="other">
                    Other
                </label>

                <label>
                    <input
                        type="radio"
                        name="gender"
                        value="prefer-not-to-say">
                    Prefer not to say
                </label>
            </fieldset>
        </fieldset>


        <fieldset>

            <legend>Contact Information *</legend>
            <div class="form-group">
                <label for="street"> Street Address *</label>
                <input
                    type="text"
                    id="street"
                    name="street"
                    minlength="5"
                    maxlength="40"
                    pattern="[A-Za-z0-9 ,.'/-]+"
                    placeholder="Enter a valid street address"
                    required>

            </div>

            <div class="form-group">
                <label for="suburb"> Suburb / Town *</label>
                <input 
                    type="text"
                    id="suburb"
                    name="suburb"
                    maxlength="40"
                    pattern="[A-Za-z0-9 ,.'/-]+"
                    required
                    placeholder="Suburb or town">

            </div>

            <div class="form-group">

                <label for="state"> State *</label>
                <select required>

                    <option value=""> Select a state</option>
                    <option value="VIC"> VIC </option>
                    <option value="NSW"> NSW </option>
                    <option value="QLD"> QLD </option>
                    <option value="NT"> NT </option>
                    <option value="WA"> WA </option>
                    <option value="SA"> SA </option>
                    <option value="TAS"> TAS </option>
                    <option value="ACT"> ACT </option>
                </select>
            </div>

            <div class="form-group">

                <label for="postcode"> Postcode *</label>
                <input
                    type="text"
                    id="postcode"
                    name="postcode"
                    pattern="[0-9]{4}"
                    maxlength="4"
                    required
                    title="Postcode must be exactly 4 digits."
                    placeholder="0000">
            </div>

            <div class="form-group">

                <label for="email"> Email Address *</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    placeholder="example@email.com">
            </div>

            <div class="form-group">
                <label for="phone"> Phone Number *</label>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    pattern="[0-9]{8,12}"
                    minlength="8"
                    maxlength="12"
                    required
                    title="Phone number must contain 8 to 12 digits."
                    placeholder="Phone number">
            </div>
        </fieldset>

        <fieldset>
            <legend>Skills</legend>
            <p>
                Select the skills that apply to you:
            </p>

            <div class="checkbox-group" >
                <label>
                    <input type="checkbox" name="skills" value="html"> HTML
                </label>

                <label>
                    <input type="checkbox" name="skills" value="css"> CSS
                </label>

                <label>
                    <input type="checkbox" name="skills" value="web-development"> Web Development
                </label>

                <label>
                    <input type="checkbox" name="skills" value="ui-design"> UI Design
                </label>

                <label>
                    <input type="checkbox" name="skills" value="ux-design"> UX Design
                </label>

                <label>
                    <input type="checkbox" name="skills" value="communication"> Communication
                </label>

            </div>

            <div class="form-group">
                <label for="other-skills"> Other Skills </label>

                <textarea
                    id="other-skills"
                    name="other-skills"
                    rows="6"
                    placeholder="Tell us about any other relevant skills..."></textarea>
            </div>
            
            <div class="form-group">
                <label for = "Soft-skills"> Soft-skills </label>

                <textarea
                    id = "Soft-skills"
                    name = "Soft-skills"
                    rows="6"
                    placeholder="Tell us a little more about your soft-skills here...."></textarea>

            </div>

        </fieldset>

        <div class="form-buttons">
            <button type="submit"> Submit Application </button>
            <button type="reset"> Reset Form </button>
        </div>

    </form>

</main>

<footer>
        <nav class="footer-nav">
            <a href = "index.html"> Home </a>
            <a href = "Jobs.html"> Jobs </a>
            <a href = "Apply.html"> Apply </a>
            <a href = "About.html"> About </a>
        </nav>

        <div class="footer-links">
            <p>
                <a href="https://github.com/106728696/Opentra-COS10026-WebTechProject-.git" target="_blank"> Our GitHub Repository </a> | 
                <a href="https://webprojectcos10026group4.atlassian.net/jira/software/projects/SCRUM/boards/1?filter=assignee%20%3D%20712020%3A55e128ab-8704-4aef-9166-c0e524ca37be&groupBy=none" target="_blank"> Our Jira </a> | 
                <a href="mailto:info@opentra.com"> Email us: info@opentra.com </a>
            </p>
        </div>
            <p> Group: Opentra | G04 </p>
            <p>&copy; 2026 Opentra. All rights reserved.</p>
        </div>
</footer>

</body>
</html>
