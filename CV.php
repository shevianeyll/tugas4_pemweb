<?php
session_start();
if (!isset($_SESSION['form_data'])) {
    header("Location: Form.php");
    exit();
}

$data = $_SESSION['form_data'];

function formatMonthYear($date)
{
    if (!$date)
        return "N/A";

    $dateObj = DateTime::createFromFormat('Y-m', $date);

    $months = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember'
    ];

    return $dateObj ? strtr($dateObj->format('F Y'), $months) : "Invalid Date";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />\
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .box_cv {
            margin: 100px;
            width: 1000px;
            height: 100%;
            background-color: #ffffff;
            color: rgb(0, 0, 0);
            box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.2), 0 10px 10px 0 rgba(0, 0, 0, 0.19);
        }

        .box_cv .header {
            position: relative;
            display: grid;
            grid-template-columns: 1fr;
        }

        .box_cv .header .name {
            background-color: #000627;
            color: #ffffff;
            padding-top: 35px;
            padding-left: 35px;
        }

        .name span {
            color: #ffffff;
            font-size: 25px;
            font-weight: 600;
            padding: 200px;
        }

        .box_cv .second-row {
            position: relative;
            display: grid;
            grid-template-columns: 1fr 2fr;
        }

        .box_cv .left-box {
            position: relative;
            padding: 40px;
            height: 100%;
            background-color: #f7f7f7;
        }

        i span {
            color: #2c2f3f;
            font-size: 19px;
            margin-right: 20px;
            margin-left: 10px;
        }

        section {
            padding: 20px;
            text-align: justify;
            border-bottom: 1px solid #ddd;
        }

        .box_cv .right-box {
            height: 100%;
            padding: 40px;
            background-color: #ffffff;
        }

        .experience p,
        .education p {
            font-weight: bold;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="box_cv" id="Main">
        <div class="header">
            <div class="name">
                <span>
                    <h2><?php echo htmlspecialchars($data['name']); ?></h2>
                    <h4><?php echo htmlspecialchars($data['major']); ?></h4>
                </span>
            </div>
        </div>
        <div class="second-row">
            <div class="left-box">
                <section class="About">
                    <i class="fa-solid fa-user"><span> About Me</span></i>

                    <p><?php echo htmlspecialchars($data['about']); ?></p>
                </section>
                <section class="Profile">
                    <i class="fa-solid fa-id-card"><span> Profile</span></i>
                    <ul>
                        <li><?php echo htmlspecialchars($data['date']); ?></li>
                        <li><?php echo htmlspecialchars($data['email']); ?></li>
                        <li>Lowokwaru - Malang</li>
                        <li><?php echo htmlspecialchars($data['address']); ?></li>
                    </ul>
                </section>
                <section class="skill">
                    <i class="fa-solid fa-gears"><span> Skill</span></i>
                    <ul>
                        <?php foreach ($data['skill'] as $skill) {
                            echo "<li>" . htmlspecialchars($skill) . "</li>";
                        } ?>
                    </ul>
                </section>
                <section class="language">
                    <i class="fa-solid fa-language"><span> Language</span></i>
                    <ul>
                        <?php foreach ($data['language'] as $language) {
                            echo "<li>" . htmlspecialchars($language) . "</li>";
                        } ?>
                    </ul>
                </section>
            </div>
            <div class="right-box">
                <section class="education">
                    <i class="fa-solid fa-school"><span> Education</span></i>
                    <ul>
                        <?php for ($i = 0; $i < count($data['school']); $i++) {
                            echo "<li><strong>" . htmlspecialchars($data['school'][$i]) . "</strong> (" . htmlspecialchars($data['start_year'][$i]) . " - " . htmlspecialchars($data['end_year'][$i]) . ") - " . htmlspecialchars($data['education_major'][$i]) . "</li>";
                        } ?>
                    </ul>
                </section>
                <section class="experience">
                    <i class="fa-solid fa-briefcase"><span> Experience</span></i>
                    <?php
                    if (!empty($data['job_title']) && is_array($data['job_title'])) {
                        for ($i = 0; $i < count($data['job_title']); $i++) {
                            echo "<h4>" . htmlspecialchars($data['job_title'][$i]) . "</h4>";
                            echo "<p>" . htmlspecialchars($data['company'][$i]) . "</p>";
                            echo "<p><strong>" . formatMonthYear($data['start_date'][$i]) . " - " . formatMonthYear($data['end_date'][$i]) . "</strong></p>";
                            echo "<ul>";
                            if (!empty($data['desc'][$i]) && is_array($data['desc'][$i])) {
                                foreach ($data['desc'][$i] as $desc) {
                                    echo "<li>" . htmlspecialchars($desc) . "</li>";
                                }
                            } else {
                                echo "<li>" . htmlspecialchars($data['desc'][$i]) . "</li>";
                            }
                            echo "</ul><br>";
                        }
                    }
                    ?>
                </section>
            </div>
        </div>
    </div>
</body>

</html>