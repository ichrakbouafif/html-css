<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
</head>
<body>
    <section class="section3">
    <div class="formulaire">
        <?php
        if (isset($_POST["submit"])){
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $sexe = $_POST["sexe"];
            $product = $_POST["product"];
            $notification = $_POST["notification"];
            $errors = array();

            if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
             array_push($errors,"All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
             array_push($errors, "Email is not valid");
            }
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount>0) {
             array_push($errors,"Email already exists!");
            }
            if (count($errors)>0) {
                foreach ($errors as  $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
               }else{
                $stmt = $conn->prepare("insert into users(firstname, lastname, sexe, email, phone, product) values(?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssis", $firstname, $lastname, $sexe, $email, $phone);
		$execval = $stmt->execute();
		echo $execval;
		echo "Registration successfully...";
		$stmt->close();
		$conn->close();
           }
               }
        


        ?>
        <form class="signin" action="registration.php" method="POST">
            <fieldset style="background-color: rgba(252, 200, 209,0.7);border-radius: 10px;">
                <h1 style="color:#D14D72;font-size: 32px;margin: 10px ; padding-left: 30%;">Sign up for free</h1>
            
             
                <div class="inside">
                  <div class="firstLastName">
                   <div class="first">
                     <label for="name"  class="lab">First Name</label>
                   <input type="text" placeholder="First Name" class="box" id="first-name" required  name="firstname">
                   <br>
                   </div>
                  <div  class="last">
                   <label for="Last Name"  class="lab">Last Name</label>
                   <input type="text" placeholder="Last Name" class="box" id="last-name" required name="lastname">
                   <br>
                  </div>
                  </div>

                   <div class="emailPhone">
                    <div class="eemail">
                     <label for="Email" class="lab">Email &ensp;&ensp;&nbsp;&nbsp;</label>
                     <input type="text" placeholder="Email" class="box" id="email" required   name="email">
                     <br>
                    </div>

                  <div class="pphone">
                   <label for="Phone" class="lab">Phone &ensp;&ensp;&nbsp; </label>
                  <input type="text" placeholder="Phone" class="box" id="phone" required name="phone">
                  <br>
                  </div>
                   </div>

                   <label for="">Sex &ensp; &ensp;</label>
                   <label for="">
                   <input type="radio" name="sexe" id="men" value="man">Men&ensp;
                   </label>
                   <label for="">
                   <input type="radio" name="sexe" id="women" value="woman">Women&ensp;
                   </label>
                   <br>
                   <label for="" class="lab">Products &ensp; </label>
                   <select name="product" id="" class="product">
                    <option value="makeup" id="opt">Makeup</option>
                    <option value="haircare" id="opt">Hair Care</option>
                    <option value="skincare" id="opt">Skin Care</option>
                    <option value="bodycare" id="opt">Body Care</option>
                    <option value="perfumes" id="opt">Perfumes</option>
                   </select>
                    <br>
                    
                   <label for="" class="iWant">I want to recieve notifications</label> 
                   <input type="checkbox" required name="notification" value="yes">
                   <br>
                    <Label><strong>Any Question? <br></strong> Feel Free To Ask Us </Label>
                    <br>
                    <textarea name="" id="" cols="40" rows="5" class="textarea" name="question"> </textarea>
                    <br>
                <div>
                    <button class="btnform" id="signup-button" name="submit" value="register">Sign up</button>
                    <script>
                      const firstNameInput = document.querySelector('#first-name');
                      const lastNameInput = document.querySelector('#last-name');
                      const emailInput = document.querySelector('#email');
                      const phoneInput = document.querySelector('#phone');
                      const signupButton = document.querySelector('#signup-button');
                      // Fonction pour vérifier si tous les champs sont remplis
                      function areAllFieldsFilled() {
                      if(firstNameInput.value.trim() === '' || lastNameInput.value.trim()==='' || emailInput.value.trim() === '' || phoneInput.value.trim() === '') {
                      return false;
                      }
                      return true;
                      }
                       // Fonction pour ajouter une bordure rouge aux champs vides
                       function addRedBorderToEmptyFields() {
                       if(firstNameInput.value.trim() === '') {
                         firstNameInput.style.border = '2px solid red';
                       }
                       if(lastNameInput.value.trim() === '') {
                         lastNameInput.style.border = '2px solid red';
                        }
                       if(emailInput.value.trim() === '') {
                        emailInput.style.border = '2px solid red';
                       }
                       if(phoneInput.value.trim() === '') {
                         phoneInput.style.border = '2px solid red';
                       }
                       }
                         // Fonction pour enlever la bordure rouge des champs de saisie
                        function removeRedBordersFromFields() {
                        firstNameInput.style.border = '';
                        lastNameInput.style.border='';
                        emailInput.style.border = '';
                        phoneInput.style.border = '';
                       }
                       // Fonction pour afficher une boîte de dialogue d'alerte
                        function showAlert(message) {
                        alert(message);
                       }
                       signupButton.addEventListener('click', function() {
                       // Vérification si tous les champs sont remplis
                       if(!areAllFieldsFilled()) {
                        // Ajout d'une bordure rouge aux champs de saisie vides
                       addRedBorderToEmptyFields();
                       // Affichage d'une boîte de dialogue d'alerte
                       showAlert('Please fill in all fields');
                       } else {
                      // Enlever la bordure rouge des champs de saisie
                      removeRedBordersFromFields();
                      // Affichage d'une boîte de dialogue d'alerte
                      showAlert('Registration completed successfully! please check your registration email for email verification');

                      }
                     });


                      </script>
                </div>
                </div>           
            </fieldset>
        </form>
    </div>
</body>
</html>