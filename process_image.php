<!-- <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['festival']) && isset($_GET['text1']) && isset($_GET['text2'])) {
    $festival = $_GET['festival'];
    $text1 = $_GET['text1'];
    $text2 = $_GET['text2'];
    $imagePath = 'assets/festival.jpg'; // Default image
    $y1 = 100;
    $y2 = 140;

    // Define image paths and text positions for different festivals
    if ($festival === 'Makar Sankranti') {
        $imagePath = 'assets/MK.jpeg';
        $y1 = 120;
        $y2 = 160;
    } elseif ($festival === 'Holi') {
        $imagePath = 'assets/Holi.jpeg';
        $y1 = 150;
        $y2 = 190;
    } elseif ($festival === 'Christmas') {
        $imagePath = 'assets/Christmas.jpeg';
        $y1 = 80;
        $y2 = 120;
    } elseif ($festival === 'Diwali') {
        $imagePath = 'assets/Diwali.jpg';
        $y1 = 100;
        $y2 = 140;
    } elseif ($festival === 'Ganesh Chaturthi') {
        $imagePath = 'assets/GC.jpeg';
        $y1 = 110;
        $y2 = 150;
    } elseif ($festival === 'Mother\'s Day') {
        $imagePath = 'assets/festival.jpg'; // Using default for now
        $y1 = 100;
        $y2 = 140;
    } elseif ($festival === 'Teacher\'s Day') {
        $imagePath = 'assets/festival.jpg'; // Using default for now
        $y1 = 120;
        $y2 = 160;
    } elseif (in_array($festival, ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'])) {
        $imagePath = 'assets/festival.jpg'; // Default image for months
        $y1 = 100;
        $y2 = 140;
    }
    // Add conditions for other festivals here if you have specific images and positions

    $fontPath = 'arial.ttf'; // Ensure this path is correct
    $fontSize = 28; // Adjusted font size
    $x = 30; // Slightly adjusted X coordinate

    if (file_exists($imagePath) && file_exists($fontPath)) {
        $image = imagecreatefromjpeg($imagePath);
        if (!$image) {
            echo 'Error: Could not create image from path.';
            exit;
        }
        $textColor = imagecolorallocate($image, 0, 0, 0); // Black color

        $toText = "To: " . $text1;
        $fromText = "From: " . $text2;

        $text1_drawn = imagettftext($image, $fontSize, 0, $x, $y1, $textColor, $fontPath, $toText);
        if (!$text1_drawn) {
            echo 'Error drawing first line of text.';
        }

        $text2_drawn = imagettftext($image, $fontSize, 0, $x, $y2, $textColor, $fontPath, $fromText);
        if (!$text2_drawn) {
            echo 'Error drawing second line of text.';
        }

        $tempImageName = 'personalized_' . time() . '.jpg';
        $tempImagePath = $tempImageName;
        imagejpeg($image, $tempImagePath);
        imagedestroy($image);

        echo '<div style="text-align: center;">';
        echo '<img id="personalized-image" src="' . $tempImagePath . '" alt="Personalized Greeting" style="max-width: 80%; height: auto; border-radius: 6px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">';
        echo '<a class="download-button" href="' . $tempImagePath . '" download="personalized_greeting.jpg" style="margin-top: 15px; display: inline-block;">Download</a>';
        echo '</div>';
    } else {
        echo '<div style="color: red;">Error: Could not load image (' . $imagePath . ') or font (' . $fontPath . ').</div>';
    }
} else {
    echo '';
}
?> -->