                                      
<?php
						  if ($view_report=='view_today_search'){//////////////////////////
						/// get presentation values
						$day30= date('F d Y');
						$today= date('F d Y');	
						
						/// get chat values
							$db_day30= date('Y-m-d');
							$db_today= date('Y-m-d');
							
						  }elseif ($view_report=='view_thisweek_search'){/////////////////////
						/// get presentation values
						$day30= date('F d Y', strtotime('sunday - 1 week'));
						$today= date('F d Y');	
						
						/// get chat values
							$db_day30= date('Y-m-d', strtotime('sunday - 1 week'));
							$db_today= date('Y-m-d');
							
						  }elseif ($view_report=='view_7days_search'){///////////////////////////////
						/// get presentation values
						$day30= date('F d Y', strtotime('today - 7 days'));
						$today= date('F d Y');	
						
						/// get chat values
							$db_day30= date('Y-m-d', strtotime('today - 7 days'));
							$db_today= date('Y-m-d');
							
						  }elseif ($view_report=='view_thismonth_search'){/////////////////////////////
						/// get presentation values
						$day30= date('F 01 Y', strtotime('this month'));
						$today= date('F d Y');	
						
						/// get chat values
							$db_day30= date('Y-m-01', strtotime('this month'));
							$db_today= date('Y-m-d');
							
						  }elseif ($view_report=='view_30days_search'){/////////////////////////////
						/// get presentation values
						$day30= date('F d Y', strtotime('today - 30 days'));
						$today= date('F d Y');	
						
						/// get chat values
							$db_day30= date('Y-m-d', strtotime('today - 30 days'));
							$db_today= date('Y-m-d');
							
						  }elseif ($view_report=='view_90days_search'){////////////////////////
						/// get presentation values
						$day30= date('F d Y', strtotime('today - 90 days'));
						$today= date('F d Y');	
						
						/// get chat values
							$db_day30= date('Y-m-d', strtotime('today - 90 days'));
							$db_today= date('Y-m-d');
							
						  }elseif ($view_report=='view_thisyear_search'){/////////////////////////////////
						/// get presentation values
						$day30= date('F d Y', strtotime('first day of january this year'));
						$today= date('F d Y');	
						
						/// get chat values
							$db_day30= date('Y-m-d', strtotime('first day of january this year'));
							$db_today= date('Y-m-d');
							
						  }elseif ($view_report=='view_1year_search'){/////////////////////////////
						/// get presentation values
						$day30= date('F d Y', strtotime('today - 365 days'));
						$today= date('F d Y');	
						
						/// get chat values
							$db_day30= date('Y-m-d', strtotime('today - 365 days'));
							$db_today= date('Y-m-d');
							
						  }elseif ($view_report=='custom_search'){/////////////////////////////
						  $datefrom=$_POST['datefrom'];
						  $dateto=$_POST['dateto'];
						/// get presentation values
						$day30= date('F d Y', strtotime($datefrom));
						$today= date('F d Y', strtotime($dateto));	
						
						/// get chat values
							$db_day30= date('Y-m-d', strtotime($datefrom));
							$db_today= date('Y-m-d', strtotime($dateto));
							}
					
?>
