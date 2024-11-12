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
                    <div class="col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between flex-wrap">
                                <div class="header-title">
                                    <h4 class="card-title mb-2">Edit Area</h4>
                                    <p class="mb-0">
                                        This section is for Updating Area Information
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                            <form role="form" method="post">
                                <div class="form-group">
                                    <?php foreach ($area_info as $info) : ?>
                                    <label>Floor</label>
                                    <input class="form-control" type="text" name="floor" value="<?= $info['floor'] ?>" required />
                                    <?php endforeach ?>
                                </div>
                                <div class="form-group">
                                    <?php foreach ($area_info as $info) : ?>
                                    <label>Area Name</label>
                                    <input class="form-control" type="text" name="areaName" value="<?= $info['room'] ?>" required />
                                    <?php endforeach ?>
                                </div>
                                <div class="form-group">
                                    <?php foreach ($area_info as $info) : ?>
                                    <label>Seat Count</label>
                                    <input class="form-control" type="number" name="seatCount" value="<?= $info['slotNumber'] ?>" required />
                                    <?php endforeach ?>
                                </div>
                                <div class="form-group">
                                    <?php foreach ($area_info as $info) : ?>
                                    <label>Opening Time</label>
                                    <input class="form-control" type="time" name="openTime" value="<?= $info['openTime'] ?>" required />
                                    <?php endforeach ?>
                                </div>
                                <div class="form-group">
                                    <?php foreach ($area_info as $info) : ?>
                                    <label>Closing Time</label>
                                    <input class="form-control" type="time" name="closeTime" value="<?= $info['closeTime'] ?>" required />
                                    <?php endforeach ?>
                                </div>
                                <div class="form-group">
                                    <?php foreach ($area_info as $info) : ?>
                                    <label>Minimum Time Reservation (Hourly)</label>
                                    <input class="form-control" type="number" name="minReserve" value="<?= $info['minReserve'] ?>" required />
                                    <?php endforeach ?>
                                </div>
                                <div class="form-group">
                                    <?php foreach ($area_info as $info) : ?>
                                    <label>Maximum Time Reservation (Hourly)</label>
                                    <input class="form-control" type="number" name="maxReserve" value="<?= $info['maxReserve'] ?>" required />
                                    <?php endforeach ?>
                                </div>
                                <button type="submit" name="update" class="btn btn-info">Update </button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </main>
      <!-- Wrapper End-->
    </div>
</body>