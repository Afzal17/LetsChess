<?php

    session_start();

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header('location: index.php');
    exit;
    }
    
    include 'db.php';
    include 'validation.php';

    $db = new db();

    if(isset($_GET['id'])) {
        $db->update_or_delete("DELETE FROM aanmeldingen WHERE id=:id", ['id'=>$_GET['id']], "overzicht_aanmeldingen.php");
            $loginError = $db->update_or_delete($sql, $placeholder, "overzicht_aanmeldingen.php");
            var_dump($loginError);
    }

    if(isset($_POST['export'])){
        $filename = "aanmeldingen_data_export.xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $print_header = false;
        
        $result = $db->select("SELECT aanmeldingen.id, speler.roepnaam, toernooi.omschrijving, aanmeldingen.created_at, aanmeldingen.updated_at 
        FROM aanmeldingen
            INNER JOIN speler ON aanmeldingen.speler_id = speler.id
            INNER JOIN toernooi ON aanmeldingen.toernooi_id = toernooi.id", []);
        
        if(!empty($result)){
            foreach($result as $row){
                if(!$print_header){
                    echo implode("\t", array_keys($row)) ."\n";
                    $print_header=true;
                }
                echo implode("\t", array_values($row)) ."\n";
            }
        }
        exit;
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KNLTB</title>

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-default navbar-inverse" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a href="welkom_med.php">
                    <img src="logo.png" alt="project logo" width="220" heigth="110">
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <p class="nav navbar-text">KNLTB</p>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="welkom_med.php" class="dropdown-toggle" data-toggle="dropdown"><b><?php echo "Welkom " . htmlentities( $_SESSION['gebruikersnaam']) ."!" ?></b> <span
                                class="caret"></span></a>
                        <ul id="login-dp" class="dropdown-menu">
                            <li>
                                    <div class="form-group">
                                        <a href="index.php" class="btn btn-primary btn-block">Logout</a>
                                    </div>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-2" id="homemenu3">
            <br>
            <h4 class="menu">Menu</h4>
            <br />
            <a class="menulinks" href="welkom_med.php">Home</a>
            <br />
            <br />
            <a class="menulinks" href="overzicht_med.php">Overzicht Medewerkers</a>
            <br />
            <br />
            <a class="menulinks" href="overzicht_school.php">Overzicht Scholen</a>
            <br />
            <br />
            <a class="menulinks" href="overzicht_toernooi.php">Overzicht Toernooien</a>
            <br />
            <br />
            <a class="menulinks" href="overzicht_aanmeldingen.php">Overzicht Aanmeldingen</a>
            <br />
            <br />
            <a class="menulinks" href="overzicht_wedstrijd.php">Overzicht Wedstrijden</a>
            <br />
            <br />
            <a class="menulinks" href="overzicht_speler.php">Overzicht Spelers</a>
            <br />
            <br />
            <a class="menulinks" href="overzicht_ronde1.php">Overzicht Uitslag<br>Ronde 1</a>
            <br />
            <br />
            <a class="menulinks" href="overzicht_ronde2.php">Overzicht Uitslag<br>Ronde 2</a>
            <br />
            <br />
            <a class="menulinks" href="overzicht_ronde3.php">Overzicht Uitslag<br>Ronde 3/finales</a>
            <br />
        </div>
    </div>

    <?php

    $result_set = $db->select("SELECT aanmeldingen.id, speler.roepnaam, toernooi.omschrijving, aanmeldingen.created_at, aanmeldingen.updated_at 
    FROM aanmeldingen, speler, toernooi", []);
    $columns = array_keys($result_set[0]);

    $result_set1 = $db->select("SELECT aanmeldingen.id, speler.roepnaam, toernooi.omschrijving, aanmeldingen.created_at, aanmeldingen.updated_at 
    FROM aanmeldingen
        INNER JOIN speler ON aanmeldingen.speler_id = speler.id
        INNER JOIN toernooi ON aanmeldingen.toernooi_id = toernooi.id", []);
    ?>

    <div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
                        <h2>Aanmeldingen <b>Management</b></h2>
                    </div>
                    <div class="col-sm-7">
                        <a href="add_aanmelding.php" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Voeg Aanmelding Toe</span></a>
                        
                        <form method="post" action="overzicht_aanmeldingen.php" class="row">
                        <input class="btn btn-secondary" type="submit" value="Export To Excel" name="export"></input>
                        </form>						
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <?php foreach($columns as $column){ ?>
                            <th>
                                <strong> <?php echo $column ?> </strong>
                            </th>
                            <?php } ?>
                            <th colspan="2">action</th>
                        </tr>
                    </thead>
                    <?php foreach($result_set1 as $rows => $row){ ?>

            <?php $row_id = $row['id']; 
    ?>
            <tr>
                <?php   foreach($row as $row_data){?>
                <td>
                    <?php echo $row_data ?>
                </td>
                <?php } ?>
                <td>
                    <a href="edit_aanmelding.php?id=<?php echo $row_id; ?>" class="settings" ><i class="material-icons">&#xE8B8;</i></a>
                    <a onclick="return confirm('Are you sure you want to delete this entry?')"
                        href="overzicht_aanmeldingen.php?id=<?php echo $row_id; ?>"
                        class="delete" title="Delete"><i class="material-icons">&#xE5C9;</i></a>
                </td>
            </tr>
            <?php } ?>
            </table>


</body>

</html>