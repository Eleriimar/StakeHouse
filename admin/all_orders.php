<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>All Orders</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/lib/datatables/datatables.min.css" rel="stylesheet">
    

</head>

<body class="fix-header fix-sidebar">
   
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
  
    <div id="main-wrapper">
   
         <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
            <div class="navbar-header">
                    <a class="navbar-brand" href="dashboard.php">
                        
                        <span><img src="images/icn.png" alt="homepage" class="dark-logo" /></span>
                    </a>
                </div>
                <div class="navbar-collapse">
            
                    <ul class="navbar-nav mr-auto mt-md-0">
              
                        
                     
                       
                    </ul>
       
                    <ul class="navbar-nav my-lg-0">

                        
                    
                        <li class="nav-item dropdown">
                           
                            <div class="dropdown-menu dropdown-menu-right mailbox animated zoomIn">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                  
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/bookingSystem/user-icn.png" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                   <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
      
        <div class="left-sidebar">
       
            <div class="scroll-sidebar">
             
                <nav class="sidebar-nav">
                   <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                        <li class="nav-label">Log</li>
                        <li> <a href="all_users.php">  <span><i class="fa fa-user f-s-20 "></i></span><span>Users</span></a></li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-archive f-s-20 color-warning"></i><span class="hide-menu">Restaurant</span></a>
                            <ul aria-expanded="false" class="collapse">
								<li><a href="all_restaurant.php">All Restaurants</a></li>
								<li><a href="add_category.php">Add Category</a></li>
                                <li><a href="add_restaurant.php">Add Restaurant</a></li>
                                
                            </ul>
                        </li>
                      <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cutlery" aria-hidden="true"></i><span class="hide-menu">Menu</span></a>
                            <ul aria-expanded="false" class="collapse">
								<li><a href="all_menu.php">All Menues</a></li>
								<li><a href="add_menu.php">Add Menu</a></li>
                              
                                
                            </ul>
                        </li>
						 <li> <a href="all_orders.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Orders</span></a></li>
                         
                    </ul>
                </nav>
        
            </div>
     
        </div>
    
        <div class="page-wrapper">
      
            
      
            <div class="container-fluid">
                
                <!-- Status Messages -->
                <?php
                if(isset($_GET['msg'])) {
                    if($_GET['msg'] == 'deleted') {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> Order has been deleted successfully.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                    }
                }
                if(isset($_GET['error'])) {
                    $error_msg = '';
                    switch($_GET['error']) {
                        case 'delete_failed':
                            $error_msg = 'Failed to delete the order. Please try again.';
                            break;
                        case 'order_not_found':
                            $error_msg = 'Order not found.';
                            break;
                        case 'invalid_request':
                            $error_msg = 'Invalid request.';
                            break;
                        default:
                            $error_msg = 'An error occurred.';
                    }
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> ' . $error_msg . '
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>';
                }
                ?>
           
                <div class="row">
                    <div class="col-12">
                        
                       
                    <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">All Orders</h4>
                                <div class="card-actions">
                                    <a href="all_orders.php" class="btn btn-sm btn-light">
                                        <i class="fa fa-refresh"></i> Refresh
                                    </a>
                                </div>
                            </div>
                             
                                <div class="table-responsive m-t-40">
                                    <?php
                                    // Get total order count
                                    $count_query = "SELECT COUNT(*) as total_orders FROM users_orders";
                                    $count_result = mysqli_query($db, $count_query);
                                    $count_row = mysqli_fetch_array($count_result);
                                    $total_orders = $count_row['total_orders'];
                                    
                                    echo "<div class='alert alert-info'>
                                            <strong>Total Orders:</strong> $total_orders
                                          </div>";
                                    ?>
                                    <table id="myTable" class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                            <tr>
                                                <th>User</th>		
                                                <th>Title</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
												<th>Address</th>
												<th>Status</th>												
												 <th>Reg-Date</th>
												  <th>Action</th>
												 
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
											
											<?php
												$sql="SELECT users.username, users.f_name, users.l_name, users.email, users.phone, users.address, users_orders.* FROM users INNER JOIN users_orders ON users.u_id=users_orders.u_id ORDER BY users_orders.date DESC";
												$query=mysqli_query($db,$sql);
												
													if(!mysqli_num_rows($query) > 0 )
														{
															echo '<tr><td colspan="8"><center>No Orders</center></td></tr>';
														}
													else
														{				
																	while($rows=mysqli_fetch_array($query))
																		{
																																							
																				echo '<tr>';
																				echo '<td>'.$rows['username'].'</td>';
																				echo '<td>'.$rows['title'].'</td>';
																				echo '<td>'.$rows['quantity'].'</td>';
																				echo '<td>Ksh '.$rows['price'].'</td>';
																				echo '<td>'.$rows['address'].'</td>';
																								
																				$status=$rows['status'];
																				if($status=="" or $status=="NULL")
																				{
																				?>
																				<td> <button type="button" class="btn btn-info"><span class="fa fa-bars"  aria-hidden="true" ></span> Dispatch</button></td>
																			   <?php 
																				  }
																				   else if($status=="in process")
																				 { ?>
																				<td> <button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin"  aria-hidden="true" ></span> On The Way!</button></td> 
																				<?php
																					}
																				else if($status=="closed")
																					{
																				?>
																				<td> <button type="button" class="btn btn-success" ><span  class="fa fa-check-circle" aria-hidden="true"></span> Delivered</button></td> 
																				<?php 
																				} 
																				else if($status=="rejected")
																					{
																				?>
																				<td> <button type="button" class="btn btn-danger"> <i class="fa fa-close"></i> Cancelled</button></td> 
																				<?php 
																				} 
																				?>
																							<?php																									
																								echo '<td>'.$rows['date'].'</td>';
																								echo '<td>
																									 <a href="delete_orders.php?order_del='.$rows['o_id'].'" onclick="return confirm(\'Are you sure you want to delete this order?\');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
																									 <a href="view_order.php?user_upd='.$rows['o_id'].'" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
																									</td>';
																								echo '</tr>';
																					 
																						
																						
																		}	
														}
												
											
											?>
                                             
                                            
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
						 </div>
                      
                            </div>
                        </div>
                    </div>
                </div>
         
            </div>
 
		
            <footer class="footer"> © 2022 - Classic Stakehouse</footer>
    
        </div>
   
    </div>
    
    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/lib/datatables/datatables.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "order": [[ 6, "desc" ]], // Sort by date column (index 6) in descending order
            "pageLength": 25,
            "responsive": true,
            "columnDefs": [
                { "orderable": false, "targets": [7] } // Disable sorting on Action column
            ]
        });
    });
    </script>
    
</body>

</html>