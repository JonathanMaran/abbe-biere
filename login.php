<?php
debug($_POST);
debug($_SESSION);

//new customer
if (!empty($_POST['first_name'])){
    $post_information=array(
        'first_name'=> FILTER_SANITIZE_STRING,
        'last_name'=> FILTER_SANITIZE_STRING,
        'email'=>FILTER_VALIDATE_EMAIL,
        'password1'=>FILTER_SANITIZE_STRING,
        'password2'=>FILTER_SANITIZE_STRING
    );
    $customer_information=filter_input_array(INPUT_POST,$post_information);
    if ($customer_information['password1']==$customer_information['password2']){
        addnewcustomer($BDD,$customer_information['fist_name'],$customer_information['last_name'],$customer_information['email'],$customer_information['password1']);
    }


    //old customer
} else{
    $post_information=array(
        'email'=>FILTER_VALIDATE_EMAIL,
        'password'=>FILTER_SANITIZE_STRING
    );
    $customer_information=filter_input_array(INPUT_POST,$post_information);
    findcustomer($BDD,$customer_information['email'],$customer_information['password']);
}





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
                <button class="btn btn-dark btn-block my-4" type="submit">Connection</button>
            </form>
        </div>


        <div class="col-12 col-md-6">
            <!-- Default form register -->
            <form class="text-center border border-light p-5"  method="post">

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
                <button class="btn btn-dark my-4 btn-block" type="submit">Connection</button>
            </form>
            <!-- Default form register -->
        </div>
    </div>


</div>

<!-- Default form login -->