<?php

    view('back/templates/header.php');
    view('back/templates/nav.php');

?>


    <main class="row">
        <div class="col-12 bg-white my-3 py-3">
            <div class="row">
                <div class="col-5 mx-auto">
                    <h1>Edit Profile </h1>
                </div>
        </div>

            <div class="row">
                <div class="col-5 mx-auto">
                    <form action="<?php echo url('profile/update'); ?>" metho="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control mb-2" value="<?php echo $user->name ?>" required
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control-plaintext mb-2" value="<?php echo $user->email; ?> " disabled>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control mb-2" value="<?php echo $user->phone; ?> " required >
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" class="form-control mb-2"   required><?php echo $user->address; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-info">
                                <i class="fa-solid fa-save me-2"></i>Save
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
