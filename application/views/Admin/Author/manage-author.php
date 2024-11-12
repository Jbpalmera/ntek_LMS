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
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card-header d-flex justify-content-between flex-wrap">
                                        <div class="header-title">
                                            <h4 class="card-title mb-2">Authors</h4>
                                            <p class="mb-0">
                                                This section is the Authors of the books in the Library
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mt-4">
                                        <?= $this->session->flashdata('message') ?>
                                    </div>
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
                                                    <th style="text-align: center;">#</th>
                                                    <th style="text-align: center;">Author</th>
                                                    <th style="text-align: center;">Creation Date</th>
                                                    <th style="text-align: center;">Updation Date</th>
                                                    <th style="text-align: center;">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                   <?php foreach($author_info as $info) : ?>
                                                   <tr class="odd gradeX">
                                                      <td class="center" style="text-align: center;"><?= $info['id'] ?></td>
                                                      <td class="center" style="text-align: center;"><?= $info['authorName'] ?></td>
                                                      <td class="center" style="text-align: center;"><?= date('F j, Y', strtotime($info['creationDate'])); ?></td>
                                                      <td class="center" style="text-align: center;">
                                                      <?php  
                                                        if($info['updationDate']){
                                                            echo date('F j, Y', strtotime($info['updationDate']));
                                                        } else {
                                                            echo ' ';
                                                        }
                                                      ?>
                                                      </td>
                                                      <td class="center" style="text-align: center;">
                                                        <a href="<?= base_url('Author_controller/edit_author?id=' . $info['id']) ?>" class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                            <img src="<?= base_url('assets/img/edit.png') ?>" alt="" style="width: 25px">
                                                        </a>
                                                        <a href="<?= base_url('Author_controller/delete_author?id=' . $info['id']) ?>" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                            <img src="<?= base_url('assets/img/delete.png') ?>" alt="" style="width: 25px">
                                                        </a>
                                                         <!-- <a href="<?= base_url('Author_controller/edit_author?id=' . $info['id']) ?>"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button>  -->
                                                         <!-- <a href="<?= base_url('Author_controller/delete_author?id=' . $info['id']) ?>" onclick="return confirm('Are you sure you want to delete?');"" >  <button class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</button> -->
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