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
          <?php $this->load->view('Templates/navbar'); ?>
          <div class="conatiner-fluid content-inner pb-0">
            <div class="d-flex justify-content-center ">
                <div class="col-md-9 col-lg-9">
                    <div class="card">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card-header d-flex justify-content-between flex-wrap">
                                    <div class="header-title">
                                        <h4 class="card-title mb-2">Attendance</h4>
                                        <p class="mb-0">
                                            This section is the Attendance of the Students who used the Kiosk
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
                                                    <th style="text-align: center;">Name</th>
                                                    <th style="text-align: center;">Student ID</th>
                                                    <th style="text-align: center;">Email</th>
                                                    <th style="text-align: center;">Membership</th>
                                                    <th style="text-align: center;">Mobile Number</th>
                                                    <th style="text-align: center;">QR Code</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table-body">
                                            </tbody>
                                        </table>
                                        <script type="application/json" id="student-data"><?= json_encode($studentData) ?></script>
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
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const studentData = JSON.parse(document.getElementById('student-data').textContent);

            studentData.sort((a, b) => b.id - a.id);

            const tableBody = document.getElementById('table-body');

            tableBody.innerHTML = '';

            studentData.forEach(data => {
                const row = document.createElement('tr');
                row.classList.add('odd', 'gradeX');
                
                row.innerHTML = `
                    <td class="center" style="text-align: center;">${data.id}</td>
                    <td class="center" style="text-align: center;">${data.fullName}</td>
                    <td class="center" style="text-align: center;">${data.studentID}</td>
                    <td class="center" style="text-align: center;">${data.emailID}</td>
                    <td class="center" style="text-align: center;">${data.membershipType}</td>
                    <td class="center" style="text-align: center;">${data.mobileNumber}</td>
                    <td class="center" style="text-align: center;">${data.qrcode}</td>
                `;
                
                tableBody.appendChild(row);
            });
            
            $('#datatable').DataTable();
        });
        </script>
      <!-- Wrapper End-->
    </div>
</body>
