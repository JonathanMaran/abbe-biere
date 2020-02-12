<?php

//logique page login
//new customer
debug($_SESSION);
debug($_POST);

//nouveau client
if (!empty($_POST)) {
    if (isset($_POST['new_client']) and ($_POST['new_client']) === 'yes') {
        if (!empty($_POST['first_name'] and $_POST['last_name'] and $_POST['email'] and $_POST['password1'] and $_POST['password2']) and $_POST['password1'] === $_POST['password2']) {
            $post_information = array(
                'first_name' => FILTER_SANITIZE_STRING,
                'last_name' => FILTER_SANITIZE_STRING,
                'email' => FILTER_VALIDATE_EMAIL,
                'password1' => FILTER_SANITIZE_STRING,
                'password2' => FILTER_SANITIZE_STRING
            );
            $customer_information = filter_input_array(INPUT_POST, $post_information);
            $password = password_hash($customer_information['password1'], PASSWORD_DEFAULT);
            addnewcustomer($BDD, $customer_information['first_name'], $customer_information['last_name'], $customer_information['email'], $password);
            if (!empty($_SESSION['cart'])) {
                header('Location: index.php?page=panier', true, 302);
                exit();
            } else {
                header('Location: index.php?page=home', true, 302);
            }
        } else {
            $message = 'une erreur est survenue lors de l\'enregistrement, Merci de recommencer';
        }
        //ancien client
    } elseif (!empty($_POST['identify']) === 'yes') {
        if (!empty($_POST['email'] and $_POST['password'])) {
            $post_information = array(
                'email' => FILTER_VALIDATE_EMAIL,
                'password' => FILTER_SANITIZE_STRING,
            );
            $customer_information = filter_input_array(INPUT_POST, $post_information);
            $password = password_hash($customer_information['password'], PASSWORD_DEFAULT);
            findcustomer($BDD, $customer_information['email'], $password);
        }
    }
}
include 'header.php'
?>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <!-- Default form login -->
                <form class="text-center border border-light p-5" method="post">

                    <p class="h4 mb-4">Déja client</p>


                    <!-- Email -->
                    <label for="email"></label>
                    <input type="email" id="Email" name="email" class="form-control mb-4" placeholder="E-mail">

                    <!-- Password -->
                    <label for="password"></label>
                    <input type="password" id="Password" name="password" class="form-control mb-4"
                           placeholder="Password">

                    <div class="d-flex justify-content-around">

                    </div>

                    <!-- Sign in button -->
                    <button class="btn btn-dark btn-block my-4" type="submit" name="identify" value="yes">Connexion
                    </button>
                </form>
            </div>


            <div class="col-12 col-md-6">
                <!-- Default form register -->
                <form class="text-center border border-light p-5" method="post">

                    <p class="h4 mb-4">Nouveau Client</p>

                    <div class="form-row mb-4">
                        <div class="col">
                            <!-- First name -->
                            <label for="first_name"></label>
                            <input type="text" id="FirstName" name="first_name" class="form-control" placeholder="Nom">

                        </div>
                        <div class="col">
                            <!-- Last name -->
                            <label for="last_name"></label>
                            <input type="text" id="LastName" name="last_name" class="form-control" placeholder="Prenom">

                        </div>
                    </div>

                    <!-- E-mail -->

                    <label for="email"></label>
                    <input type="email" id="defaultRegisterFormEmail" name="email" class="form-control mb-4"
                           placeholder="E-mail">


                    <!-- Password -->

                    <label for="password"></label>
                    <input type="password" id="Password" name="password1" class="form-control"
                           placeholder="Password">


                    <!-- Password -->

                    <label for="password"></label>
                    <input type="password" id="Password" name="password2" class="form-control"
                           placeholder="Password">


                    <!-- Sign up button -->
                    <button class="btn btn-dark my-4 btn-block" name="new_client" value="yes" type="submit">Connexion
                    </button>
                </form>
                <!-- Default form register -->
            </div>
        </div>


    </div>

    <!-- Default form login -->
<?php
include 'footer.php';