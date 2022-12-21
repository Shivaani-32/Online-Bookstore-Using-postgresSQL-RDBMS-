<!DOCTYPE html>
<html lang="en">
<head>
<title>Books Booking(Shivaani S 2020115082)</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
	<link rel="stylesheet" href="style1.css">

    

    
    

    
    
    <style>
	.content{
	display:flex;
	column-gap:50px;
	}
	body{
	background-image: url('bg.jpg');
	}
	



 
  
  
    </style>
</head>

    <?php 
   
	$con=pg_connect("host=localhost port=5432 dbname=db user=postgres password=shivaani");
    $sql="SELECT title, cost, book_id,name,published_date FROM books inner join publishers on publishers.publisher_id=books.publisher_id";
    $result=pg_query($con,$sql);
    $row=pg_fetch_array($result);
    ?>
	
<body>

<header class="header">

    <div class="header-1">

        <a href="#" class="logo"> <i class="fas fa-book"></i> bookTown </a>

        
        </form>

        <div class="icons">
            <div id="search-btn" class="fas fa-search"></div>
            
            <a href="mycart.php" class="fas fa-shopping-cart"></a>
            <div id="login-btn" class="fas fa-user"></div>
        </div>

    </div>

    <div class="header-2">
        <nav class="navbar">
            <a href="index.html">home</a>
            <a href="home 1.php">shop</a>
            <a href="signup.php">Sign up</a>
            
			
        </nav>
    </div>

</header>

<!-- header section ends -->

<!-- bottom navbar  -->

<nav class="bottom-navbar">
    <a href="#home" class="fas fa-home"></a>
    <a href="#featured" class="fas fa-list"></a>
    <a href="#arrivals" class="fas fa-tags"></a>
    <a href="#reviews" class="fas fa-comments"></a>
    <a href="#blogs" class="fas fa-blog"></a>
</nav>

<!-- login form  -->


   
   <div class="content1">

    <form method=post>
        <h3>Sign In</h3>
        <span>Enter Email</span><br>
        <input type="email" name="user_name"   placeholder="Enter Email" id=""><br>
        <span>password</span><br>
        <input type="password" name="password"  placeholder="Password" id=""><br>
        
        <input type="submit" value="sign in" class="btn"><br>
		<a href="signup.php">Not registered? Click to Signup</a><br>
        
    </form>

</div>
<?php 

session_start();

	include("connection.php");
	include("functions.php");
	

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		/*$_SESSION['username']=$_POST['user_name'];
		$_SESSION['cart'][0]=array('Item_Name'=>$_POST['Item_Name'],'Price'=>$_POST['Price'],'Quantity'=>$_POST['Quantity']);
	$sql="select * from icart where username='$user_name'";
	$result = pg_query($con,$sql);
	$i=0;
	while($row = pg_fetch_array($result))
	{
		$_SESSION['cart'][$i]=array('Item_Name'=>$row['item_name'],'Price'=>$row['price'],'Quantity'=>$row['quantity']);
		$i++;
	}
	$sql1="delete from icart where username='$user_name'";
	$result1=pg_query($con,$sql1);*/
		

		

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from users1 where user_name = '$user_name' limit 1";
			$result = pg_query($con, $query);

			if($result)
			{
				if($result && pg_num_rows($result) > 0)
				{

					$user_data = pg_fetch_assoc($result);
					
					if($user_data['passwordd'] === $password)
					{
						
						$_SESSION['user_id'] = $user_data['user_id'];
						$_SESSION['username']=$_POST['user_name'];
						$SESSION['fid']=$user_data['tid'];
		$_SESSION['cart']=array();				
		//$_SESSION['cart'][0]=array('Item_Name'=>$_POST['Item_Name'],'Price'=>$_POST['Price'],'Quantity'=>$_POST['Quantity']);
	$sql="select * from icart where username='$user_data[user_name]'";
	$result = pg_query($con,$sql);
	$i=0;
	$_SESSION['tcart']=0;
	while($row = pg_fetch_array($result))
	{
	$_SESSION['cart'][$i]=array('Item_Name'=>$row['item_name'],'Price'=>$row['price'],'Quantity'=>$row['quantity'],'id'=>$row['book_id']);
		$i++;
		$_SESSION['tcart']+=$row['quantity'];
						}
	$sql1="delete from icart where username='$user_data[user_name]'";
	$result1=pg_query($con,$sql1);
		
						header("Location: mycart.php");
						die;
					}
				}
			}
			
			echo "<h2 class='hh'> Wrong username or password!</h2>";//display appropriate error messages
		}else
		{	echo "<script>alert('Wrong username or password')</script>";
			echo "<h2 class='hh'> Wrong username or password!</h2>";
		}
	}

?>
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>