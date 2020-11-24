<?php 
require_once 'Controllers/authController.php';
require_once 'Controllers/SearchEngine.php';
require_once 'config/db.php';

// verify the user using token
if(isset($_GET['token'])) {
    $token = $_GET['token'];
}

if(!isset($_SESSION['id'])) {
    header('location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script type="text/javascript" src="dist/jquery.tabledit.js"></script>
    <title>Homepage</title>
</head>
<body>
    <div class="container">
    <div class="row">
        <div class="col-lg-8 offset-lg-2 form-div login">
            
            <?php if(isset($_SESSION['message'])) : ?>
                <div class="alert <?php echo $_SESSION['alert-class']; ?>">
                    <?php 
                        echo $_SESSION['message']; 
                        unset($_SESSION['message']);
                        unset($_SESSION['alert-class']);
                    ?>
                </div>
            <?php endif ?>
            
            <h3> Welcome, <?php echo $_SESSION['username']; ?> ! </h3>
            
            <a href="index.php?logout=1" class="logout">Logout</a>
            
            <div class="alert alert-warning">
                Search for ticket by Violation Number or License Plate:
            </div>
                
            <form action="index.php" method="post">
                <div>
                    <input type="text" name="search" class="form-control form-control-lg">
                    <button type="submit" name="search-btn">Search</button>
                </div>
            </form>
            <table id="ViolationTable" class="table table-striped" <?php echo $hidden; ?>>
                <th>
                    <tr>
                        <th>Violation Number</th>
                        <th>Violation Type</th>
                        <th>Violation Date</th>
                        <th>License Plate</th>
                        <th>Fine Amount</th>
                        <th>Fine Due Date</th>
                        <th></th>
                    </tr>
                </th>
                <?php if(!empty($hidden)) {
                    echo $output;
                } ?>
                <?php if((empty($hidden))) : ?>
                <tbody> 
                        <tr id="<?php echo $ViolationID; ?>">
                        <td><?php echo $ViolationNumber; ?></td>
                        <td><?php echo $ViolationType; ?></td>
                        <td><?php echo $ViolationDate; ?></td> 		   
                        <td><?php echo $LicensePlateNumber; ?></td>   
                        <td><?php echo $FineAmount; ?></td>   
                        <td><?php echo $FineDueDate; ?></td>
                        <td><button type="submit" name="payment-btn">Pay</button></td>   
                        </tr>
                </tbody>
                <?php endif ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
