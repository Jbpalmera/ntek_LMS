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
                                            <h4 class="card-title mb-2">Area</h4>
                                            <p class="mb-0">
                                                This section is the Areas where Kiosk is Located
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mt-4">
                                    <?= $this->session->flashdata('message'); ?>
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
                                                    <th style="text-align: center;">Floor</th>
                                                    <th style="text-align: center;">Area Name</th>
                                                    <th style="text-align: center;">Number of Seats</th>
                                                    <th style="text-align: center;">Opening Time</th>
                                                    <th style="text-align: center;">Min Time Reservation</th>
                                                    <th style="text-align: center;">Max Time Reservation</th>
                                                    <th style="text-align: center;">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                   <?php foreach($area as $areaData) : ?>
                                                   <tr class="odd gradeX">
                                                      <td class="center" style="text-align: center;"><?= $areaData['id'] ?></td>
                                                      <td class="center" style="text-align: center;"><?= $areaData['floor'] ?></td>
                                                      <td class="center" style="text-align: center;"><?= $areaData['room'] ?></td>
                                                      <td class="center" style="text-align: center;"><?= $areaData['slotNumber'] ?></td>
                                                      <td class="center" style="text-align: center;"><?= $areaData['openTime'] ?> - <?= $areaData['closeTime'] ?></td>
                                                      <td class="center" style="text-align: center;"><?= $areaData['minReserve'] ?> Hour/s</td>
                                                      <td class="center" style="text-align: center;"><?= $areaData['maxReserve'] ?> Hour/s</td>
                                                      <td class="center" style="text-align: center;">
                                                        <a href="<?= base_url('Area_controller/edit_area?id=' . $areaData['id']) ?>" class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                            <img src="<?= base_url('assets/img/edit.png') ?>" alt="" style="width: 25px">
                                                        </a>
                                                        <a href="<?= base_url('Area_controller/delete_area?id=' . $areaData['id']) ?>" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
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