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
                                    <h4 class="card-title mb-2">Add Area</h4>
                                    <p class="mb-0">
                                        This section is for adding new Area location for the Kiosk
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                            <form role="form" method="post">
                                <div class="form-group">
                                    <label>Floor</label>
                                    <input class="form-control" type="text" name="floor" autocomplete="off"  required />
                                </div>
                                <div class="form-group">
                                    <label>Area Name</label>
                                    <input class="form-control" type="text" name="roomName" autocomplete="off"  required />
                                </div>
                                <div class="form-group">
                                    <label>Seat Count</label>
                                    <input class="form-control" type="text" name="seatCount" autocomplete="off"  required />
                                </div>
                                <div class="form-group">
                                    <label>Opening Time</label>
                                    <input class="form-control" type="time" name="openTime" autocomplete="off"  required />
                                </div>
                                <div class="form-group">
                                    <label>Closing Time</label>
                                    <input class="form-control" type="time" name="closeTime" autocomplete="off"  required />
                                </div>
                                <div class="form-group">
                                    <label>Minimum Reservation Time (Hourly)</label>
                                    <input class="form-control" type="number" name="minReserve" autocomplete="off" min="1" max="2"  required />
                                </div>
                                <div class="form-group">
                                    <label>Maximum Reservation Time (Hourly)</label>
                                    <input class="form-control" type="number" name="maxReserve" autocomplete="off" min="1" max="8"  required />
                                </div>
                                <button type="submit" name="create" class="btn btn-info">Add </button>
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