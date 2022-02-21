<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <script src='assets/bootstrap/js/bootstrap.min.js'></script>
    <script src="assets/bootstrap/js/jquery.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="rm.ico" />

    <title>Search Results</title>
</head>

<style>
    .nav{
        height: 60px;
        background-color: rgba(0, 17, 255, 0.877);
        color: white;
        font-family: tahoma;
        text-align: center;
    }
    .nav-items{
        width: 800px;
        margin: 0 auto;   
        font-size: 30px;
    }
    #searchbox{
        width: 400px;
        height: 25px;
        border-radius: 5px;
        font-size: 15px;
        border: none;
        padding: 4px;
   
    }
    .img{
        width: 80px;
        border-radius: 50%; 
        padding: 5px;
    }
    
    .clear{
        clear: both;
    }

    .center{
        text-align: center;
    }

    #main{
        height: 720px;
    }

    #div1{
        width: 670px;
        height: 670px;
        display: inline-block;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 10px 0 rgba(0, 0, 0, 0.19);
        overflow: auto;
    }

    #div2{
        width: 670px;
        height: 670px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 10px 0 rgba(0, 0, 0, 0.19);
        display: inline-block;
        overflow: auto;
    }
    .div1{
        float: left;  
        padding: 5px;
      
    }
    h3{
        margin: 10px;
        padding: 10px;
    }

    #af{
            border-radius: 12px;
            width: 100px;
            background-color: rgb(11, 223, 82);
            color: white;
            padding: 2px;
            border: 1px solid black;
        }

    #vp{
            border-radius: 12px;
            width: 100px;
            background-color: rgb(190, 76, 48);
            color: white;
            padding: 2px;
            border: 1px solid black;
    }
    .sp{
        padding: 20px;
        margin-left: 50px;
    }
</style>

<body>
    <div class="nav"> 
        <div class="nav-items">
            ReachMe &nbsp <input type="text" id="searchbox" placeholder="Search....">
            <i class="fas fa-search fa-xs"></i> 
        </div>
    </div>

    <div id="main" contenteditable="false">


        <div  id="div1" data-mdb-perfect-scrollbar="true">

            <h3 class="center">Contents</h3>
            <hr>

            <div class="div1">
                <img class="img" src="files/images/arnabxero_profile.jpg" alt="profile"><br>
            </div>

            <div class="div2" >
         
                <h3> Iftekhar Ahmed Arnab </h3>
                <h6> 18:33 AM</h6>
                <p class="sp">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, 
                but also the leap into electronic typesetting, remaining essentially unchanged. <a href="">Read more..</a></p>
                
            </div>
            <hr>

        </div>

        <div  id="div2" data-mdb-perfect-scrollbar="true">

            <h3 class="center">Profiles</h3>
            <hr>

            <div class="div1">
                <img class="img" src="files/images/arnabxero_profile.jpg" alt="profile"><br>
            </div>
            
            <div class="div2" >
         
                <h3> Iftekhar Ahmed Arnab </h3>
                <form action="POST">
                    <input type="submit" name="Add Friend" id="af" value="Add Friend">
                    <input type="submit" name="View Profile" id="vp" value="View Profile">
                </form>
                <hr>
                
                
            </div>

            <div class="div1">
                <img class="img" src="files/images/arnabxero_profile.jpg" alt="profile"><br>
            </div>
            <div class="div2" >
         
                <h3> Iftekhar Ahmed Arnab </h3>
                <form action="POST">
                    <input type="submit" name="Add Friend" id="af" value="Add Friend">
                    <input type="submit" name="View Profile" id="vp" value="View Profile">
                </form>
                <hr>
                
                
            </div>

            <div class="div1">
                <img class="img" src="files/images/arnabxero_profile.jpg" alt="profile"><br>
            </div>
            <div class="div2" >
         
                <h3> Iftekhar Ahmed Arnab </h3>
                <form action="POST">
                    <input type="submit" name="Add Friend" id="af" value="Add Friend">
                    <input type="submit" name="View Profile" id="vp" value="View Profile">
                </form>
                <hr>
                
                
            </div>

            <div class="div1">
                <img class="img" src="files/images/arnabxero_profile.jpg" alt="profile"><br>
            </div>
            <div class="div2" >
         
                <h3> Iftekhar Ahmed Arnab </h3>
                <form action="POST">
                    <input type="submit" name="Add Friend" id="af" value="Add Friend">
                    <input type="submit" name="View Profile" id="vp" value="View Profile">
                </form>
                <hr>
                
                
            </div>

            <div class="div1">
                <img class="img" src="files/images/arnabxero_profile.jpg" alt="profile"><br>
            </div>
            <div class="div2" >
         
                <h3> Iftekhar Ahmed Arnab </h3>
                <form action="POST">
                    <input type="submit" name="Add Friend" id="af" value="Add Friend">
                    <input type="submit" name="View Profile" id="vp" value="View Profile">
                </form>
                <hr>
                
                
            </div>


        </div>
        



        </div>


    </div>
    

</body>

</html>