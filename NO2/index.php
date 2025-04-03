<?php
date_default_timezone_set('Asia/Jakarta');
$tanggal = date('d-m-Y');
$jam = date('H:i:s');

setcookie('waktu[hari]', $tanggal, time() + 3600);
setcookie('waktu[jam]', $jam, time() + 3600);
setcookie('visit_count', isset($_COOKIE['visit_count']) ? $_COOKIE['visit_count'] + 1 : 1, time() + 3600, "/");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <main id="main">
            <div class="main-logo">
                <img src="assets/icon-x.svg" alt="logo">
            </div>

            <div class="main-action">
                <div class="main-action-text">
                    <h1>Happening now</h1>
                    <h2>Join today.</h2>
                </div>
                <div class="main-action-button">
                    <button>
                        <img src="assets/google-color-svgrepo-com.svg" alt="google">
                        Sign in with Google
                    </button>
                    <button>
                        <img src="assets/apple-173-svgrepo-com.svg" alt="apple">
                        Sign in with Apple
                    </button><br>
                    <button id="btn-create-account">
                        Create account
                    </button>
                    <p>By signing up, you agree to the <a>Terms of Service</a> and <a>Privacy Policy</a>, including
                        <a>Cookie Use.</a>
                    </p>
                    <br>
                    <h4>Already have an account?</h4>
                    <button id="btn-sign-in">
                        Sign in
                    </button>
                </div>
            </div>
        </main>

        <footer>
            <div class="footer-link">
                <a href="https://about.x.com/en">About</a>
                <a href="https://help.x.com/en/using-x/download-the-x-app">Download the X app</a>
                <a href="https://help.x.com/en">Help Center</a>
                <a href="https://x.com/en/tos">Terms of Service</a>
                <a href="https://x.com/en/privacy">Privacy Policy</a>
                <a href="https://help.x.com/en/rules-and-policies/x-cookies">Cookie Policy</a>
                <a href="https://help.x.com/en/resources/accessibility">Accessibility</a>
                <a href="https://business.x.com/en/help/troubleshooting/how-x-ads-work">Ads info</a>
                <a href="https://blog.x.com/">Blog</a>
                <a href="https://careers.x.com/en">Careers</a>
                <a href="https://about.x.com/en/who-we-are/brand-toolkit">Brand Resource</a>
                <a href="https://business.x.com/en/advertising?ref=gl-tw-tw-twitter-advertise">Advertising</a>
                <a href="https://business.x.com/en">Marketing</a>
                <a
                    href="https://business.x.com/en?ref=web-twc-ao-gbl-twitterforbusiness&utm_source=twc&utm_medium=web&utm_campaign=ao&utm_content=twitterforbusiness">X
                    for Business</a>
                <a href="https://developer.x.com/en">Developers</a>
                <a href="https://x.com/i/directory/profiles">Directory</a>
                <a href="https://x.com/settings/account/personalization">Settings</a>
            </div>
            <p>© 2025 X Corp.</p>
        </footer>

        <div id="modal-sign-up">
            <div class="modal">
                <div class="modal-top">
                    <img src="assets/close-svgrepo-com.svg" alt="close" id="close">
                    <img src="assets/icon-x.svg" alt="logo">
                </div>

                <div class="modal-form">
                    <h1>Create your account</h1>
                    <div class="modal-form-input">
                        <form>
                            <input type="text" class="form-control" placeholder="Name">
                            <input type="text" class="form-control" placeholder="Email"><br>
                            <label>Date of birth</label>
                            <p>This will not be shown publicly. Confirm your own age, even if this account is for a
                                business, a pet, or something else.</p>

                            <div class="dob-input">
                                <select id="day" name="day">
                                    <option value="" disabled selected>Day</option>
                                </select>

                                <select id="month" name="month">
                                    <option value="" disabled selected>Month</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>

                                <select id="year" name="year">
                                    <option value="" disabled selected>Year</option>
                                </select>
                            </div>

                            <button class="btn-input">Next</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Ambil elemen dropdown
        const daySelect = document.getElementById("day");
        const yearSelect = document.getElementById("year");

        // Isi dropdown Hari (1-31)
        for (let i = 1; i <= 31; i++) {
            let option = document.createElement("option");
            option.value = i;
            option.textContent = i;
            daySelect.appendChild(option);
        }

        // Isi dropdown Tahun (1900 - Tahun Sekarang)
        const currentYear = new Date().getFullYear();
        for (let i = currentYear; i >= 1900; i--) {
            let option = document.createElement("option");
            option.value = i;
            option.textContent = i;
            yearSelect.appendChild(option);
        }

        $(function () {
            $("#btn-create-account").click(function () {
                $("#modal-sign-up").fadeIn().css("display", "flex");
            })

            $("#close").click(function () {
                $("#modal-sign-up").fadeOut();
            })
        })

        // localStorage
        const hari = "<?php echo $tanggal ?>";
        const jam = "<?php echo $jam ?>";

        localStorage.setItem("hari", hari);
        localStorage.setItem("jam", jam);
    </script>
</body>

</html>