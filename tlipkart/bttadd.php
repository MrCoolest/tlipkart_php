<?php
require_once "./config.php";
session_start();
$submit = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  

    $user = intval($_SESSION['id']);
    $f_name = $_POST['first_name'];
    $l_name = $_POST['last_name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $pet_name = $_POST['pet_name'];
    $pet_type = $_POST['sellist1'];
    $category = $_POST['sellist2'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $age_group = $_POST['sellist3'];
    $Colour = $_POST['colour'];
    $City = $_POST['city'];
    $State = $_POST['state'];
    $Country = $_POST['country'];
    $temp = explode(".", $_FILES["img_file"]["name"]);
    $image = 'User_id_'.$user.'_'.round(microtime(true)).'.' . end($temp);
    $img_tem_loc=$_FILES['img_file']['tmp_name'];
    $discription = $_POST['discription'];
    $img_store="./images/posts/".$image;

    move_uploaded_file($img_tem_loc,$img_store);
    $sql = "INSERT INTO `pet_website`.`pet_posts` (`user_id`, `First_name`, `Last_name`, `email`, `contact_no`, `Address`, `Pet_Name`, `Pet_type`, `Category`, `Bread`, `Age`, `Age_group`, `Colour`, `city`, `State`, `Country`, `img`, `Description`) VALUES ('$user', '$f_name', '$l_name', '$email', '$contact', '$address', '$pet_name', '$pet_type', '$category', '$breed', '$age', '$age_group', '$Colour', '$City', '$State', '$Country', '$image', '$discription');";

    if($conn -> query($sql)){
        $submit = "Submit Successfull!";
    }
    else{
        $submit = "Error : $sql <br> $conn->error";
    }

    // echo $submit;
    // Close the database conection     
$conn->close(); 
// header("location:./index.php");
header("Refresh:0");
exit;
}

// INSERT INTO `pet_posts` (`id`, `user_id`, `First_name`, `Last_name`, `email`, `contact_no`, `Address`, `Pet_Name`, `Pet_type`, `Category`, `Bread`, `Age`, `Age_group`, `Colour`, `city`, `State`, `Country`, `img`, `Description`) VALUES ('2', '1', 'sdfvrbwt', 'ergrtget4r', 'hge4tretg', 'regetrhetrget', 'trhgterg4wteh', 'wregtegw4', 'wegergtrg', 'erwgwtgwg', 'regetgetr', 'rhgertetret', 'trhetrhetr', 'etrhetre', 'ertherthertet', 'ethetret', 'terherthe', 'tehertetr', 'trhertheret')
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- custom CSS --> 
    <link rel="stylesheet" href="number.css">
    <title>Hello, world!</title>
  </head>
  <body>
      <div class="container p-5 mb-4 bg-light border rounded-3 ">
          <form name="myform" action="./bttadd.php" method="post" class="form-group " enctype="multipart/form-data">
              <h3 style="text-align: center; font-weight: bold;">Post a Pet</h3><br>
              <h3 style="text-align: center; font-weight: bold;"><?php echo $submit; ?></h3><br>

              <div class="row ">
                  <div class="col-md-6">
                      <label style="font-weight: bold;" for="inputname">First name</label>
                      <input type="text" class="form-control" name='first_name' placeholder="First name" required><br>
                  </div><br>

                  <div class="col-md-6">
                      <label style="font-weight: bold;" for="inputname">Last name</label>
                      <input type="text" class="form-control" name='last_name' placeholder="Last name" required><br>
                  </div><br>
                  <div class="col-md-6">
                      <label style="font-weight: bold;" for="inputemail">Email</label>
                      <input type="text" class="form-control" name='email' placeholder=" Enter your Email" required><br>
                  </div><br>


                  <div class="col-md-6">
                      <label style="font-weight: bold;" for="inputnum">Contact no</label>
                      <input autocapitalize="sentences" autocomplete="tel" autocorrect="on" name='contact' spellcheck="true" type="tel" class="form-control" id="inputnum" pattern="[0-9]{10,12}" placeholder="Enter your 10 or 12 digit contact no"  required><br>
                  </div><br>

                  <div class="col-md-6">
                      <label style="font-weight: bold;" for="inputad">Address</label>
                      <input type="text" class="form-control" name='address' placeholder="Enter your address" required><br>
                  </div><br>

                  <div class="col-md-6">
                      <label style="font-weight: bold;" for="inputpname">Pet name</label>
                      <input type="text" class="form-control" name='pet_name' placeholder="Enter name of your pet" required><br>
                  </div><br>
                  <div class="col-md-6">
                      <label style="font-weight: bold;" for="inputtype">Pet type</label>
                      <select class="form-select" id="sel1" name="sellist1">
                        <option>Dog</option>
                        <option>Cat</option>
                      </select><br>
                  </div><br>



                  <div class="col-md-6">
                      <label style="font-weight: bold;" for="inputctg">Catogogy</label>
                      <select class="form-select" id="sel1" name="sellist2">
                        <option>Male</option>
                        <option>Female</option>
                      </select><br>
                  </div><br>

                  <div class="col-md-6">
                      <label style="font-weight: bold;" for="inputbrd">Breed</label>
                      <input type="text" class="form-control" name='breed' placeholder="Enter breed of your pet" required><br>
                  </div><br>

                  <div class="col-md-6">
                      <label style="font-weight: bold;" for="num">Age</label>
                      <input type="number" id="num" name='age' class="form-control" pattern="(\d+[., \s]?\d?)*" placeholder="Enter age" required min="1"><br>
                  </div><br>

                  <div class="col-md-6">
                      <label style="font-weight: bold;" for="inputagegrp">Age group</label>
                      <select class="form-select" id="sel1" name="sellist3">
                        <option>--Select--</option>
                        <option value='puppy'>Puppy</option>
                        <option value='junior'>Junior</option>
                        <option value='adult'>Adult</option>
                        <option value='mature'>Mature</option>
                        <option value='senior'>Senior</option>
                        <option value='geriatric'>Geriatric</option>
                      </select><br>
                  </div><br>

                  <div class="col-md-6">
                      <label style="font-weight: bold;" for="inputclr">Colour</label>
                      <input type="text" class="form-control" name="colour" placeholder="Enter colour" required><br>
                  </div><br>
                  
                  <div class="col-md-6">
                      <label style="font-weight: bold;" for="inputcity">City</label>
                      <input type="text" class="form-control" name="city" placeholder="Select country and city" ><br>
                  </div><br>
                  <div class="col-md-6">
                      <label style="font-weight: bold;" for="inputstate">State</label>
                      <input type="text" class="form-control" name="state" placeholder="Select country and city" ><br>
                  </div><br>
                  <div class="col-md-6">
                      <label style="font-weight: bold;" for="inputcountries">Country</label>
                      <select class="form-control bfh-countries" name='country' data-country="US"><option value=""></option><option value="AF">Afghanistan</option><option value="AL">Albania</option><option value="DZ">Algeria</option><option value="AS">American Samoa</option><option value="AD">Andorra</option><option value="AO">Angola</option><option value="AI">Anguilla</option><option value="AQ">Antarctica</option><option value="AG">Antigua and Barbuda</option><option value="AR">Argentina</option><option value="AM">Armenia</option><option value="AW">Aruba</option><option value="AU">Australia</option><option value="AT">Austria</option><option value="AZ">Azerbaijan</option><option value="BH">Bahrain</option><option value="BD">Bangladesh</option><option value="BB">Barbados</option><option value="BY">Belarus</option><option value="BE">Belgium</option><option value="BZ">Belize</option><option value="BJ">Benin</option><option value="BM">Bermuda</option><option value="BT">Bhutan</option><option value="BO">Bolivia</option><option value="BA">Bosnia and Herzegovina</option><option value="BW">Botswana</option><option value="BV">Bouvet Island</option><option value="BR">Brazil</option><option value="IO">British Indian Ocean Territory</option><option value="VG">British Virgin Islands</option><option value="BN">Brunei</option><option value="BG">Bulgaria</option><option value="BF">Burkina Faso</option><option value="BI">Burundi</option><option value="CI">Côte d'Ivoire</option><option value="KH">Cambodia</option><option value="CM">Cameroon</option><option value="CA">Canada</option><option value="CV">Cape Verde</option><option value="KY">Cayman Islands</option><option value="CF">Central African Republic</option><option value="TD">Chad</option><option value="CL">Chile</option><option value="CN">China</option><option value="CX">Christmas Island</option><option value="CC">Cocos (Keeling) Islands</option><option value="CO">Colombia</option><option value="KM">Comoros</option><option value="CG">Congo</option><option value="CK">Cook Islands</option><option value="CR">Costa Rica</option><option value="HR">Croatia</option><option value="CU">Cuba</option><option value="CY">Cyprus</option><option value="CZ">Czech Republic</option><option value="CD">Democratic Republic of the Congo</option><option value="DK">Denmark</option><option value="DJ">Djibouti</option><option value="DM">Dominica</option><option value="DO">Dominican Republic</option><option value="TP">East Timor</option><option value="EC">Ecuador</option><option value="EG">Egypt</option><option value="SV">El Salvador</option><option value="GQ">Equatorial Guinea</option><option value="ER">Eritrea</option><option value="EE">Estonia</option><option value="ET">Ethiopia</option><option value="FO">Faeroe Islands</option><option value="FK">Falkland Islands</option><option value="FJ">Fiji</option><option value="FI">Finland</option><option value="MK">Former Yugoslav Republic of Macedonia</option><option value="FR">France</option><option value="FX">France, Metropolitan</option><option value="GF">French Guiana</option><option value="PF">French Polynesia</option><option value="TF">French Southern Territories</option><option value="GA">Gabon</option><option value="GE">Georgia</option><option value="DE">Germany</option><option value="GH">Ghana</option><option value="GI">Gibraltar</option><option value="GR">Greece</option><option value="GL">Greenland</option><option value="GD">Grenada</option><option value="GP">Guadeloupe</option><option value="GU">Guam</option><option value="GT">Guatemala</option><option value="GN">Guinea</option><option value="GW">Guinea-Bissau</option><option value="GY">Guyana</option><option value="HT">Haiti</option><option value="HM">Heard and Mc Donald Islands</option><option value="HN">Honduras</option><option value="HK">Hong Kong</option><option value="HU">Hungary</option><option value="IS">Iceland</option><option value="IN">India</option><option value="ID">Indonesia</option><option value="IR">Iran</option><option value="IQ">Iraq</option><option value="IE">Ireland</option><option value="IL">Israel</option><option value="IT">Italy</option><option value="JM">Jamaica</option><option value="JP">Japan</option><option value="JO">Jordan</option><option value="KZ">Kazakhstan</option><option value="KE">Kenya</option><option value="KI">Kiribati</option><option value="KW">Kuwait</option><option value="KG">Kyrgyzstan</option><option value="LA">Laos</option><option value="LV">Latvia</option><option value="LB">Lebanon</option><option value="LS">Lesotho</option><option value="LR">Liberia</option><option value="LY">Libya</option><option value="LI">Liechtenstein</option><option value="LT">Lithuania</option><option value="LU">Luxembourg</option><option value="MO">Macau</option><option value="MG">Madagascar</option><option value="MW">Malawi</option><option value="MY">Malaysia</option><option value="MV">Maldives</option><option value="ML">Mali</option><option value="MT">Malta</option><option value="MH">Marshall Islands</option><option value="MQ">Martinique</option><option value="MR">Mauritania</option><option value="MU">Mauritius</option><option value="YT">Mayotte</option><option value="MX">Mexico</option><option value="FM">Micronesia</option><option value="MD">Moldova</option><option value="MC">Monaco</option><option value="MN">Mongolia</option><option value="ME">Montenegro</option><option value="MS">Montserrat</option><option value="MA">Morocco</option><option value="MZ">Mozambique</option><option value="MM">Myanmar</option><option value="NA">Namibia</option><option value="NR">Nauru</option><option value="NP">Nepal</option><option value="NL">Netherlands</option><option value="AN">Netherlands Antilles</option><option value="NC">New Caledonia</option><option value="NZ">New Zealand</option><option value="NI">Nicaragua</option><option value="NE">Niger</option><option value="NG">Nigeria</option><option value="NU">Niue</option><option value="NF">Norfolk Island</option><option value="KP">North Korea</option><option value="MP">Northern Marianas</option><option value="NO">Norway</option><option value="OM">Oman</option><option value="PK">Pakistan</option><option value="PW">Palau</option><option value="PS">Palestine</option><option value="PA">Panama</option><option value="PG">Papua New Guinea</option><option value="PY">Paraguay</option><option value="PE">Peru</option><option value="PH">Philippines</option><option value="PN">Pitcairn Islands</option><option value="PL">Poland</option><option value="PT">Portugal</option><option value="PR">Puerto Rico</option><option value="QA">Qatar</option><option value="RE">Reunion</option><option value="RO">Romania</option><option value="RU">Russia</option><option value="RW">Rwanda</option><option value="ST">São Tomé and Príncipe</option><option value="SH">Saint Helena</option><option value="PM">St. Pierre and Miquelon</option><option value="KN">Saint Kitts and Nevis</option><option value="LC">Saint Lucia</option><option value="VC">Saint Vincent and the Grenadines</option><option value="WS">Samoa</option><option value="SM">San Marino</option><option value="SA">Saudi Arabia</option><option value="SN">Senegal</option><option value="RS">Serbia</option><option value="SC">Seychelles</option><option value="SL">Sierra Leone</option><option value="SG">Singapore</option><option value="SK">Slovakia</option><option value="SI">Slovenia</option><option value="SB">Solomon Islands</option><option value="SO">Somalia</option><option value="ZA">South Africa</option><option value="GS">South Georgia and the South Sandwich Islands</option><option value="KR">South Korea</option><option value="ES">Spain</option><option value="LK">Sri Lanka</option><option value="SD">Sudan</option><option value="SR">Suriname</option><option value="SJ">Svalbard and Jan Mayen Islands</option><option value="SZ">Swaziland</option><option value="SE">Sweden</option><option value="CH">Switzerland</option><option value="SY">Syria</option><option value="TW">Taiwan</option><option value="TJ">Tajikistan</option><option value="TZ">Tanzania</option><option value="TH">Thailand</option><option value="BS">The Bahamas</option><option value="GM">The Gambia</option><option value="TG">Togo</option><option value="TK">Tokelau</option><option value="TO">Tonga</option><option value="TT">Trinidad and Tobago</option><option value="TN">Tunisia</option><option value="TR">Turkey</option><option value="TM">Turkmenistan</option><option value="TC">Turks and Caicos Islands</option><option value="TV">Tuvalu</option><option value="VI">US Virgin Islands</option><option value="UG">Uganda</option><option value="UA">Ukraine</option><option value="AE">United Arab Emirates</option><option value="GB">United Kingdom</option><option value="US">United States</option><option value="UM">United States Minor Outlying Islands</option><option value="UY">Uruguay</option><option value="UZ">Uzbekistan</option><option value="VU">Vanuatu</option><option value="VA">Vatican City</option><option value="VE">Venezuela</option><option value="VN">Vietnam</option><option value="WF">Wallis and Futuna Islands</option><option value="EH">Western Sahara</option><option value="YE">Yemen</option><option value="ZM">Zambia</option><option value="ZW">Zimbabwe</option></select><br>
                  </div><br>
                  
                  <div class="col-md-6">
                      <label style="font-weight: bold;" for="inputname">Add picture</label>
                      <!-- <input accept="image/jpg, image/png, image/jpeg" name="img" type="file" class="form-control" placeholder="Add the photos" required><br> -->
                      <input class="form-control" type="file" name="img_file" id="formFile" accept="image/png, image/jpg, image/jpeg" required/>
                  </div><br>
                  <div class="mb-3 mt-3">
                    <label style="font-weight: bold;" for="comment">Discription</label>
                    <textarea class="form-control" rows="5" id="comment" name="discription" required></textarea>
                  </div>
                  <div class="col-md-12" style="text-align: center;">
                    <input type="submit" class="btn btn-primary" value='submit'>
                    
                  </div>
              </div>
          </form>
      </div>
    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>