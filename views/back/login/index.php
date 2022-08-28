<?php

    view('back/templates/header.php');


?>


    <main class="row">
        <div class="col-3 bg-white mx-auto my-5 py-3">
            <div class="row">
                <div class="col text-center">
                    <h1>Login </h1>
                </div>
        </div>
            <div class="row">
                <div class="col-12">
                    <form action="<?php  echo url('login/check'); ?>" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                               <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" value="yes" class="form-check-input" id="remember">
                            <label for="remember" class="form-check-label">Remember Me</label>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-info">
                                <i class="fa-solid fa-sign-in me-2" ></i>Login
                            </button>
                        </div>


                    </form>
                </div>
            </div>


            </div>
    </main>

<?php
    view('back/templates/footer.php');
?>
