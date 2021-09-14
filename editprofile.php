<?php 

  session_start();

  require 'connect.php';
  require 'functions.php';

  if(isset($_POST['update'])) {

    $fname = clean($_POST['firstname']);
    $lname = clean($_POST['lastname']);
    $course = clean($_POST['course']);
    $yrlevel = clean($_POST['yrlevel']);

    $query = "UPDATE students SET firstname = '$fname', lastname = '$lname', course = '$course', yrlevel = '$yrlevel'
    WHERE id='".$_SESSION['userid']."'";

    if($result = mysqli_query($con, $query)) {

      $_SESSION['prompt'] = "Profile Updated";
      header("location:profile.php");
      exit;

    } else {

      die("Error with the query");

    }

  }

  if(isset($_SESSION['username'], $_SESSION['password'])) {

?>

<!DOCTYPE html>
<html lang="en">
	<title>My Calendar</title>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
        
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
        <link href="calendar.css" type="text/css" rel="stylesheet" />
	
	<style>
	body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
	body {font-size:16px;}
	.w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
	.w3-half img:hover{opacity:1}
        
        .topnav {
        overflow: hidden;
        background-color: white;
        }

      .topnav .search-container {
        float: left;
        margin-left: 300px;
        }

      .topnav input[type=text] {
        padding: 6px;
        margin-top: 8px;
        font-size: 17px;
        
        border: none;
        }

      .topnav .search-container button {
        float: right;
        padding: 6px 10px;
        margin-top: 8px;
        margin-right: 16px;
        background: #ddd;
        font-size: 17px;
        border: none;
        cursor: pointer;
        }

      .topnav .search-container button:hover {
        background: white;
        }

        @media screen and (max-width: 600px) {
        .topnav .search-container {
          float: none;
        }
        
        .topnav input[type=text], .topnav .search-container button {
          float: none;
          display: block;
          text-align: left;
          width: 100%;
          margin: 0;
          padding: 14px;
        }
        
        .topnav input[type=text] {
          border: 1px solid #ccc;  
        }
      }
      
      /* Remove margins and padding from the list */
        ul {
          margin: 0;
          padding: 0;
        }

     

        

      
      
        .row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}



.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}




.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 40%;
  margin-bottom: 20px;
  margin-left:10px ;
  padding:   5px;
  border: 1px solid #ccc;
  border-radius: 50px;
}

label {
  margin-bottom: 10px;
  margin-left: 5px;
  text-align: left;
  display: block;
}


.btn {
  background-color: orangered;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: blue;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}



/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 500px) {
  .row {
    flex-direction: column-reverse;
  }
  
        
        
     


        

	</style>
	
	<body>
            <!-- Search bar -->
            <div class="topnav">    
                <div class="search-container">
                    <input type="text" placeholder="Search..">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
            
		<!-- Sidebar/menu -->
		<nav class="w3-sidebar w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:250px;font-weight:bold;" id="mySidebar"><br>
		  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
		  <div class="w3-container">
			<h3 class="w3-padding-64"><b>Website<br>Name</b></h3>
		  </div>
		  <div class="w3-bar-block">
			<a href="#Home" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Home</a> 
			<a href="#Courses" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Courses</a> 
			<a href="#GoalsAndDeadlines" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Goals and Deadlines</a> 
			<a href="#MyCalendar" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">My Calendar</a> 
			<a href="#Progress" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Progress</a> 
		  </div>
		</nav>

		<!-- Top menu on small screens -->
		<header class="w3-container w3-top w3-hide-large w3-red w3-xlarge w3-padding">
		  <a href="javascript:void(0)" class="w3-button w3-red w3-margin-right" onclick="w3_open()">☰</a>
		  <span>Website Name</span>
		</header>

		<!-- Overlay effect when opening sidebar on small screens -->
		<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

		<!-- !PAGE CONTENT! -->
		<div class="w3-main" style="margin-left:340px;margin-right:40px">

		  <!-- Header -->
		  <section>
    
    <div class="container">
      <strong class="title">Edit Profile</strong>
    </div>
    

    <div class="edit-form box-left clearfix">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

        <div class="form-group">
          <label>Student No:</label>
          
          <?php 
            $query = "SELECT studentno FROM students WHERE id = '".$_SESSION['userid']."'";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_row($result);

            echo "<p>".$row[0]."</p>";
          ?>

        </div>


        <div class="form-group">
          <label for="firstname">First Name</label>
          <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
        </div>


        <div class="form-group">
          <label for="lastname">Last Name</label>
          <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
        </div>


        <div class="form-group">
          <label for="course">Course</label>

          <select class="form-control" name="course">
              <option value="BSBA">BSBA</option>
              <option value="BSOA">BSOA</option>
              <option value="BSIT">BSIT</option>
              <option value="BSCS">BSCS</option>
              <option value="BSCE">BSCE</option>
              
            </select>

        </div>


        <div class="form-group">
          <label for="yrlevel">Year Level</label>

          <select class="form-control" name="yrlevel">
            <option>1st year</option>
            <option>2nd year</option>
            <option>3rd year</option>
            <option>4th year</option>
          </select>

        </div>
        
        <div class="form-footer">
          <a href="profile.php">Go back</a>
          <input class="btn btn-primary" type="submit" name="update" value="Update Profile">
        </div>
        

      </form>
    </div>

  </section>
   
	</body>
</html>

<?php 

  } else {
    header("location:profile.php");
  }

  mysqli_close($con);

?>