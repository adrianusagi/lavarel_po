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
            <div class="card" id="card_dt">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8 col-lg-8">
                            <h4>Data Table</h4>
                        </div>
                        <div class="col-4 col-lg-4">
                            <a href="javascript:;" class="btn btn-outline-primary pull-right" data-aksi="add_new"><i class="bi bi-plus-square-fill icon-lg"></i>  Add New</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php echo draw_table($table)?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</div>
<meta name="csrf-token" content="<?php echo csrf_token(); ?>">