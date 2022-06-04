<?php include './header.php' ?>

<link rel="stylesheet" href="style.css">

<!-- home section starts  -->

<div class="home" id="home">

    <div class="image">
        <img src="images/carousle.jpg">
    </div>
    
</div><br><br><br><br><br><br><br>

<!-- home section ends -->

<!-- banner section starts  -->



<!-- banner section ends -->



<!-- explore section starts  -->

<section class="posts" id="posts">

    <h1 class="heading">pets for <span>you</span></h1>

    <div class="box-container">

       

       
    <?php
        require_once "./config.php";

        $sql = "SELECT id, first_name, last_name, img,Age_group,State,Pet_Name FROM pet_posts WHERE Activate=1";
        
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
             echo ' <div class="box">
            
             <a href="">
             <img src="./images/posts/'.$row["img"].'" alt="'.$row["Pet_Name"].'"><a>
             <h3>'.$row["Pet_Name"].'</h3>
             
             <div class="discpn">
                 <span>'.$row["Age_group"].' .</span>
                 <span>'.$row["State"].'</span>
             </div>';
            
             if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
             {
                echo '<a href="./vpost.php?page='.$row["id"].'" class="btn">View</a>';
             }else{
                echo '<a href="./login_form.php" class="btn">View</a>';
             }   
        
         echo '</div>';
        
        
          }
        } 
        $conn->close();

       
?>

    </div>

</section>

<!-- explore section ends -->

<!-- category section starts  -->

<section class="category" id="category">

    <h1 class="heading">Food for <span>pets</span></h1>

    <div class="box-container">

        <div class="box">
            
            
            <img src="images/pedigree.jpg" alt="">
            <p>Pedigree Adult Dry Dog Food, Chicken & Vegetables, 3kg Pack</p>
            <a href="https://www.amazon.in/Pedigree-Adult-Food-Chicken-Vegetables/dp/B00LHS8I3A/ref=sr_1_7?keywords=Pet+Food&qid=1643048495&sr=8-7" class="btn">buy from amazon</a>
        </div>
        <div class="box"><br><br>
            <img src="images/chappy.jpg" alt=""><br><br><br>
            <p>Chappi Puppy Dry Pellet Dog Food, Chicken & Milk, 8 kg</p>
            
            <a href="https://www.amazon.in/Chappi-Puppy-Food-Chicken-Milk/dp/B08R162JZC/ref=sr_1_4_sspa?keywords=Pet%2BFood&qid=1643091137&sr=8-4-spons&spLa=ZW5jcnlwdGVkUXVhbGlmaWVyPUFRTU5LUldGRDMzVE0mZW5jcnlwdGVkSWQ9QTAyNjk1MzQxQk8ySldVS1dSUkhCJmVuY3J5cHRlZEFkSWQ9QTAxNTAxODcxSENCQVFIRDBYVzRSJndpZGdldE5hbWU9c3BfYXRmJmFjdGlvbj1jbGlja1JlZGlyZWN0JmRvTm90TG9nQ2xpY2s9dHJ1ZQ&th=1" class="btn">buy from amazon</a>
        </div>
        <div class="box"><br><br>
            <img src="images/purepet.jpg" alt=""><br><br><br>
            <p>Purepet Tuna and Salmon Adult Cat,Dry,7 kg</p><br><br>
            
            <a href="https://www.amazon.in/Purepet-Tuna-Salmon-Adult-Cat/dp/B07B2X17FG/ref=sxin_14?adgrpid=65751424784&cv_ct_cx=cat+food%27&ext_vrnc=hi&gclid=Cj0KCQiAubmPBhCyARIsAJWNpiPDZlAnKthGyhzeWwQXyvdx0WhqROhIu_KpIgjNlb5YWRbXFeYkKwIaAqhcEALw_wcB&hvadid=294145041064&hvdev=c&hvlocphy=9303196&hvnetw=g&hvqmt=e&hvrand=5800488642593170951&hvtargid=kwd-348626812541&hydadcr=29624_1809132&keywords=cat+food%27&pd_rd_i=B07B2X17FG&pd_rd_r=b4dc2ece-f9ba-4d31-a566-2fff418ffb8d&pd_rd_w=JWAVb&pd_rd_wg=n7Rl7&pf_rd_p=9fcf7fd6-b4b5-451a-8539-a9cd09f94598&pf_rd_r=4FF8V2RR14C15JS9T4A8&qid=1643092111&sr=1-1-571618a2-1e9e-49c4-ae7e-d71a2ef34bdd" class="btn">buy from amazon</a>
        </div>
        <div class="box"><br><br>
            <img src="images/drools.jpg" alt=""><br><br><br>
            <p>Drools Kitten Dry Cat Food, Ocean Fish - 4kg (3kg + 1kg Free Food Inside)</p>
            
            <a href="https://www.amazon.in/Drools-Ocean-Kitten-Inside-Limited/dp/B01MRI3DXA/ref=sr_1_20?adgrpid=65751424784&ext_vrnc=hi&gclid=Cj0KCQiAubmPBhCyARIsAJWNpiPDZlAnKthGyhzeWwQXyvdx0WhqROhIu_KpIgjNlb5YWRbXFeYkKwIaAqhcEALw_wcB&hvadid=294145041064&hvdev=c&hvlocphy=9303196&hvnetw=g&hvqmt=e&hvrand=5800488642593170951&hvtargid=kwd-348626812541&hydadcr=29624_1809132&keywords=cat+food%27&qid=1643092111&sr=8-20" class="btn">buy from amazon</a>
        </div>

    </div>

