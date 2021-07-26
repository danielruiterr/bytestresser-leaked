<?php 

define('allow', TRUE);

include_once('public/header.php');

if (!($Admin->IsLoged()) == true) {
  $Alert->LoginAlert('Login.', 'error');
  header('Location: login.php');
  die();
}

?>
<div class="content-page">

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Home</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            
            <div class="row no-gutters">
                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle bg-soft-primary rounded-0 card-box mb-0">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-primary">
                                    <i class="fe-tag font-22 avatar-title text-primary"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $User->UserDataAll()['Count']; ?></span></h3>
                                    <p class="text-primary mb-1 text-truncate">Customers</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle bg-soft-warning rounded-0 card-box mb-0">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-warning">
                                    <i class="fe-clock font-22 avatar-title text-warning"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $Support->ticketsList()['Count']; ?></span></h3>
                                    <p class="text-warning mb-1 text-truncate">Total Tickets</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle bg-soft-success rounded-0 card-box mb-0">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-success">
                                    <i class="fe-check-circle font-22 avatar-title text-success"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $ALogs->LogsDataAll()['Count']; ?></span></h3>
                                    <p class="text-success mb-1 text-truncate">Total Boots</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle bg-soft-danger rounded-0 card-box mb-0">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-danger">
                                    <i class="fe-server font-22 avatar-title text-danger"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $Api->ApiDataAll()['Count']; ?></span></h3>
                                    <p class="text-danger mb-1 text-truncate">Total Servers</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
            <!-- end row -->
            
            
            <div class="row no-gutters mt-2">
                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle bg-soft-primary rounded-0 card-box mb-0">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-primary">
                                    <i class="fe-tag font-22 avatar-title text-primary"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $User->UserDataPaid()['Count']; ?></span></h3>
                                    <p class="text-primary mb-1 text-truncate">Paid Users</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle bg-soft-warning rounded-0 card-box mb-0">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-warning">
                                    <i class="fe-clock font-22 avatar-title text-warning"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1">€<span data-plugin="counterup"><?php $IncomeToday = 0; foreach ($Order->OrderDataPaidToday()['Response'] as $key => $value) {
                                        $IncomeToday = $IncomeToday + $value['Price'];
                                    } echo $IncomeToday; ?></span></h3>
                                    <p class="text-warning mb-1 text-truncate">Income Today</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle bg-soft-success rounded-0 card-box mb-0">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-success">
                                    <i class="fe-check-circle font-22 avatar-title text-success"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $Order->TotalSales()['Count']; ?></span></h3>
                                    <p class="text-success mb-1 text-truncate">Total Salse</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle bg-soft-danger rounded-0 card-box mb-0">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-danger">
                                    <i class="fe-server font-22 avatar-title text-danger"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1">€<span data-plugin="counterup"><?php $TotalIncome = 0; foreach ($Order->TotalIncome()['Response'] as $key => $value) {
                                        $TotalIncome = $TotalIncome + $value['Price'];
                                    } echo $TotalIncome; ?></span></h3>
                                    <p class="text-danger mb-1 text-truncate">Total Income</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
            <!-- end row -->

            <div class="row mt-2">
                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="card">
                        <h6 class="card-header">Info</h6>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="py-2 px-0"><span class="font-weight-semibold w-50">Tickets Today</span></td>
                                            <td class="py-2 px-0"><span class="badge badge-primary"><?php echo $Support->ticketsToday()['Count']; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-0"><span class="font-weight-semibold w-50">Invoices Today</span></td>
                                            <td class="py-2 px-0"><span class="badge badge-primary"><?php echo $Order->OrderDataToday()['Count']; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-0"><span class="font-weight-semibold w-50">Attacks Today</span></td>
                                            <td class="py-2 px-0"><span class="badge badge-primary"><?php echo $Api->AttacksToday()['Count']; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-0"><span class="font-weight-semibold w-50">Logins Today</span></td>
                                            <td class="py-2 px-0"><span class="badge badge-primary"><?php echo $Logs->LoginsToday()['Count']; ?></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div> <!-- container -->

    </div> <!-- content -->

    <!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php echo date('Y'); ?> &copy; <a href="https://bytestresser.com">ByteStresser.com</a> 
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
    <?php include('public/footer.php'); ?>