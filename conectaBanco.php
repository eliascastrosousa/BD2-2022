
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
