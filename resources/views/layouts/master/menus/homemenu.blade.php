<div id="header-image" class="mb-5">

    <?php include("date-time.php"); ?>

    <nav class="mynawmenu navbar navbar-expand-lg navbar-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="<?php echo base_url(); ?>" class="navbar-brand">
                <img src="<?php echo base_url('css/images/logo-blue.svg'); ?>" alt="لوگو خیریه" class="bi me-2" aria-label="خیریه امام علی ابن ابیطالب گرگاب" width="90px" />
            </a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">

                <ul class="navbar-nav My-nav me-auto mb-2 mb-lg-0 justify-content-center">
                    <?php

                    foreach ($menus as $row) : ?>
                    <li class="nav-item"><a href="<?php echo $this->show_menu->is_inerlink_show_menus($row->url); ?>" class="my-nav-link"><?php echo $row->title ?></a></li>
                    <?php endforeach; ?>
                </ul>

            </div>
        </div>
    </nav>
