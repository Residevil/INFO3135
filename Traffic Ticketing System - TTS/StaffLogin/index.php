<?php include'../view/header.php'; ?>
<body>
    <div class = "center">
        <h2>Staff Login</h2>
    </div>
    <div class = "center">
         <img src = "/TrafficTicketingSystem/images/avatar.png" alt="Avatar" class = "avatar">
    </div>
    <form method="post" action = "../CreateNewNotice/">
        <div class = "center">
            <input type="text" name = "EmailBar" placeholder="email"><br><br>
            <input type="text" name = "PasswordBar" placeholder="password">
        </div>
        <br>
        <div class = "center">
                <button type="submit" name="LoginButton">Login</button>
        </div>
    </form>
<?php include'../view/footer.php'; ?>
