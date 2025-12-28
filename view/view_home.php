<?php
include 'koneksi.php';

?>
<div class="container pl-5">
  <div class="mb-3">
     <?php
              $tampil = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT nama FROM tb_outlet WHERE id_outlet=' $_SESSION[id_outlet]' "));
      ?>
            
      <div class="d-flex gap-1 pb-3">
          <h5 class=" fs-4 mb-3"> Selamat Datang </h5>

          <h5 class="fw-bold fs-4 text-decoration-underline"> <?php echo $tampil["nama"] ?> </h5>

      </div>

            <div class="row">
              <!-- Proggres member -->
                  <div class="col-12 col-md-4">
                        <div class="card mb-3" style="max-width: 540px;">
                          <div class="row g-0">
                            <div class="col-md-4 d-flex justify-content-center">
                              <!-- <i class="lni lni-shopping-basket"></i>   -->
                            <img src="./img/shopping-basket.svg" class="w-50" alt="...">
                            </div>
                            <div class="col-md-8">
                              <div class="card-body">
                                <h5 class="card-title">Pesanan Laundry</h5>
                                    <?php
                                        $pesan_londre = mysqli_num_rows(mysqli_query($koneksi,"SELECT id_transaksi FROM tb_detail_transaksi WHERE id_detail"));
                                        // $tampil = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT id_transaksi FROM tb_detail_transaksi WHERE id_detail "));
                                    ?>
                                <p class="card-text"><?php echo $pesan_londre?> </p>
                                <p class="card-text">
                                  <small class="text-body-secondary"> </i >Last updated <span class="fw-bold">

                                     <?php  
                                      if(isset($_SESSION['idtransaksi'])) {
                                          $pesan_waktu = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT tgl FROM tb_transaksi WHERE id_transaksi='$_SESSION[idtransaksi]'"));
                                          if($pesan_waktu && isset($pesan_waktu['tgl'])) {
                                              echo "<span class='fw-bold'>" . $pesan_waktu['tgl'] . "</span>";
                                          } else {
                                              echo "Belum";
                                          }
                                      } else {
                                          echo "Belum Update";
                                      }
                                      ?> 
                                
                                  </span>  
                                  </small></p>
                              </div>
                            </div>
                        </div>
                      </div>
                  </div>
              <!-- Keuntungan -->
                    <div class="col-12 col-md-4">
                     <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                          <div class="col-md-4 d-flex justify-content-center">
                            <img src="./img/stats-up.svg" class="w-50" alt="...">
                          </div>
                          <div class="col-md-8 ">
                            <div class="card-body">
                              <?php
                                         
                                        $grand = mysqli_fetch_row(mysqli_query($koneksi, "SELECT SUM(total_harga) FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id_paket WHERE id_transaksi"));
                                        // $tampil = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT total_harga FROM tb_detil_transaksi WHERE id_detail "));
                                    ?>
                              <h5 class="card-title">Total Pendapatn</h5>
                              <?php
                                        if($grand['0'] == null){
                                            $grand['0'] = 0;
                                        }
                                ?>

                              <p class="card-text">Rp. <?php echo number_format($grand['0'],0,',','.'); ?></p>
                              <p class="card-text"><small class="text-body-secondary">
                                Last updated <span class="fw-bold">
                                <?php  
                                      if(isset($_SESSION['idtransaksi'])) {
                                          $pesan_waktu = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT tgl FROM tb_transaksi WHERE id_transaksi='$_SESSION[idtransaksi]'"));
                                          if($pesan_waktu && isset($pesan_waktu['tgl'])) {
                                              echo "<span class='fw-bold'>" . $pesan_waktu['tgl'] . "</span>";
                                          } else {
                                              echo "Belum";
                                          }
                                      } else {
                                          echo "Belum Update";
                                      }
                                      ?> 
                              
                                    </span></small></p>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
              <!-- Keuntungan -->
                    <div class="col-12 col-md-4">
                      <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                          <div class="col-md-4 d-flex justify-content-center">
                            <img src="./img/users.svg" class="w-50" alt="...">
                          </div>
                          <div class="col-md-8">
                            <div class="card-body">
                              <h5 class="card-title">Pelanggan</h5>
                                  <?php
                                        $pelanggan = mysqli_num_rows(mysqli_query($koneksi,"SELECT id_member FROM tb_member WHERE id_member"));
                                        // $tampil = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT id_transaksi FROM tb_detail_transaksi WHERE id_detail "));
                                    ?>
                              <p class="card-text"><?php echo $pelanggan?> </p>
                              <p class="card-text"><small class="text-body-secondary">
                                Last updated <span class="fw-bold">
                                <?php  
                                      if(isset($_SESSION['idtransaksi'])) {
                                          $pesan_waktu = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT tgl FROM tb_transaksi WHERE id_transaksi='$_SESSION[idtransaksi]'"));
                                          if($pesan_waktu && isset($pesan_waktu['tgl'])) {
                                              echo "<span class='fw-bold'>" . $pesan_waktu['tgl'] . "</span>";
                                          } else {
                                              echo "Belum";
                                          }
                                      } else {
                                          echo "Belum Update";
                                      }
                                      ?> 
                             </span> </small></p>
                            </div>
                          </div>
                      </div>
                    </div>

                    
                  
                  
            </div>
     
      <h3 class=" fs-4 my-3">Transaksi Terkahir</h3>

            <div class="row">
              <!-- Table -->
                <div class="col-12">
                      <?php
                            $sql = "SELECT id_outlet, COUNT(*) AS total_transactions
                                      FROM tb_transaksi
                                      GROUP BY id_outlet
                                      ORDER BY total_transactions DESC";
                              $result = mysqli_query($koneksi, $sql);

                              $labels = [];
                              $data = [];

                              while ($row = mysqli_fetch_assoc($result)) {
                                  $labels[] = "Outlet " . $row['id_outlet'];
                                  $data[] = $row['total_transactions'];
                              }
                        ?>
            
                            <!-- Card 1 for Bar Chart -->
                           
                                
                                <div class="relative">
                                    <canvas id="transactionChart1" width="500" height="130"></canvas>
                                </div>
                            


                      <script>
                          const labels = <?php echo json_encode($labels); ?>;
                          const data = <?php echo json_encode($data); ?>;

                          // Configuration for the bar chart
                          const config1 = {
                              type: 'bar',
                              data: {
                                  labels: labels,
                                  datasets: [{
                                      label: 'Total Transaction Per Month',
                                      data: data,
                                      backgroundColor: [
                                          'rgba(255, 99, 132, 0.2)',
                                          'rgba(54, 162, 235, 0.2)',
                                          'rgba(255, 206, 86, 0.2)',
                                          'rgba(75, 192, 192, 0.2)',
                                          'rgba(153, 102, 255, 0.2)',
                                          'rgba(255, 159, 64, 0.2)'
                                      ],
                                      borderColor: [
                                          'rgba(255,99,132,1)',
                                          'rgba(54, 162, 235, 1)',
                                          'rgba(255, 206, 86, 1)',
                                          'rgba(75, 192, 192, 1)',
                                          'rgba(153, 102, 255, 1)',
                                          'rgba(255, 159, 64, 1)'
                                      ],
                                      borderWidth: 1
                                  }]
                              },
                              options: {
                                  responsive: true,
                                  plugins: {
                                      legend: {
                                          position: 'top',
                                      },
                                      title: {
                                          display: true,
                                          text: 'Total Transactions'
                                      }
                                  }
                              },
                          };

                        
                          // Initialize the bar chart
                          const myBarChart = new Chart(
                              document.getElementById('transactionChart1'),
                              config1
                          );
                </script>          
  
                </div>
            </div>
      </div>
</div>