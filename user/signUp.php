
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

		<!-- Website CSS style -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- Website Font style -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<link rel="stylesheet" href="style.css">
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

		<title>Registration</title>
    </head>
	<body>

		<div class="container">
			<div class="row main">
				<div class="main-login main-center">
				<h2><a style="color: orange;" href="../../developers/developers.php?">Developers</a> Sign Up</h2>


					<form method="post" action="signUp_action.php">

                        <div class="form-group">
                            <label for="user_id" class="cols-sm-2 control-label">ID</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>


                <input type="id" class="form-control" name="user_id" id="user_id"  placeholder="Enter your ID"/>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="pw" class="cols-sm-2 control-label">Password</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                  <input type="password" class="form-control" name="pw" id="password"  placeholder="Enter your Password"/>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="pwc" class="cols-sm-2 control-label">Confirm Password</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                  <input type="password" class="form-control" name="pwc" id="confirm"  placeholder="Confirm your Password"/>
                </div>
              </div>
            </div>

          	<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Your Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="name" id="name"  placeholder="Enter your Name"/>
								</div>
							</div>
						</div>
                        <div class="form-group">
                            <label for="nickname" class="cols-sm-2 control-label">Your NickName</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="nickname" id="nickname"  placeholder="Enter your NickName"/>
                                </div>
                            </div>
                        </div>


						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Your Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="email" id="email"  placeholder="Enter your Email"/>
								</div>
							</div>
						</div>





						<div class="form-group ">
              <input type="submit" value="Register" class="btn btn-primary btn-lg btn-block login-button">
              							<!-- <a href="" target="_blank" type="button" id="button" class="btn btn-primary btn-lg btn-block login-button">Register</a> -->
						</div>

					</form>
				</div>
			</div>
		</div>

		 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	</body>
</html>
