<?php 
require('includes/auth.php');
require('includes/header.php'); 
require('includes/nav.php'); 


?>
<!-- Header -->
<div class="header bg-dark pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Home</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item">
                <a href="#"><i class="fas fa-home"></i></a>
              </li>
              <li class="breadcrumb-item"><a href="#">Report Issue</a></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Header end -->

<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h2 class="h1 text-center text-default mb-0">Report an Issue</h2>
            </div>
          </div>
        </div>
        <div class="card-body">
          <!-- Cryptocurrency Price Widget -->
          <div class="alert alert-warning" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text"
              ><strong>Warning!</strong> No deposit yet</span
            >
          </div>
          <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-dark">
              <thead class="thead-light">
                <tr>
                  <th style="font-size: 15px;" scope="col">userID</th>
                  <th style="font-size: 15px;" scope="col">username</th>
                  <th style="font-size: 15px;" scope="col">Amount</th>
                  <th style="font-size: 15px;" scope="col">Date created</th>
                  <th style="font-size: 15px;" scope="col">Status</th>
                  <th style="font-size: 15px;" scope="col">view</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">
                    john
                  </th>
                  <td>
                    leo
                  </td>
                  <td>
                    USD200
                  </td>
                  <td>
                    21th june 2020
                  </td>
                  <td class="text-red">
                    Pending
                  </td>
                  <td>
                    <input
                      class="btn btn-primary btn-sm"
                      type="submit"
                      value="view"
                    />
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    john
                  </th>
                  <td>
                    leo
                  </td>
                  <td>
                    USD1000
                  </td>
                  <td>
                    21th june 2020
                  </td>
                  <td class="text-green">
                    Approved
                  </td>
                  <td>
                    <a href="userdeposit.php"
                      ><input
                        class="btn btn-primary btn-sm"
                        type="submit"
                        value="view"
                    /></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php 
require('includes/footer.php'); 
?>
</div>
