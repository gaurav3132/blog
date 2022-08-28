<header class="row">
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo url('dashboard') ?>">Blogpost</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-users me-2"></i>Author</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-tags me-2"></i>Categories</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-newspaper me-2"></i>Articles</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-comments me-2"></i>Comments</a>
                    </li>

                </ul>
                <ul class="navbar-nav  mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user-circle me-2"></i><?php echo user()->name ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo url('profile/edit'); ?>"><i class="fa-solid fa-user-edit me-2"></i>Edit Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-asterisk me-2"></i>Change Password</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo url('logout'); ?>"><i class="fa-solid fa-sign-out me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
</header>