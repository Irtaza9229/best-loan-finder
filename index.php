<html>

<head>
    <title>Search - Sourcing Tool</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Custom css -->
    <link rel="stylesheet" src="./assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script>
        function calculate_ltv() {
            var value = document.getElementById("value").value;
            var loan = document.getElementById("loan_required").value;
            document.getElementById("ltv").value = ((loan / value) * 100).toFixed(1) + "%";
        };
    </script>
</head>

<body>
    <div class="container p-4">
        <form action="results.php" method="POST">
            <table class="table table-striped" style="width: 70%">
                <thead class="thead-dark">
                    <tr>
                        <th class="head" colspan="4" style="text-align: center;">Property Numbers</th>
                    </tr>
                </thead>
                <tbody class="loan-input-container">
                    <tr>
                        <td>PP/Value</td>
                        <td bgcolor="#90EE90"><input name="value" id="value" required type="number" placeholder="$500,000" onchange="calculate_ltv()"></td>
                    </tr>
                    <tr>
                        <td>Loan Required</td>
                        <td bgcolor="#90EE90"><input name="loan_required" id="loan_required" required type="number" placeholder="$350,000" onchange="calculate_ltv()"></td>
                    </tr>
                    <tr>
                        <td>LTV Required</td>
                        <td bgcolor="#90EE90"><input name="ltv" id="ltv" required type="text" placeholder="75%"></td>
                    </tr>
                    <tr>
                        <td>Rental Income</td>
                        <td bgcolor="#90EE90"><input name="yearly_rent" required type="number" placeholder="$30,000"></td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-striped" style="width: 70%">
                <thead class="thead-dark">
                    <tr>
                        <th class="head" colspan="4" style="text-align: center;">Property Questions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Property Details</td>
                        <td>
                            <select name="property_details">
                                <option value="Purchase and Remortgage">Purchase and Remortgage</option>
                                <option value="Purchase">Purchase</option>
                                <option value="Remortgage">Remortgage</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Property Type</td>
                        <td>
                            <select name="property_type">
                                <option value="All">All</option>
                                <option value="Residential">Residential</option>
                                <option value="Semi Commercial">Semi Commercial</option>
                                <option value="Commercial">Commercial</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Is this property an ex-council property?</td>
                        <td>
                            <select name="ex_council">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Is this property outside England or Wales?</td>
                        <td>
                            <select name="england_wales">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Is this property a studio flat or bedsit?</td>
                        <td>
                            <select name="studio_flat">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-striped" style="width: 70%">
                <thead class="thead-dark">
                    <tr>
                        <th class="head" colspan="4" style="text-align: center;">Application Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tax status?</td>
                        <td>
                            <select name="tax_status">
                                <option value="Basic">Basic</option>
                                <option value="Higher">Higher</option>
                                <option value="Additional">Additional</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="age"> Enter your Age:</label>
                        </td>
                        <td><input type=number id=age></td>
                    </tr>
                    <tr>
                        <td>A first time buyer?</td>
                        <td>
                            <select name="first_time_buyer">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>A foreign national or ex-pat?</td>
                        <td>
                            <select name="foregin_national">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>A limited company?</td>
                        <td>
                            <select name="limited_company">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Number of existing mortgages?</td>
                        <td>
                            <select name="existing_mortgages">
                                <option value="Yes">Yes</option>
                                <option value="No" selected>No</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Number of Exisiting Mortgages?</td>
                        <td colspan=4>
                            <input name="number_of_mortgages" value="0" type="text" placeholder="Number Input - $xxxxx" />
                        </td>
                </tbody>
            </table>
            <table class="table table-striped" style="width: 70%">
                <thead class="thead-dark">
                    <tr>
                        <th class="head" colspan="4" style="text-align: center;">Tenancy Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Will there be more than 4 tenants?</td>
                        <td>
                            <select name="no_tenants">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Will the house contain DSS tenants?</td>
                        <td>
                            <select name="dss_tenants">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Will the house contain student tenants?</td>
                        <td>
                            <select name="contain_student_tenants">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Will there be more than one tenancy agreement?</td>
                        <td>
                            <select name="more_then_tenancy_agreement">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-primary text-center" style="width: 70%" type="submit">Search</button>
        </form>
    </div>
</body>

</html>