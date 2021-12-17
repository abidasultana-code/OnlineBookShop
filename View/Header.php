       <!-- Header Section Begin -->
       <header class="header">
    
           <div class="container">

               <div class="header__top__right">
                   <div class="header__top__right__auth">
    

                   </div>
               </div>

               <div class="row">
                   <div class="col-lg-3">
                       <div class="header__logo">
                           <a href="index.php"><img src="../Assets/img/logo.png" alt="" style="height: 60px; margin-top: -30px;"></a>
                           <p style="font: 30px solid bold; color:green">Online Book Shop</p>
                       </div>
                   </div>
                   <div class="col-lg-6" style="padding-left: 50px;">
                       <nav class="header__menu">
                           <ul>
                               <!-- <li class="active"><a href="index.php">Home</a></li> -->
                               <li><a href="http://localhost/bookShop/">Home</a></li>
                               <li><a href="http://localhost/bookShop/View/contact.php">Contact Us</a></li>

                               <!-- <li><a href="chat.php">Nutritionist</a></li> -->
                           </ul>
                       </nav>
                   </div>
                   <div class="col-lg-3">
                       <div class="header__cart">
                           <ul id="bellIcon" onclick="openModal(),updateNoti();">
                               <!-- here you will increment the count from mysql db-->
                               <li id="shoppingC"><a style="cursor: pointer;"><i class="fa fa-bell"></i> <span> </span></a></li>
                           </ul>
                           <ul id="shoppingBag" onclick="redirect();">
                               <!-- here you will increment the count from mysql db-->
                               <li id="shoppingC"><a href="shoping-cart.php"><i class="fa fa-shopping-bag"></i> <span></span></a></li>
                           </ul>
                           <!-- #<div class="header__cart__price">item: <span>$150.00</span></div> -->
                       </div>
                   </div>
               </div>
               <div class="humberger__open">
                   <i class="fa fa-bars"></i>
               </div>
           </div>
       </header>
       <!-- Header Section End -->

       <script>
           function redirect() {
               window.location.href = "shoping-cart.php";
           }
       </script>