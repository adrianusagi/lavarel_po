<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
        <?php echo $page['title']; ?>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?php echo $page['title']?></h3>
                <?php if(!empty($page['description'])) echo '<p class="text-subtitle text-muted">'.$page['description'].'</p>';?>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $page['title']; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div> 

<div class="page-content"> 
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Welcome message</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="alert alert-light-info color-info"><i class="bi bi-info-circle"></i>  Welcome. This application is for demo purposes only and is not a production-ready product.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>