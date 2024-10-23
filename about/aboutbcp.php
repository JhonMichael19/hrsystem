<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>About BCP HR</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
            *{
                padding: 0;
                margin: 0;
                box-sizing: border-box;
                font-family: poppins;
                
            }
            body{
                background-image: linear-gradient(rgba(0,0,0,0.75),rgba(0,0,0,0.75)),url(background6.jpg);
            }
            .navbar{
            width: 95%;
            margin: auto;
            padding: 35px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            }
            .navbar ul li{
            list-style: none;
            display: inline-block;
            margin: 0 20px;
            position: relative;
            }
            .navbar ul li a{
            text-decoration: none;
            color: #fff;
            text-transform: uppercase;
            }
            .navbar ul li::after{
            content: '';
            height: 3px;
            width: 0;
            background: #0206ff; 
            position: absolute;
            left: 0;
            bottom: -10px;
            transition: 0.5s;
            }
            .navbar ul li:hover::after{
            width: 100%;
            }
            
            .logo{
                display: flex;
                position: relative;
                width: 120px;
                cursor: pointer;
                padding: 1%;
            }
            #about-section {
                width: 100%;
                height: auto;
                display: flex;
                justify-content: space-around;
                align-items: center;
                padding: 80px 12%;
            }
            .about-left img{
                width: 420px;
                height: auto;
                transform: translateY(50px);
            }
            .about-right {
                width: 54%;
            }

            .about-right ul li {
                display: flex;
                align-items: center;
            }

            .about-right h1 {
                color: #fff;
                font-size: 37px;
                margin-bottom: 5px;
            }
            
            .about-right p {
                color: #fff;
                line-height: 26px;
                font-size: 15px;
            }

            .about-right .address {
                margin: 25px 0;
            }

            .about-right .address ul li {
                margin-bottom: 5px;
            }

            .address .address-logo {
                margin-right: 15px;
                color: rgb(21, 170, 219);
            }

            .address .saprater {
                margin: 0 35px;
            }

            .about-right .expertise ul {
                width: 80%;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .expertise h3 {
                margin-bottom: 10px;
                color: #fff;
            }

            .expertise .expertise-logo {
                font-size: 19px;
                margin-right: 10px;
                color: #fff;
            }
            
        </style>
    </head>

    <body>
        
        <div class="navbar">
        <a href="http://localhost/hrsystem/frontpage/fp.php"><img src="logo.png.png" class="logo"></a>
        <ul>
            <li><a href="http://localhost/hrsystem/frontpage/fp.php">Home</a></li>
            <li><a href="https://www.facebook.com/bcp.nwslnk">BCP News</a></li>
            <li><a href="http://localhost/hrsystem/login_reg/login.php">Log In</a></li>
        </ul>
        </div>
        <section id="about-section">
           
            <div class="about-left">
                <img src="about-us.png" alt="About Img"/>
            </div>

            
            <div class="about-right">
                <h1>About BCP</h1>
                <h1>Human Resources Department</h1>
                <p>VISION<br>
                    The Human Resources Department envisions an organization equipped with competent,God-fearing, diligent, and reliable teaching personnel and administrative group who can work with minimal supervisions and functions collaboratively towards achieving a common goal.
                    
                    <br>MISSION<br>
                    To become effective and humane individuals for the service of Bestlink College of the Philippines' clienteles.
                </p> 
        
                <div class="address">
                    <ul>
                        <li>
                            <span class="address-logo">
                                <i class="fas fa-paper-plane"></i>
                            </span>
                            <p>Address</p>
                            <span class="saprater">:</span>
                            <p>1071 Barangay Kaligayahan, Quirino Highway, Novaliches, Quezon City, Philippines</p>
                        </li>
                        <li>
                            <span class="address-logo">
                                <i class="fas fa-phone-alt"></i>
                            </span>
                            <p>Facebook Page ID/Contacts</p>
                            <span class="saprater">:</span>
                            <p>2009862305936160/284428601</p>
                        </li>
                        <li>
                            <span class="address-logo">
                                <i class="far fa-envelope"></i>
                            </span>
                            <p>Email ID</p>
                            <span class="saprater">:</span>
                            <p>BestlinkHRD@bcp.edu.ph</p>
                        </li>
                    </ul>
                </div>
                <div class="expertise">
                    <h3>Open Hours/Days</h3>
                    <ul>
                        <li>
                            
                            <p>Monday: 8:00 - 17:00</p>
                        </li>
                        <li>
                            
                            <p>Tuesday: 8:00 - 17:00</p>
                        </li>
                        <li>
                           
                            <p>Wednesday: 8:00 - 17:00</p>
                        </li>
                        <li>
                            
                            <p>Tuesday: 8:00 - 17:00</p>
                        </li>

                        <li>
                            
                            <p>Friday: 8:00 - 17:00</p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </body>

</html>
