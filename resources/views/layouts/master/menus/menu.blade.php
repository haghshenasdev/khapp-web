<nav id="navmyf" class="navbar navbar-expand-lg navbar-light text-center">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a href="<?php echo base_url(); ?>" class="navbar-brand">
            <img src="<?php echo base_url('css/images/logo.svg'); ?>" class="bi me-2" aria-label="خیریه امام علی ابن ابیطالب گرگاب" width="90px" />
        </a>
        <div class="collapse navbar-collapse text-light" id="navbarTogglerDemo01">

            <ul class="navbar-nav My-nav me-auto mb-2 mb-lg-0 justify-content-center">
                <?php foreach ($menus as $row) : ?>
                <li class="nav-item"><a href="<?php echo $this->show_menu->is_inerlink_show_menus($row->url); ?>" class="nav-link"><?php echo $row->title ?></a></li>
                <?php endforeach; ?>
            </ul>

        </div>
    </div>
</nav>
