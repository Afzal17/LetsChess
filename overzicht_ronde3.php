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
        $db->update_or_delete("DELETE FROM wedstrijden WHERE id=:id", ['id'=>$_GET['id']], "overzicht_ronde3.php");
            $loginError = $db->update_or_delete($sql, $placeholder, "overzicht_ronde3.php");
            var_dump($loginError);
    }

    if(isset($_POST['export'])){
        $filename = "ronde3_data_export.xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $print_header = false;
        
        $result = $db->select("SELECT wedstrijden.id, toernooi.omschrijving, wedstrijden.wedstrijd_ronde, speler.roepnaam AS speler1, speler1.roepnaam AS speler2, 
        wedstrijden.score1, wedstrijden.score2, wedstrijden.winnaarID, wedstrijden.created_at, wedstrijden.updated_at
        FROM wedstrijden
        INNER JOIN toernooi ON wedstrijden.toernooi_id = toernooi.id
        INNER JOIN speler speler ON speler.id = wedstrijden.speler1_id
        INNER JOIN speler speler1 ON speler1.id = wedstrijden.speler2_id WHERE wedstrijd_ronde = 3", []);
        
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
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

    $result_set = $db->select("SELECT wedstrijden.id, toernooi.omschrijving, wedstrijden.wedstrijd_ronde, speler.roepnaam AS speler1, speler.roepnaam AS speler2, 
    wedstrijden.score1, wedstrijden.score2, wedstrijden.winnaarID, wedstrijden.created_at, wedstrijden.updated_at
    FROM wedstrijden, toernooi, speler", []);
    $columns = array_keys($result_set[0]);

    $result_set1 = $db->select("SELECT wedstrijden.id, toernooi.omschrijving, wedstrijden.wedstrijd_ronde, speler.roepnaam AS speler1, speler1.roepnaam AS speler2, 
    wedstrijden.score1, wedstrijden.score2, wedstrijden.winnaarID, wedstrijden.created_at, wedstrijden.updated_at
    FROM wedstrijden
    INNER JOIN toernooi ON wedstrijden.toernooi_id = toernooi.id
    INNER JOIN speler speler ON speler.id = wedstrijden.speler1_id
    INNER JOIN speler speler1 ON speler1.id = wedstrijden.speler2_id WHERE wedstrijd_ronde = 3", []);
    $_SESSION['winnaars_derde_ronde'] = $result_set1;
    ?>

    <div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
                        <h2>Wedstrijd <b>Finale</b></h2>
                    </div>
                    <div class="col-sm-7">
                        <form method="post" action="overzicht_ronde3.php" class="row">
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

            <?php $row_id = $row['id']; ?>
            <tr>
                <?php   foreach($row as $row_data){?>
                <td>
                    <?php echo $row_data ?>
                </td>
                <?php } ?>
                <td>
                </td>
            </tr>
            <?php } ?>
            </table>

        <button type="button" name="gek" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            Bekendmaking Winnaar en afsluiten toernooi
        </button>       
            <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalCenterTitle">Finale Uitslag!</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <?php  
        foreach($_SESSION['winnaars_derde_ronde'] as $value) {
                    foreach($_SESSION['spelers'] as $value1) {
                        if($value['winnaarID'] == $value1['id']){
                            echo $value1['roepnaam'] . " is een winnaar van de derde en finale ronde van het " . $value['omschrijving'] . "!" . "</br>"; 
                        }
                    }   
        }
    ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Afsluiten</button>
      </div>
    </div>
  </div>
</div>

</body>

</html>