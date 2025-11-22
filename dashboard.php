<?php
session_start();

if (!isset($_SESSION['userdata'])) {
    header("location:index.html");
    exit();
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

$status = ($userdata['status'] == 0)
    ? '<b style="color:red">Not Voted</b>'
    : '<b style="color:green">Voted</b>';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Online Voting System - Dashboard</title>
    <link rel="stylesheet" href="stylesheet.css">

    <style>
        /* -------------------------
   GLOBAL
-------------------------- */
body {
    margin: 0;
    padding: 0;
    font-family: "Poppins", sans-serif;
    background: #f2f5f9;
}

/* Header */
#headersection {
    text-align: center;
    padding: 20px;
    background: linear-gradient(135deg, #4e73df, #1cc88a);
    color: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}

#headersection h1 {
    margin: 0;
    font-size: 32px;
}

/* Buttons */
#backbtn, #logoutbtn {
    padding: 10px 20px;
    border: none;
    background: #4e73df;
    color: white;
    border-radius: 6px;
    font-size: 15px;
    cursor: pointer;
}

#backbtn:hover, #logoutbtn:hover {
    background: #3b5cc9;
}

/* -------------------------
   PROFILE SECTION
-------------------------- */
#profile {
    width: 32%;
    background: white;
    padding: 25px;
    margin: 25px;
    border-radius: 12px;
    float: left;
    box-shadow: 0 2px 12px rgba(0,0,0,0.1);
}

#profile img {
    border-radius: 8px;
    margin-bottom: 20px;
}

/* -------------------------
   GROUP SECTION
-------------------------- */
#group {
    width: 55%;
    background: white;
    padding: 25px;
    margin: 25px;
    float: right;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.1);
}

#group h2 {
    color: #333;
}

/* Each group block */
.group-card {
    padding: 15px 0;
    border-bottom: 1px solid #ddd;
    overflow: auto;
}

.group-card img {
    float: right;
    border-radius: 8px;
}

/* Vote Button */
#votebtn {
    padding: 8px 18px;
    background: #1cc88a;
    border: none;
    color: white;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
}

#votebtn:hover {
    background: #17a673;
}

#voted {
    padding: 8px 18px;
    background: gray;
    border: none;
    color: white;
    border-radius: 6px;
    font-size: 14px;
}

/* -------------------------
   RESPONSIVE DESIGN
-------------------------- */
@media (max-width: 900px) {
    #profile, #group {
        width: 90%;
        float: none;
        margin: auto;
        margin-top: 20px;
    }
}

    </style>
</head>

<body>

<a href="index.html"><button id="backbtn">Back</button></a>
<a href="logout.php"><button id="logoutbtn">Logout</button></a>

<div id="headersection">
    <h1>Online Voting System</h1>
</div>
<hr>

<div id="profile">
    <img src="uploads/<?php echo $userdata['photo']; ?>" height="150" width="150"><br><br>

    <b>Name: </b> <?php echo $userdata['name']; ?><br><br>
    <b>Mobile: </b> <?php echo $userdata['mobile']; ?><br><br>
    <b>Address: </b> <?php echo $userdata['address']; ?><br><br>
    <b>Status: </b> <?php echo $status; ?><br><br>
</div>

<div id="group">
    <h2>Party / Groups</h2>
    <hr>

    <?php
    if (!empty($groupsdata)) {
        for ($i = 0; $i < count($groupsdata); $i++) {
            ?>
            <div style="margin-bottom: 30px;">
                <img src="uploads/<?php echo $groupsdata[$i]['photo']; ?>" height="100" width="100" style="float:right;">

                <b>Group Name: </b> <?php echo $groupsdata[$i]['name']; ?><br><br>
                <b>Votes: </b> <?php echo $groupsdata[$i]['votes']; ?><br><br>

                <form action="vote.php" method="POST">
                    <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']; ?>">
                    <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']; ?>">

                    <?php if ($userdata['status'] == 0) { ?>
                        <input type="submit" id="votebtn" value="Vote">
                    <?php } else { ?>
                        <button id="voted" disabled>Voted</button>
                    <?php } ?>
                </form>
            </div>
            <hr>
        <?php
        }
    } else {
        echo "<p>No groups found!</p>";
    }
    ?>
</div>

</body>
</html>
