<?php 
                    $id=4;
                    $query=mysqli_query($con,"SELECT * FROM activate_advertising WHERE id='$id'");
                    while($row=mysqli_fetch_array($query)) 
                    {

                        $row = $row['status'];

                        if ($row == 1)
                        { 
                            $id=4;
                            $query=mysqli_query($con,"SELECT * FROM activate_advertising WHERE id='$id'");
                            while($row2=mysqli_fetch_array($query)) 
                                {
                                     $query=mysqli_query($con,"SELECT setting_description FROM genaralsetting where id=3");
                                     while($row=mysqli_fetch_array($query)) 
                                     {
                                    date_default_timezone_set($row['setting_description']);
                                    $currentdate = date('Y-m-d');
                                    $row2 = $row2['expire'];
                                    
                                    if ($row2 >= $currentdate) 
                                    {
                                        $id=4;
                                        $query=mysqli_query($con,"SELECT * FROM activate_advertising WHERE id='$id'");
                                        while($row3=mysqli_fetch_array($query))
                                        {
                                            $row3 = $row3['startdate'];
                                            if ($row3 <= $currentdate) 
                                            {
                                               include('includes/advertising/Home/Brand/2-slide-banner.php');
                                            }
                                        }
                                    }
                               }  }
                        }
                    ?>  
                    <?php }?>

                    <?php 
                    $id=8;
                    $query=mysqli_query($con,"SELECT * FROM activate_advertising WHERE id='$id'");
                    while($row=mysqli_fetch_array($query)) 
                    {

                        $row = $row['status'];

                        if ($row == 1)
                        { 
                            $id=8;
                            $query=mysqli_query($con,"SELECT * FROM activate_advertising WHERE id='$id'");
                            while($row2=mysqli_fetch_array($query)) 
                                {
                                     $query=mysqli_query($con,"SELECT setting_description FROM genaralsetting where id=3");
                                     while($row=mysqli_fetch_array($query)) 
                                     {
                                    date_default_timezone_set($row['setting_description']);
                                    $currentdate = date('Y-m-d');
                                    $row2 = $row2['expire'];
                                    
                                    if ($row2 >= $currentdate) 
                                    {
                                        $id=8;
                                        $query=mysqli_query($con,"SELECT * FROM activate_advertising WHERE id='$id'");
                                        while($row3=mysqli_fetch_array($query))
                                        {
                                            $row3 = $row3['startdate'];
                                            if ($row3 <= $currentdate) 
                                            {
                                               include('includes/advertising/Home/Brand/3-slide-banner.php');
                                            }
                                        }
                                    }
                               }  }
                        }
                    ?>  
                    <?php }?>