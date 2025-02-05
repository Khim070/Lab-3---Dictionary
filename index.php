<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dictionary</title>
</head>

<body>
    <?php
    $wordGroups = [];
    $dictionary = fopen("_Oxford English Dictionary.txt", "r") or die("Unable to open the file");
    while (!feof($dictionary)) {
        $word = fgets($dictionary);
        $firstletter = strtoupper($word[0]);
        if (preg_match('/^[A-Z]$/', $firstletter)) {
            $wordGroups[$firstletter][] = $word;
        }
    }

    fclose($dictionary);

    foreach ($wordGroups as $letter => $words) {
        $filename = $letter . ".txt";
        $file = fopen($filename, "w");

        foreach ($words as $word) {
            fwrite($file, $word . "\n");
        }

        fclose($file);
    }

    ?>
    <form action="" method="post">
        <label>Enter a word:</label>
        <input type="text" id="word" name="txtword" required>
        <input type="submit" value="Search">
    </form>
    <?php
        if (isset($_POST['txtword'])) {
            $firstWord = trim($_POST['txtword']);
            $eachWord = strtoupper($firstWord[0]);
            $eachFilename = fopen("$eachWord.txt", "r");
            $wordFound = false;
            while(!feof($eachFilename)){
                $eachLine = fgets($eachFilename);

                if (stripos($eachLine, $firstWord) === 0 || stripos($eachLine, $firstWord) === 0) {
                    echo "<p><strong>Word:</strong> $eachLine</p>";
                    $wordFound = true;
                    break;
                }
            }
            fclose($eachFilename);

            if (!$wordFound) {
                echo "<p>No such word found.</p>";
            }
        }
    ?>
</body>

</html>