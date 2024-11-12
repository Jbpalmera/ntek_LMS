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
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card-header d-flex justify-content-between flex-wrap">
                                        <div class="header-title">
                                            <h4 class="card-title mb-2">Books List</h4>
                                            <p class="mb-0">
                                                This section is the list of Books Registered in the Library 
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
                                                    <th>#</th>
                                                    <th>Book Name</th>
                                                    <th style="text-align: center;">Category</th>
                                                    <th style="text-align: center;">Author</th>
                                                    <th style="text-align: center;">Publication</th>
                                                    <th style="text-align: center;">Publisher</th>
                                                    <!-- <th>ISBN</th> -->
                                                    <th style="text-align: center;">Accession Number</th>
                                                    <th style="text-align: center;">Status</th>
                                                    <th>Price</th>
                                                    <th style="text-align: center;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                $counter = 1;
                                                foreach($book as $books) : ?>                 
                                                    <tr class="odd gradeX">
                                                    <td class="center"><?= $counter++ ?></td>
                                                    <td class="center"><?= $books['bookName'] ?></td>
                                                    <td class="center" style="text-align: center;"><?= $books['categoryName'] ?></td>
                                                    <td class="center" style="text-align: center;"><?= $books['authorName'] ?></td>
                                                    <td class="center" style="text-align: center;"><?= $books['publication'] ?></td>
                                                    <td class="center" style="text-align: center;"><?= $books['publisher'] ?></td>
                                                    <td class="center" style="text-align: center;"><?= $books['accessionNumber'] ?></td>
                                                    <!-- <td class="center"><?= $books['isbnNumber'] ?></td> -->
                                                    <td class="center" style="text-align: center;"><?php if($books['bookStatus'] == 1) 
                                                    {
                                                        echo '<div class="text-success">Available</div>';
                                                    } else {
                                                        echo '<div class="text-danger">Issued</div>';
                                                    }
                                                    ?>
                                                    </td>
                                                    <td class="center"><?= $books['bookPrice'] ?></td>
                                                    <td class="center" style="text-align: center;">
                                                        <a href="<?= base_url('Book_controller/edit_book?id=' . $books['id']) ?>" class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                            <img src="<?= base_url('assets/img/edit.png') ?>" alt="" style="width: 25px">
                                                        </a>
                                                        <a href="<?= base_url('Book_controller/delete_book?id=' . $books['id']) ?>" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                            <img src="<?= base_url('assets/img/delete.png') ?>" alt="" style="width: 25px">
                                                        </a>
                                                        <!-- <a href="<?= base_url('Book_controller/edit_book?id=' . $books['id']) ?>"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button>  -->
                                                        <!-- <a href="<?= base_url('Book_controller/delete_book?id=' . $books['id']) ?>" onclick="return confirm('Are you sure you want to delete?');"" >  <button class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</button> -->
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