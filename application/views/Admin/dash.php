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
            <div class="row">
              <div class="col-md-12 col-lg-12">
                <div class="row row-cols-1">
                    <div class="d-slider1 overflow-hidden ">
                      <ul  class="swiper-wrapper list-inline m-0 p-0 mb-2">
                          <li class="swiper-slide card card-slide">
                            <div class="card-body">
                                <div class="progress-widget">
                                  <div id="circle-progress-01" class="circle-progress-01 circle-progress circle-progress-primary text-center" data-min-value="0" data-max-value="100" data-value="90" data-type="percent">
                                      <svg class="card-slie-arrow icon-24" width="24"  viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                      </svg>
                                  </div>
                                  <div class="progress-detail">
                                      <p  class="mb-2">Book Count</p>
                                      <h4 class="counter"><?= $book ?></h4>
                                  </div>
                                </div>
                            </div>
                          </li>
                          <li class="swiper-slide card card-slide">
                            <div class="card-body">
                                <div class="progress-widget">
                                  <div id="circle-progress-02" class="circle-progress-01 circle-progress circle-progress-info text-center" data-min-value="0" data-max-value="100" data-value="80" data-type="percent">
                                      <svg class="card-slie-arrow icon-24" width="24"  viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                      </svg>
                                  </div>
                                  <div class="progress-detail">
                                      <p  class="mb-2">Categories</p>
                                      <h4 class="counter"><?= $categoryCount ?></h4>
                                  </div>
                                </div>
                            </div>
                          </li>
                          <li class="swiper-slide card card-slide">
                            <div class="card-body">
                                <div class="progress-widget">
                                  <div id="circle-progress-03" class="circle-progress-01 circle-progress circle-progress-primary text-center" data-min-value="0" data-max-value="100" data-value="70" data-type="percent">
                                      <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                      </svg>
                                  </div>
                                  <div class="progress-detail">
                                      <p  class="mb-2">Authors</p>
                                      <h4 class="counter"><?= $authorCount ?></h4>
                                  </div>
                                </div>
                            </div>
                          </li>
                          <li class="swiper-slide card card-slide">
                            <div class="card-body">
                                <div class="progress-widget">
                                  <div id="circle-progress-04" class="circle-progress-01 circle-progress circle-progress-info text-center" data-min-value="0" data-max-value="100" data-value="60" data-type="percent">
                                      <svg class="card-slie-arrow icon-24" width="24px"  viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                      </svg>
                                  </div>
                                  <div class="progress-detail">
                                      <p  class="mb-2">Issued Book</p>
                                      <h4 class="counter"><?= $bookDetails ?></h4>
                                  </div>
                                </div>
                            </div>
                          </li>
                          <li class="swiper-slide card card-slide">
                            <div class="card-body">
                                <div class="progress-widget">
                                  <div id="circle-progress-05" class="circle-progress-01 circle-progress circle-progress-primary text-center" data-min-value="0" data-max-value="100" data-value="50" data-type="percent">
                                      <svg class="card-slie-arrow icon-24" width="24px"  viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                      </svg>
                                  </div>
                                  <div class="progress-detail">
                                      <p  class="mb-2">Return Book</p>
                                      <h4 class="counter"><?= $bookReturn ?></h4>
                                  </div>
                                </div>
                            </div>
                          </li>
                          <li class="swiper-slide card card-slide">
                            <div class="card-body">
                                <div class="progress-widget">
                                  <div id="circle-progress-06" class="circle-progress-01 circle-progress circle-progress-info text-center" data-min-value="0" data-max-value="100" data-value="40" data-type="percent">
                                      <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                      </svg>
                                  </div>
                                  <div class="progress-detail">
                                      <p  class="mb-2">Students</p>
                                      <h4 class="counter"><?= $studentCount ?></h4>
                                  </div>
                                </div>
                            </div>
                          </li>
                          <!-- <li class="swiper-slide card card-slide">
                            <div class="card-body">
                                <div class="progress-widget">
                                  <div id="circle-progress-07" class="circle-progress-01 circle-progress circle-progress-primary text-center" data-min-value="0" data-max-value="100" data-value="30" data-type="percent">
                                      <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                      </svg>
                                  </div>
                                  <div class="progress-detail">
                                      <p  class="mb-2">Members</p>
                                      <h4 class="counter">11.2M</h4>
                                  </div>
                                </div>
                            </div>
                          </li> -->
                      </ul>
                      <div class="swiper-button swiper-button-next"></div>
                      <div class="swiper-button swiper-button-prev"></div>
                    </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-8">
                <div class="card overflow-hidden">
                    <div class="card-header d-flex justify-content-between flex-wrap">
                      <div class="header-title">
                          <h4 class="card-title mb-2">Library Management System</h4>
                          <p class="mb-0">
                            <svg class ="me-2 icon-24" width="24"  viewBox="0 0 24 24">
                                <path fill="#3a57e8" d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
                            </svg>
                            Recently Issued Books
                          </p>
                      </div>
                    </div>
                    <div class="card-body p-0">
                      <div class="table-responsive mt-4">
                          <table id="basic-table" class="table table-striped mb-0" role="grid">
                            <thead>
                                <tr>
                                  <th>Book Name</th>
                                  <th>Borrower's Name</th>
                                  <th>Date</th>
                                  <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php foreach($issuedBooks as $books) : ?>
                                <tr>
                                  <td>
                                      <div class="d-flex align-items-center">
                                        <h6><?= $books['bookName'] ?></h6>
                                      </div>
                                  </td>
                                  <td>
                                      <?= $books['fullName'] ?>
                                  </td>
                                  <td>
                                      <?php echo date('F j, Y', strtotime($books['issuesDate'])); ?>
                                  </td>
                                  <td>
                                    <?php
                                      if($books['returnDate'] == NULL)
                                      {
                                        echo '<div class="text-danger">Unreturned</div>';
                                      } else {
                                      echo '<div class="text-success">Returned</div>' . date('F j, Y', strtotime($books['returnDate']));
                                      }
                                    ?>
                                  </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                          </table>
                      </div>
                    </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-4">
                <div class="card">
                  <div class="card-header d-flex justify-content-between flex-wrap">
                      <div class="header-title">
                        <h5 class="card-title">Books Borrowed</h5>            
                      </div>   
                  </div>
                  <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                      <div id="productChartContainer">
                          <canvas id="productChart"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header d-flex justify-content-between flex-wrap">
                      <div class="header-title">
                        <h5 class="card-title">Books Borrowed Monthly</h5>            
                      </div>   
                  </div>
                  <div class="card-body d-flex justify-content-around text-center">
                      <canvas id="lineGraph" ></canvas>
                  </div>
                </div> 
              </div>
            </div>
          </div>
        </main>
      <!-- Wrapper End-->
    </div>
