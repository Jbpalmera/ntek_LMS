<body class="boxed-fancy">
    <div class="boxed-inner">
      <!-- loader Start -->
      <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body">
            </div>
        </div>      
      </div>
      <!-- loader END -->
      <span class="screen-darken"></span>
        <main class="main-content">
            <?php $this->load->view('Templates/navbar') ?>
            <div class="container-fluid content-inner pb-0">
                <div class="d-flex justify-content-center ">
                    <div class="col-md-9 col-lg-9">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between flex-wrap">
                                <div class="header-title">
                                    <h4 class="card-title mb-2">Categories</h4>
                                    <p class="mb-0">
                                        This section is the Categories of the books in the Library
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Table Start -->
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="datatable">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Category</th>
                                                    <th style="text-align: center;">Status</th>
                                                    <th style="text-align: center;">Creation Date</th>
                                                    <th style="text-align: center;">Updation Date</th>
                                                    <th style="text-align: center;">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                    $counter = 1;
                                                    foreach($category as $cat) : ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?php echo $counter++ ?></td>
                                                        <td class="center"><?php echo $cat['categoryName'] ?></td>
                                                        <td class="center" style="text-align: center;">
                                                            <?php if($cat['status'] == 1){ ?>
                                                            <div class="badge bg-success">Active</div>
                                                            <?php } else {?>
                                                            <div class="badge bg-success">Active</div>
                                                            <?php } ?>
                                                        </td>
                                                        <td class="center" style="text-align: center;"><?php echo date('F j, Y', strtotime($cat['creationDate'])); ?></td>
                                                        <td class="center" style="text-align: center;">
                                                        <?php 
                                                            if($cat['updationDate']){
                                                                echo date('F j, Y', strtotime($cat['updationDate']));
                                                            } else {
                                                                echo ' ';
                                                            }
                                                        ?>
                                                        </td>
                                                        <td class="center" style="text-align: center;">
                                                        <a href="<?= base_url('Category_controller/edit_category?id=' . $cat['id']) ?>" class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                            <img src="<?= base_url('assets/img/edit.png') ?>" alt="" style="width: 25px">
                                                        </a>
                                                        <a href="<?= base_url('Category_controller/delete_category?id=' . $cat['id']) ?>" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                            <img src="<?= base_url('assets/img/delete.png') ?>" alt="" style="width: 25px">
                                                        </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Table End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </main>
      <!-- Wrapper End-->
    </div>
</body>