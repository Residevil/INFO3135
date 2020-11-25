<?php include'../view/header.php'; ?>
<body>
    <h2>Create a new Notice</h2>
    <form METHOD="post">
        <table>
            <tr>
                <th>Notice #</th>
                <td><input type="text" placeholder="Notice#"></td>
            </tr>
            <tr>
                <th>License Plate #</th>
                <td><input type="text" placeholder="License Plate#"></td>
            </tr>
            <tr>
                <th>Driver's First Name</th>
                <td><input type="text" placeholder="First Name"></td>
            </tr>
            <tr>
                <th>Driver's Last Name</th>
                <td><input type="text" placeholder="Last Name"></td>
            </tr>
            <tr>
                <th>Driver's Address</th>
                <td><input type="text" placeholder="Unit#"></td>
            </tr>
            <tr>
                <th>&nbsp</th>
                <td><input type="text" placeholder="Street#"></td>
            </tr>
            <tr>
                <th>&nbsp</th>
                <td><input type="text" placeholder="Street Name"></td>
            </tr>
            <tr>
                <th>&nbsp</th>
                <td><input type="text" placeholder="City"></td>
            </tr>
            <tr>
                <th>&nbsp</th>
                <td><select name = "Province" id = "Province">
                                <option value ="AB">AB</option>
                                <option value ="BC">BC</option>
                                <option value ="MB">MB</option>
                                <option value ="NB">NB</option>
                                <option value ="NL">NL</option>
                                <option value ="NT">NT</option>
                                <option value ="NS">NS</option>
                                <option value ="NU">NU</option>
                                <option value ="ON">ON</option>
                                <option value ="QC">QC</option>
                                <option value ="SK">SK</option>
                                <option value ="YT">YT</option>
                                </select>
                </td>
            </tr>
            <tr>
                <th>&nbsp</th>
                <td><input type="text" placeholder="PostalCode"></td>
            </tr>
            <tr>
                <th>Violation Type</th>
                        <td><select name = "ViolationType" id = "ViolationType">
                                <option value ="ParkingViolation">Parking Notice</option>
                                <option value ="SpeedingViolation">Speeding Notice</option>
                                <option value ="RedLightViolation">Red Light Notice</option>
                                </select>
                        </td>
            </tr>
            <tr>
                <th>Notice Date</th>
                <td><input type="date" placeholder="Notice Date"></td>
            </tr>
            <tr>
                <th>Fine Amount</th>
                <td><input type="text" placeholder="Fine Amount"></td>
            </tr>
            <tr>
                <th>Fine Due Date</th>
                <td><input type="date" placeholder="Fine Due Date"></td>
            </tr>
        </table>
        <div class = "center">
          <button type="submit" name="violation_n" class="search_b">Create Notice</button>
        </div>
    </form>
<?php include'../view/footer.php'; ?>