</body>
<script>
  document.addEventListener("DOMContentLoaded", function() {
      var ctx = document.getElementById('productChart').getContext('2d');
      var chartData = {
          labels: ['Total Books', 'Borrowed'],
          datasets: [{
              label: 'Books Borrowed',
              data: [<?= $book ?>, <?= $bookByStatus ?>],
              backgroundColor: ['#3a57e8', '#4bc7d2']
          }]
      };

  
      var productChart = new Chart(ctx, {
          type: 'pie', 
          data: chartData,
          options: {
              responsive: true,
              maintainAspectRatio: false, 
              plugins: {
                  legend: {
                      position: 'top',
                  },
                  tooltip: {
                      callbacks: {
                          label: function(context) {
                              let label = context.label || '';
                              if (label) {
                                  label += ': ';
                              }
                              if (context.parsed !== null) {
                                  label += context.parsed;
                              }
                              return label;
                          }
                      }
                  }
              }
          }
      });
  });

  // Sample data for each month
  var monthlyData = <?= $monthlyData ?>; 

  // Months of the year
  var months = [
      'January', 'February', 'March', 'April', 'May', 'June',
      'July', 'August', 'September', 'October', 'November', 'December'
  ];

  var ctx = document.getElementById('lineGraph').getContext('2d');
  var yearlyLineGraph = new Chart(ctx, {
      type: 'line',
      data: {
          labels: months,
          datasets: [{
              label: 'Monthly Borrower',
              data: monthlyData,
              borderColor: 'rgb(58,87,232)',
              backgroundColor: 'rgb(58,87,232)',
              tension: 0.4,
              fill: false
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
  });
</script>