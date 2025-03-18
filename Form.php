<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: Login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['form_data'] = $_POST;
    
     // Menentukan folder penyimpanan
     $uploadDir = "img/";
     if (!file_exists($uploadDir)) {
         mkdir($uploadDir, 0777, true); // Buat folder jika belum ada
     }
 
     $uploadedFiles = [];
     foreach ($_FILES['photos']['name'] as $key => $name) {
         if ($_FILES['photos']['error'][$key] == 0) {
             $tmpName = $_FILES['photos']['tmp_name'][$key];
             $filePath = $uploadDir . time() . "_" . basename($name);
             if (move_uploaded_file($tmpName, $filePath)) {
                 $uploadedFiles[] = $filePath;
             }
         }
     }

     $_SESSION['uploaded_photos'] = $uploadedFiles;

    header("Location: CV.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Identity</title>
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

        .box {
            width: 100%;
            max-width: 1200px;
            margin: 100px auto 0;
            margin-bottom: 100px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .form_align {
            width: 100%;
            position: relative;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .form_align .form_left {
            position: relative;
            padding: 40px;
            width: 100%;
            height: 100%;
            background-color: #f7f7f7;
        }

        .form_align .form_right {
            position: relative;
            padding: 40px;
            width: 100%;
            height: 100%;
            background-color: #f7f7f7;
        }

        .input-group {
            margin-bottom: 10px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
        }

        h1,
        h3 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        input,
        textarea {
            width: 500px;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
            width: 500px;
        }

        button {
            display: block;
            width: 500px;
            padding: 10px;
            background-color: #000627;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="box" id="Form">
        <h1>Form Identity</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="form_align">
                <div class="form_left">
                    <h3>About me</h3>
                    <label for="about">About Me:</label>
                    <textarea id="about" name="about" required></textarea>

                    <h3>Profile</h3>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                    <label for="major">Major:</label>
                    <input type="text" id="major" name="major" required>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" required>
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required>
                    <label for="birth_place">Birth Place:</label>
                    <input type="text" id="birth_place" name="birth_place" required>
                    <label for="date">Birth Date:</label>
                    <input type="date" id="date" name="date" required>

                    <h3>Skill</h3>
                    <div class="input-group">
                        <?php for ($i = 1; $i <= 3; $i++): ?>
                            <label>Skill <?= $i ?>:</label>
                            <input type="text" name="skill[]" <?= $i == 1 ? "required" : "" ?>>
                            <br>
                        <?php endfor; ?>
                    </div>

                    <h3>Language</h3>
                    <div class="input-group">
                        <?php for ($i = 1; $i <= 3; $i++): ?>
                            <label>Language <?= $i ?>:</label>
                            <input type="text" name="language[]" <?= $i == 1 ? "required" : "" ?>>
                            <br>
                        <?php endfor; ?>
                    </div>
                    <h3>Upload Photo</h3>
                    <div class="input-group">
                        <!-- <form method="POST" enctype="multipart/form-data"> -->
                            <label>Upload Photos:</label>
                            <input type="file" name="photos[]" accept="image/*" multiple>
                            <br>
                            <!-- <button type="submit">Submit</button> -->
                        <!-- </form> -->
                    </div>
                </div>

                <div class="form_right">
                    <h3>Education</h3>
                    <div class="input-group">
                        <?php for ($i = 1; $i <= 2; $i++): ?>
                            <label>School <?= $i ?>:</label>
                            <input type="text" name="school[]">
                            <label>Start Year:</label>
                            <input type="number" name="start_year[]">
                            <label>End Year:</label>
                            <input type="number" name="end_year[]">
                            <label>Major:</label>
                            <input type="text" name="education_major[]">
                            <br>
                        <?php endfor; ?>
                    </div>

                    <h3>Experience</h3>
                    <?php for ($i = 1; $i <= 2; $i++): ?>
                        <label>Job Title <?= $i ?>:</label>
                        <input type="text" name="job_title[]">

                        <label>Company:</label>
                        <input type="text" name="company[]">

                        <label>Start Date:</label>
                        <input type="month" name="start_date[]">

                        <label>End Date:</label>
                        <input type="month" name="end_date[]">

                        <label>Job Description:</label>
                        <textarea name="desc[<?= $i - 1 ?>][]"></textarea>

                        <br>
                    <?php endfor; ?>
                </div>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
