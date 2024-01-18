<html>
<head>
    <title>Advanced Search</title>
    <meta charset="utf-8"/>
</head>
<body>
    <form method="post" action="search.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter a name">

        <label for="birth_date">Birth date:</label>
        <input type="text" id="birth_date" name="birth_date" placeholder="YYYY-MM-DD">

        <label for="sort_by">Sort by:</label>
        <select id="sort_by" name="sort_by">
            <option value="name">Name</option>
            <option value="birth_date">Birth date</option>
        </select>

        <label for="limit">Limit:</label>
        <input type="number" id="limit" name="limit" min="1" value="10">

        <label for="offset">Offset:</label>
        <input type="number" id="offset" name="offset" min="0" value="0">

        <input type="submit" value="Search">
    </form>
    <?php
    require_once 'config.php';
    require_once 'FilmModel.php';

    $recherche = new FilmModel($db);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            // Validate inputs
            if (empty($_POST['name'])) {
                throw new Exception("Name field is required.");
            }

            if (!empty($_POST['birth_date']) && !preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $_POST['birth_date'])) {
                                throw new Exception("Invalid birth date format");
            }

            $name = $_POST['name'];
            $birth_date = $_POST['birth_date'];
            $sort_by = $_POST['sort_by'];
            $limit = $_POST['limit'];
            $offset = $_POST['offset'];
            $result = $recherche->search($name, $birth_date, $sort_by, $limit, $offset);
            // Use the result to display the search result
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    ?>
    <div id="search-results">
        <h2>Movies</h2>
        <ul>
            <?php foreach ($result['titres'] as $film): ?>
                <li><?= $film['tconst'] . ' - ' . $film['primarytitle'] ?></li>
            <?php endforeach; ?>
        </ul>

        <h2>People</h2>
        <ul>
            <?php foreach ($result['personnes'] as $personne): ?>
                <li><?= $personne['nconst'] . ' - ' . $personne['primaryname'] ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
