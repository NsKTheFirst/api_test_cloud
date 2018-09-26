<?php
$conn = new MongoDB\Driver\Manager("mongodb+srv://NsK:N23s05K78@nsk-jirog.gcp.mongodb.net/test?retryWrites=true");

$filter = [];
$option = [];
$read = new MongoDB\Driver\Query($filter, $option);

$films = $conn->executeQuery("Cinema.Cinema.Cinema", $read);

$single_insert = new MongoDB\Driver\BulkWrite();
if(isset($_POST['submit'])) {
$create_film = array(
    'titre' => $_POST['titre'],
    'realisateur' => $_POST['real'],
    'annee' => $_POST['annee']
);
$single_insert->insert($create_film);
$conn->executeBulkWrite("Cinema.Cinema.Cinema", $single_insert);

// _unset($_POST['submit']);
header("Location: proto.php");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Site proto</title>
    <style>
        h1 {
            text-align: center;
            margin-bottom: 50px
        }
        .tableau {
            border: solid 2px black;
            border-collapse: collapse;
            margin: auto;
            margin-bottom: 50px
        }

        tr, td, th {
            border: solid 1px black;
            border-collapse: collapse;
            padding: 5px;
            text-align: center
        }

        th {
            height: 40px;
            background: #4286f4;
            color: white
        }

        #create_div{
            width: 50%;
            height: 100px;
            margin: auto;
            background: #4286f4;
            display: flex;
            /* justify-content: center;  */
            border-radius: 20px;
            flex-direction: column;
            align-items: center;
            padding-bottom: 20px;
            margin-top: 30px
        }

        input {
            margin-right: 50px;
            height: 25px;    
        }
        a {
            text-decoration: none;
            color: black
        }
        img {
            height: 20%
        }
    </style>
</head>
<body>
    <h1>Référencement de films</h1>
    <div class="container">
        <table class="tableau">
            <tr>
                <th>Affiches</th>
                <th>Titres</th>
                <th>Réalisateurs</th>
                <th>Années</th>
                <th>Supprimer</th>
            </tr>

            <?php
                // function display_tab() {
                    foreach($films as $film) {
                        echo "<tr>";
                        echo "<td><img src='".$film->affiche."'></td>";
                        echo "<td>".$film->titre."</td>";
                        echo "<td>".$film->realisateur."</td>";
                        echo "<td>".$film->annee."</td>";
                        echo "<td>"."<button id='btn_del'><a href='delete.php?id=".$film->_id."'>Supprimer</a></button>";
                        echo "</tr>";
                    };
                // };
            ?>
        </table>
    </div>
    <div id="forms">   
        <div id="create_div">
            <h2>Entrer un nouveau film</h2>
            <form id="form_create" method ="POST">
                <input type="text" class="titre" name="titre" placeholder="Titre">
                <input type="text" class="real" name="real" placeholder="Réalisateur">
                <input type="number" class="annee" name="annee" placeholder="Année">
                <button type="submit" name="submit" id="create">Créer</button>
            </form>
        </div>
    </div>
</body>
</html>

