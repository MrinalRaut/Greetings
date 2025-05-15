<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Your Greeting</title>
    <style>
        body {
            font-family: sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007bff;
            text-align: center;
            margin-bottom: 25px;
        }
        .input-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }
        input[type="text"], select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            width: calc(100% - 22px);
            font-size: 16px;
        }
        #festivals {
            width: 180px;
        }
        #month-festivals {
            width: 180px;
            display: none;
            margin-left: 15px;
        }
        #festival-image {
            display: none;
            max-width: 100%;
            height: auto;
            margin-top: 25px;
            border: 1px solid #eee;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.05);
            border-radius: 4px;
        }
        #personalized-greeting {
            margin-top: 30px;
            text-align: center;
        }
        #personalized-image {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .download-button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 20px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .download-button:hover {
            background-color: #218838;
        }
        .logout-button {
            display: block;
            width: fit-content;
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .logout-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Your Personalized Greeting</h1>
        <div class="input-group">
            <label for="text1">To:</label>
            <input type="text" id="text1" placeholder="Enter recipient's name">
        </div>

        <div class="input-group">
            <label for="text2">From:</label>
            <input type="text" id="text2" placeholder="Your name">
        </div>

        <div class="input-group">
            <label for="festivals">Select a Month:</label>
            <select id="festivals">
                <option value="">Select Month</option>
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
            </select>
            <label for="month-festivals" id="month-festivals-label" style="display: none; margin-left: 15px;">Select Festival:</label>
            <select id="month-festivals" style="display: none;">
                <option value="">Select Festival</option>
            </select>
        </div>

        <img id="festival-image" src="assets/festival.jpg" alt="Festival Image" style="display: none;">

        <div id="personalized-greeting">
            <?php
            if (!empty($_GET['image'])) {
                echo '<img id="personalized-image" src="' . $_GET['image'] . '" alt="Personalized Greeting">';
                echo '<a class="download-button" href="' . $_GET['image'] . '" download="personalized_greeting.jpg">Download</a>';
            }
            ?>
        </div>
        <a href="logout.php" class="logout-button">Logout</a>
    </div>

    <script>
        const festivalsDropdown = document.getElementById('festivals');
        const monthFestivalsDropdown = document.getElementById('month-festivals');
        const monthFestivalsLabel = document.getElementById('month-festivals-label');
        const festivalImage = document.getElementById('festival-image');
        const textInput1 = document.getElementById('text1');
        const textInput2 = document.getElementById('text2');

        // Define festivals for each month
        const monthlyFestivals = {
            "January": ["Mother's Day", "Teacher's Day"],
            "February": ["Makar Sankranti"],
            "March": ["Holi"],
            "April": [""],
            "May": [""],
            "June": [""],
            "July": [""],
            "August": [""],
            "September": ["Ganesh Chaturthi"],
            "October": [""],
            "November": ["Diwali"],
            "December": ["Christmas"]
        };

        festivalsDropdown.addEventListener('change', function() {
            const selectedMonth = this.value;

            monthFestivalsDropdown.style.display = 'none';
            monthFestivalsLabel.style.display = 'none';
            monthFestivalsDropdown.innerHTML = '<option value="">Select Festival</option>';
            festivalImage.style.display = 'none';
            document.getElementById('personalized-greeting').innerHTML = '';

            if (monthlyFestivals[selectedMonth]) {
                monthFestivalsDropdown.style.display = 'inline-block';
                monthFestivalsLabel.style.display = 'inline';
                monthlyFestivals[selectedMonth].forEach(festival => {
                    const option = document.createElement('option');
                    option.value = festival;
                    option.textContent = festival;
                    monthFestivalsDropdown.appendChild(option);
                });
            }
        });

        monthFestivalsDropdown.addEventListener('change', function() {
            const selectedFestival = this.value;
            if (selectedFestival) {
                festivalImage.style.display = 'none'; // Ensure initial image is hidden
                processImage();
            } else {
                festivalImage.style.display = 'none';
                document.getElementById('personalized-greeting').innerHTML = '';
            }
        });

        function processImage() {
            const text1 = textInput1.value;
            const text2 = textInput2.value;
            let selectedFestival = '';

            if (festivalsDropdown.value && monthlyFestivals[festivalsDropdown.value]) {
                selectedFestival = monthFestivalsDropdown.value;
            }

            if (selectedFestival) {
                fetch('process_image.php?festival=' + encodeURIComponent(selectedFestival) + '&text1=' + encodeURIComponent(text1) + '&text2=' + encodeURIComponent(text2))
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('personalized-greeting').innerHTML = data;
                    });
            } else {
                document.getElementById('personalized-greeting').innerHTML = '';
            }
        }

        textInput1.addEventListener('input', function() {
            if (festivalsDropdown.value && monthlyFestivals[festivalsDropdown.value] && monthFestivalsDropdown.value) {
                processImage();
            }
        });
        textInput2.addEventListener('input', function() {
            if (festivalsDropdown.value && monthlyFestivals[festivalsDropdown.value] && monthFestivalsDropdown.value) {
                processImage();
            }
        });
    </script>
</body>
</html> -->