<?php
// Function to read fitness tips from a file
function readFitnessTips($filePath) {
    // Read the contents of the file
    $tipsJson = file_get_contents($filePath);

    // Decode the JSON data
    $tips = json_decode($tipsJson, true);

    return $tips;
}

// Function to display fitness tips on the dashboard
function displayFitnessTips($tips, $numTips = 4) {
    // Shuffle the tips array
    shuffle($tips);

    // Select a subset of tips (default: 4 tips)
    $selectedTips = array_slice($tips, 0, $numTips);

    // Display the tips
    foreach ($selectedTips as $tip) {
        echo "<p>{$tip}</p>";
    }
}

// Path to the fitness tips file
$tipsFilePath = 'fitness_tips.json';

// Read fitness tips from the file
$tips = readFitnessTips($tipsFilePath);

// Display fitness tips on the dashboard
displayFitnessTips($tips);
?>
