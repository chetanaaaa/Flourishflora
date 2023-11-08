<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <style>
body {
  background-image: url('./images/seedling.jpg');
  background-size: cover; /* Cover the entire viewport */
  background-repeat: no-repeat; /* Don't repeat the image */
  background-attachment: fixed; 
  background-position: center bottom -110px ; 
  margin-top: 50px; 
  margin-left:50px;
}

.container {
  display: flex;
  flex-direction: column; /* Display buttons vertically */
  align-items: left; /* Center-align buttons horizontally */
}

button {
  width: 550px;
  height: 60px;
  background-color: green;
  color: white;
  font-size: 16px;
  border: 2px solid green;
  border-radius: 5px;
  margin: 10px 0; /* Adjust vertical margin */
}
    </style>
</head>
<body>
    <div class="container my-10">
    <a href="./admin/admin_login.php"><button>Admin</button></a>
    <a href="index.php"><button>User</button></a>
    <a href="./nursery/nursery_login.php"><button>Nursery</button></a>
    </div>
    
</body>
</html>