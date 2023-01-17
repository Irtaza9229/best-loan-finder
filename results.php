<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
?>

<html>

<head>
    <title>Result - Sourcing Tool</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- Custom css -->
    <link rel="stylesheet" src="./assets/css/style.css">

</head>

<body>
    <?php
    include 'connection.php';
    $conn = get_connection();
    $result = $conn->query("SELECT * FROM `lenders`");
    ?>

    <div class="container-fluid p-4">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th class="head" style="text-align: center;">Lender</th>
                    <th class="head" style="text-align: center;">Rate</th>
                    <!--<th class="head" style="text-align: center;">Max LTV</th>-->
                    <th class="head" style="text-align: center;">Product type</th>
                    <th class="head" style="text-align: center;">Term</th>
                    <th class="head" style="text-align: center;">Lender fee</th>
                    <th class="head" style="text-align: center;">Admin fee</th>
                    <th class="head" style="text-align: center;">ERC</th>
                    <th class="head" style="text-align: center;">Incentive</th>
                    <!--<th class="head" style="text-align: center;">Total advance</th>-->
                    <th class="head" style="text-align: center;">Max Loan</th>
                    <th class="head" style="text-align: center;">Monthly payment</th>
                    <th class="head" style="text-align: center;">Max LTV</th>
                    <th class="head" style="text-align: center;">Status</th>
                    <th class="head" style="text-align: center;">DSCR</th>
                    <th class="head" style="text-align: center;">ICR</th>
                    <th class="head" style="text-align: center;">Required Income</th>
                    <th class="head" style="text-align: center;">Action</th>

                </tr>
            </thead>
            <tbody class="loan-input-container">

                <?php foreach ($result as $row) {
                    $product = json_decode($row['products'], true);

                    if ($_POST['property_type'] != 'All' && strtolower($_POST['property_type']) != strtolower($product['type']))
                        continue;

                    $dscr = $product['dscr'];
                    $icr = $product['icsr_higher'];
                    if ($_POST['tax_status'] == 'Basic')
                        $icr = $product['iscr_basic'];

                    $yearly_rent = (float)$_POST['yearly_rent'];
                    $dscr_for_cal = (float)str_replace('%', '', $dscr);
                    $icsr_for_cal = (float)str_replace('%', '', $icr);
                    $intial_rate_cal = (float)str_replace('%', '', $product['intial_rate']);

                    $term_in_years = (int)preg_replace('/[^0-9]/', '', $product['product_name']);
                    $term_in_years = $term_in_years * 12;

                    $totalAdvance = $yearly_rent / $dscr_for_cal / $icsr_for_cal * 100 * 100;
                    $monthlyPayment = $totalAdvance * $intial_rate_cal / 12 / 100; // 417391*3.50/12/100

                    // Max Loan
                    $max_loan = $yearly_rent / $dscr_for_cal / $icsr_for_cal * 100 * 100;

                    // TODO: Need to add dynamic admin fee
                    $monthly_payment = ($max_loan / $term_in_years) + 0;

                    //Max LTV
                    $value = (float) $_POST['value'];
                    $maxLTV = $requiredIncome / $value * 100;

                    //Required Income
                    $loanRequired = (float) $_POST['loan_required'];
                    $requiredIncome = $loanRequired * $dscr_for_cal * $icsr_for_cal / 100 / 100;
                    // $url = "details.php?id=" . $row['id'] .
                    //     "&criteria_id=" . $row['criteria_id'] .
                    //     "&intial_rate=" . $product['intial_rate'] .
                    //     "&type=" . $product['type'] .
                    //     "&product_name=" . $product['product_name'] .
                    //     "&product_fee=" . str_replace("u00a3", "£", $product['product_fee']) .
                    //     "&lender_fee=0"  .
                    //     "&ERC=" . $product['ERC']  .
                    //     "&incentive=" . $product['incentive']  .
                    //     "&max_loan=" . number_format($max_loan, 2) .
                    //     "&monthlyPayment=" . number_format($monthlyPayment, 2) .
                    //     "&maxLTV=" . $maxLTV .
                    //     "&dscr=" . $dscr .
                    //     "&icr=" . $icr .
                    //     "%&requiredIncome=" . $requiredIncome .
                    //     "";

                ?>
                    <tr>
                        <td><?= $row['name'] ?></td>
                        <td><?= $product['intial_rate'] ?></td>
                        <td><?= $product['type'] ?></td>
                        <td><?= $product['product_name'] ?></td>
                        <td><?= str_replace("u00a3", "£", $product['product_fee'])  ?></td>
                        <td>0</td>
                        <td><?= $product['ERC'] ?></td>
                        <td><?= $product['incentive'] ?></td>
                        <td>£<?= number_format($max_loan, 2) ?></td>
                        <td>£<?= number_format($monthlyPayment, 2) ?></td>
                        <td><?= $maxLTV ?>%</td>
                        <td> <!--status-->
                            <?php if ($yearly_rent < $requiredIncome) {
                                echo "IT DOESN'T FIT";
                            } else {
                                echo "IT FITS";
                            } ?>
                        </td>
                        <td><?= $dscr ?></td>
                        <td><?= $icr ?></td>
                        <td>£<?= number_format($requiredIncome, 2) ?></td>
                        <td>
                            <form method="post" action="details.php">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="criteria_id" value="<?= $row['criteria_id'] ?>">
                                <input type="hidden" name="intial_rate" value="<?= $product['intial_rate'] ?>">
                                <input type="hidden" name="type" value="<?= $product['type'] ?>">
                                <input type="hidden" name="product_name" value="<?= $product['product_name'] ?>">
                                <input type="hidden" name="product_fee" value="<?= str_replace("u00a3", "£", $product['product_fee']) ?>">
                                <input type="hidden" name="lender_fee" value="0">
                                <input type="hidden" name="ERC" value="<?= $product['ERC'] ?>">
                                <input type="hidden" name="incentive" value="<?= $product['incentive'] ?>">
                                <input type="hidden" name="max_loan" value="<?= number_format($max_loan, 2) ?>">
                                <input type="hidden" name="monthlyPayment" value="<?= number_format($monthlyPayment, 2) ?>">
                                <input type="hidden" name="maxLTV" value="<?= $maxLTV ?>">
                                <input type="hidden" name="dscr" value="<?= $dscr ?>">
                                <input type="hidden" name="icr" value="<?= $icr ?>">
                                <input type="hidden" name="requiredIncome" value="<?= $requiredIncome ?>">
                                <input type="submit" value="View">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>