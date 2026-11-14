<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Apply for a position at Opentra.">

    <title>Opentra | Apply</title>

    <style>
        .application-intro {
            text-align: center;
            margin-bottom: 25px;
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>

    <?php include 'includes/header.inc'; ?>

    <main>
        <section class="application-intro">
            <h1>Job Application</h1>
            <p>
                Interested in joining Opentra?
                Complete the application form below.
            </p>
        </section>

        <form class="application-form"
              method="post"
              action="process_eoi.php"
              novalidate>

            <fieldset>
                <legend>Job Information</legend>

                <div class="form-group">
                    <label for="job-reference">Job Reference Number *</label>

                    <select id="job-reference" name="jobref" required>
                        <option value="">Select a Job Reference Number</option>
                        <option value="WD101">WD101</option>
                        <option value="UX202">UX202</option>
                    </select>
                </div>
            </fieldset>

            <fieldset>
                <legend>Personal Information</legend>

                <div class="form-group">
                    <label for="first-name">First Name *</label>

                    <input
                        type="text"
                        id="first-name"
                        name="firstname"
                        maxlength="50"
                        placeholder="First name">
                </div>

                <div class="form-group">
                    <label for="last-name">Last Name *</label>

                    <input
                        type="text"
                        id="last-name"
                        name="lastname"
                        maxlength="50"
                        placeholder="Last name">
                </div>

                <div class="form-group">
                    <label for="dob">Date of Birth *</label>

                    <input
                        type="text"
                        id="dob"
                        name="birthdate"
                        placeholder="dd/mm/yyyy">
                </div>

                <fieldset class="gender-fieldset">
                    <legend>Gender *</legend>

                    <label>
                        <input
                            type="radio"
                            name="gender"
                            value="Female">
                        Female
                    </label>

                    <label>
                        <input
                            type="radio"
                            name="gender"
                            value="Male">
                        Male
                    </label>

                    <label>
                        <input
                            type="radio"
                            name="gender"
                            value="Other">
                        Other
                    </label>

                    <label>
                        <input
                            type="radio"
                            name="gender"
                            value="Prefer not to say">
                        Prefer not to say
                    </label>
                </fieldset>
            </fieldset>

            <fieldset>
                <legend>Contact Information *</legend>

                <div class="form-group">
                    <label for="street">Street Address *</label>

                    <input
                        type="text"
                        id="street"
                        name="street"
                        maxlength="100"
                        placeholder="Enter a valid street address">
                </div>

                <div class="form-group">
                    <label for="suburb">Suburb / Town *</label>

                    <input
                        type="text"
                        id="suburb"
                        name="town"
                        maxlength="50"
                        placeholder="Suburb or town">
                </div>

                <div class="form-group">
                    <label for="state">State *</label>

                    <select id="state" name="state">
                        <option value="">Select a state</option>
                        <option value="VIC">VIC</option>
                        <option value="NSW">NSW</option>
                        <option value="QLD">QLD</option>
                        <option value="NT">NT</option>
                        <option value="WA">WA</option>
                        <option value="SA">SA</option>
                        <option value="TAS">TAS</option>
                        <option value="ACT">ACT</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="postcode">Postcode *</label>

                    <input
                        type="text"
                        id="postcode"
                        name="postalcode"
                        maxlength="4"
                        maxlength="4" 
                        pattern="[0-9]{1,4}"
                        inputmode="numeric"
                        placeholder="0000">
                </div>

                <div class="form-group">
                    <label for="email">Email Address *</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="example@email.com">
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number *</label>

                    <input
                        type="tel"
                        id="phone"
                        name="phone"
                        minlength="8" 
                        maxlength="12"
                        pattern="[0-9]{8,12}"
                        inputmode="numeric"
                        placeholder="Phone number">
                </div>
            </fieldset>

            <fieldset>
                <legend>Skills</legend>

                <p>
                    Select the skills that apply to you:
                </p>

                <div class="checkbox-group">

                    <label>
                        <input type="checkbox" name="skills[]" value="HTML">
                        HTML
                    </label>

                    <label>
                        <input type="checkbox" name="skills[]" value="CSS">
                        CSS
                    </label>

                    <label>
                        <input type="checkbox" name="skills[]" value="Web Development">
                        Web Development
                    </label>

                    <label>
                        <input type="checkbox" name="skills[]" value="UI Design">
                        UI Design
                    </label>

                    <label>
                        <input type="checkbox" name="skills[]" value="UX Design">
                        UX Design
                    </label>

                    <label>
                        <input type="checkbox" name="skills[]" value="Communication">
                        Communication
                    </label>

                </div>

                <div class="form-group">
                    <label for="other-skills">Other Skills</label>

                    <textarea
                        id="other-skills"
                        name="other_skills"
                        rows="6"
                        placeholder="Tell us about any other relevant skills..."></textarea>
                </div>

                <div class="form-group">
                    <label for="Soft-skills">Soft-skills</label>

                    <textarea
                        id="Soft-skills"
                        name="soft_skills"
                        rows="6"
                        placeholder="Tell us a little more about your soft-skills here...."></textarea>
                </div>

            </fieldset>

            <div class="form-buttons">
                <button type="submit">Submit Application</button>
                <button type="reset">Reset Form</button>
            </div>

        </form>

    </main>

    <?php include 'includes/footer.inc'; ?>

</body>
</html>
