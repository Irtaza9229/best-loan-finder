<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include 'connection.php';
$conn = get_connection();

$criteria_id = $_POST['criteria_id'];
$result = $conn->query("SELECT * FROM `criteria` where id=" . $criteria_id . "");
$result = $result->fetch_row();
$criteria_data = json_decode($result[2], true);

?>

<html>

<head>
    <title>Details - Sourcing Tool</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Custom css -->
    <link rel="stylesheet" src="./assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
</head>

<body style="text-align: center;">
    <div class="container p-4" style="display: inline-flex;">
        <table class="table table-striped" style="width: 50%">
            <thead class="thead-dark">
                <tr>
                    <th class="head" colspan="4" style="text-align: center;">Product Complete Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <ul class="list-group">
                            <li class="list-group-item">Brand: <?= $result[1] ?></li>
                            <li class="list-group-item">Name: <?= $_POST['product_name'] ?></li>
                            <li class="list-group-item">Intial Rate: <?= $_POST['intial_rate'] ?></li>
                            <li class="list-group-item">Type: <?= $_POST['type'] ?></li>
                            <li class="list-group-item">Product fee: <?= $_POST['product_fee'] ?></li>
                            <li class="list-group-item">Lender fee: <?= $_POST['lender_fee'] ?></li>
                            <li class="list-group-item">ERC: <?= $_POST['ERC'] ?></li>
                            <li class="list-group-item">Incentive: <?= $_POST['incentive'] ?></li>
                            <li class="list-group-item">Max loan: <?= $_POST['max_loan'] ?></li>
                            <li class="list-group-item">Monthly Payment: <?= $_POST['monthlyPayment'] ?></li>
                            <li class="list-group-item">Max LTV: <?= $_POST['maxLTV'] ?></li>
                            <li class="list-group-item">DSCR: <?= $_POST['dscr'] ?></li>
                            <li class="list-group-item">ICR: <?= $_POST['icr'] ?></li>
                            <li class="list-group-item">Required Income: <?= $_POST['requiredIncome'] ?></li>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>


        <table class="table table-striped" style="width: 50%">
            <thead class="thead-dark">
                <tr>
                    <th class="head" colspan="4" style="text-align: center;">Criteria</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <ul class="list-group">

                            <?php foreach ($criteria_data as $cri) { ?>
                                <li class="list-group-item">
                                    <strong><?= $cri['key'] ?>:</strong><br><br>
                                    <strong>Yes: </strong><?= $cri['yes'] ?> <br><br>
                                    <strong>No: </strong><?= $cri['no'] ?>
                                </li>
                            <?php } ?>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>