</section>

<!-- category section ends -->

<!-- deal section starts  -->

<section class="deal" id="deal">

    <div class="content">

        <h3 class="title">adoptme</h3>
        <p>Adoptme is an online, searchable database of animals who need homes. It is a platform for pet lovers where they can adopt pets and sell pets for free which is situated in India. Organizations maintain their own home pages and available-pet databases.</p>

    </div>

</section>

<!-- deal section ends -->

<!-- contact section starts  -->

<section class="contact" id="contact">

    <h1 class="heading"> <span>Querry</span> us </h1>

    
    <form action="./query.php" method="post">

        <div class="inputBox">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="inputBox">
            <input type="number" name="number" placeholder="Number" required>
            <input type="text" name="subject" placeholder="Subject" required>
        </div>

        <textarea placeholder="Message" name="msg" id="" cols="30" rows="10" required></textarea>

        <input type="submit" value="Send message" class="btn">

    </form>

</section>

<!-- contact section ends -->

<!-- newsletter section starts  -->

<section class="newsletter">

    <h3>subscribe us for latest updates</h3>

    <form action="./subscriber.php" method="post">
        <input class="box" name="sub_email" type="email" placeholder="Enter your email" required>
        <input type="submit" value="Subscribe" class="btn">
    </form>

</section>

<!-- newsletter section ends -->

<!-- footer section starts  -->

<section class="footer">

    <div class="box-container">

        <div class="box">
            <a href="#" class="logo"><i class="fas fa-adoption"></i>Adoptme</a>
            <p>Adoptme is an online, searchable database of animals who need homes. It is a platform for pet lovers where they can adopt pets and sell pets for free which is situated in India. Organizations maintain their own home pages and available-pet databases.</p>
            <div class="share">
                <a href="#" class="btn fab fa-facebook-f"></a>
                <a href="#" class="btn fab fa-twitter"></a>
                <a href="#" class="btn fab fa-instagram"></a>
                <a href="#" class="btn fab fa-linkedin"></a>
            </div>
        </div>
        
        <div class="box">
            <h3>our location</h3>
            <div class="links">
                <a href="#">india</a>
                <a href="#">USA</a>
                <a href="#">france</a>
                <a href="#">japan</a>
                <a href="#">russia</a>
            </div>
        </div>

        <div class="box">
            <h3>quick links</h3>
            <div class="links">
                <a href="#home">home</a>
                <a href="#deal">About us</a>
                <a href="#posts">explore</a>
                <a href="#contact">contact us</a>
                <a href="#">contact</a>
            </div>
        </div>

        <div class="box">
            <h3>download app</h3>
            <div class="links">
                <a href="#">google play</a>
                <a href="#">window xp</a>
                <a href="#">app store</a>
            </div>
        </div>

    </div>

    <h1 class="credit"> created by <span>we are developer</span> | all rights reserved! </h1>

</section>

<!-- footer section ends -->



















<!-- custom js file link  -->
<script src="script.js"></script>
    
</body>
</html>