<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aula Procedures | BD2-2022 </title>
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.3.1/jquery.quicksearch.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <?php
    require_once 'dbconfig.php';
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        // execute the stored procedure
        $sql = 'CALL GetCustomers()';

        // call the stored procedure
        $q = $pdo->query($sql);

        $q->setFetchMode(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error occurred:" . $e->getMessage());
    }
    ?>

    <div class="container">
        <nav id="nav" class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">BD2-2022</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Github</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Aulas
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled">Disabled</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
        <div id="main">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST")
                if (isset($_POST['pesquisar']) && (empty($_POST['nomeCliente'])) && (empty($_POST['cidade'])) && (empty($_POST['pais']))) {
            ?>


                <table id="tabela" class="table table-striped table-hover">

                    <tr>
                        <th>Customer Name</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Postal Code</th>
                        <th>Country</th>
                    </tr>
                    <?php while ($row = $q->fetch()) : ?>
                        <tr>
                            <td><?php echo $row['customerName'] ?></td>
                            <td><?php echo $row['city'] ?></td>
                            <td><?php echo $row['state'] ?></td>
                            <td><?php echo $row['postalCode'] ?></td>
                            <td><?php echo $row['country'] ?></td>


                        </tr>

                    <?php
                    endwhile;
                } else if (isset($_POST['pesquisar']) && !(empty($_POST['nomeCliente']))) {
                    // execute the stored procedure
                    try {
                        $pdo2 = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                        $sql2 = 'CALL GetCustomersByName(' . '"' . $_POST['nomeCliente'] . '"' . ')';
                        //    echo "sql2 = " . $sql2;
                        // call the stored procedure
                        $q2 = $pdo2->query($sql2);
                        if (!$q2) {
                            echo "\nPDO::errorInfo():\n";
                            print_r($pdo2->errorInfo());
                        }
                        $q2->setFetchMode(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        die("Error occurred:" . $e->getMessage());
                    }
                    ?><table id="tabela" class="table table-striped table-hover">

                        <tr>
                            <th>Customer Name</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Postal Code</th>
                            <th>Country</th>
                        </tr>
                        <?php while ($row2 = $q2->fetch()) : ?>
                            <tr>
                                <td><?php echo $row2['customerName'] ?></td>
                                <td><?php echo $row2['city'] ?></td>
                                <td><?php echo $row2['state'] ?></td>
                                <td><?php echo $row2['postalCode'] ?></td>
                                <td><?php echo $row2['country'] ?></td>


                            </tr>

                        <?php
                        endwhile;
                    } else if (isset($_POST['pesquisar']) && !(empty($_POST['cidade']))) {
                        // execute the stored procedure
                        try {
                            $pdo3 = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                            $sql3 = 'CALL GetCustomersByCity(' . '"' . $_POST['cidade'] . '"' . ')';
                            //    echo "sql2 = " . $sql2;
                            // call the stored procedure
                            $q3 = $pdo3->query($sql3);
                            if (!$q3) {
                                echo "\nPDO::errorInfo():\n";
                                print_r($pdo3->errorInfo());
                            }
                            $q3->setFetchMode(PDO::FETCH_ASSOC);
                        } catch (PDOException $e) {
                            die("Error occurred:" . $e->getMessage());
                        }
                        ?><table id="tabela" class="table table-striped table-hover">

                            <tr>
                                <th>Customer Name</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Postal Code</th>
                                <th>Country</th>
                            </tr>
                            <?php while ($row3 = $q3->fetch()) : ?>
                                <tr>
                                    <td><?php echo $row3['customerName'] ?></td>
                                    <td><?php echo $row3['city'] ?></td>
                                    <td><?php echo $row3['state'] ?></td>
                                    <td><?php echo $row3['postalCode'] ?></td>
                                    <td><?php echo $row3['country'] ?></td>


                                </tr>

                            <?php
                            endwhile;
                        } else if (isset($_POST['pesquisar']) && !(empty($_POST['pais']))) {
                            // execute the stored procedure
                            try {
                                $pdo4 = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                                $sql4 = 'CALL GetCustomersByCountry(' . '"' . $_POST['pais'] . '"' . ')';
                                //    echo "sql2 = " . $sql2;
                                // call the stored procedure
                                $q4 = $pdo4->query($sql4);
                                if (!$q4) {
                                    echo "\nPDO::errorInfo():\n";
                                    print_r($pdo4->errorInfo());
                                }
                                $q4->setFetchMode(PDO::FETCH_ASSOC);
                            } catch (PDOException $e) {
                                die("Error occurred:" . $e->getMessage());
                            }
                            ?><table id="tabela" class="table table-striped table-hover">

                                <tr>
                                    <th>Customer Name</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Postal Code</th>
                                    <th>Country</th>
                                </tr>
                                <?php while ($row4 = $q4->fetch()) : ?>
                                    <tr>
                                        <td><?php echo $row4['customerName'] ?></td>
                                        <td><?php echo $row4['city'] ?></td>
                                        <td><?php echo $row4['state'] ?></td>
                                        <td><?php echo $row4['postalCode'] ?></td>
                                        <td><?php echo $row4['country'] ?></td>


                                    </tr>

                                <?php
                                endwhile;
                            } else if (isset($_POST['pesquisar']) && !(empty($_POST['estado']))) {
                                // execute the stored procedure
                                try {
                                    $pdo5 = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                                    $sql5 = 'CALL GetCustomersByEstado(' . '"' . $_POST['estado'] . '"' . ')';
                                    //    echo "sql2 = " . $sql2;
                                    // call the stored procedure
                                    $q5 = $pdo5->query($sql5);
                                    if (!$q5) {
                                        echo "\nPDO::errorInfo():\n";
                                        print_r($pdo5->errorInfo());
                                    }
                                    $q4->setFetchMode(PDO::FETCH_ASSOC);
                                } catch (PDOException $e) {
                                    die("Error occurred:" . $e->getMessage());
                                }
                                ?><table id="tabela" class="table table-striped table-hover">

                                    <tr>
                                        <th>Customer Name</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Postal Code</th>
                                        <th>Country</th>
                                    </tr>
                                    <?php while ($row5 = $q5->fetch()) : ?>
                                        <tr>
                                            <td><?php echo $row5['customerName'] ?></td>
                                            <td><?php echo $row5['city'] ?></td>
                                            <td><?php echo $row5['state'] ?></td>
                                            <td><?php echo $row5['postalCode'] ?></td>
                                            <td><?php echo $row5['country'] ?></td>


                                        </tr>

                                <?php
                                    endwhile;
                                }
                                ?>
                                </table>
        </div>

        <div id="sidebar">
            <form method="post" class=" mt-4">
                <div class="form-group input-group-sm mb-3">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    <input name="nomeCliente" id="txt_nomeCliente" placeholder="Consultar por nome do cliente" type="text" class="form-control">
                </div>
                <div class="form-group input-group-sm mb-3">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    <input name="cidade" id="txt_cidade" placeholder="Consultar por cidade" type="text" class="form-control">
                </div>
                <div class="form-group input-group-sm mb-3">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    <input name="estado" id="txt_estado" placeholder="Consultar por estado" type="text" class="form-control">
                </div>

                <div class="form-group input-group-sm mb-3">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    <input name="pais" id="txt_pais" placeholder="Consultar por país" type="text" class="form-control">
                </div>
                <input type="submit" class="btn btn-primary" name="pesquisar" value="pesquisar" />
                <br><br>

            </form>
        </div>

        <div id="footer">Rodapé</div>
    </div>
</body>

</html>