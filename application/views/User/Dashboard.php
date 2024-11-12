<div class="content-wrapper">
    <div class="container">
    <div class="row pad-botm">
        <div class="col-md-12">
            <h4 class="header-line">ADMIN DASHBOARD</h4>
        </div>
    </div>
    <?= $this->session->flashdata('message') ?>
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-info back-widget-set text-center">
                <i class="fa fa-bars fa-5x"></i>
                <h3><?= $countedBook ?></h3>
                Book Issued
            </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-warning back-widget-set text-center">
                <i class="fa fa-recycle fa-5x"></i>
                <h3>
                    <?php if($unreturnedBook == 0){
                        echo '0';
                    } 
                    else
                    {
                        echo $unreturnedBook;
                    }
                     ?>
                </h3>
                Books Not Returned Yet
            </div>
        </div>
    </div>
    </div>
</div>