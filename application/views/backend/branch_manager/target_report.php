<!-- START Template Main Content -->
<section id="main">
	<!-- START Bootstrap Navbar -->
	<div class="navbar navbar-static-top">
		<div class="navbar-inner">
			<!-- Breadcrumb -->
			<ul class="breadcrumb">
				<li>
					<a href="#">Dashboard</a><span class="divider"></span>
				</li>
				<li class="active">
					Target Report
				</li>
			</ul>
			<!--/ Breadcrumb -->
		</div>
	</div>
	<!--/ END Bootstrap Navbar -->

	<!-- START Content -->
	<div class="container-fluid">
		<!-- START Row -->
		<div class="row-fluid">
			<!-- START Page/Section header -->
			<div class="span12">
				<div class="page-header line1">
					<h4>Target Report<small>Create reports about targets over here.</small></h4>
				</div>
			</div>
			<!--/ END Page/Section header -->
		</div>
		<!--/ END Row -->
		<!--Page Content Here  -->
		<div id="Target_Reports">
			<!-- START Row -->
			<div class="row-fluid">
				<!-- Start Tabs -->
				<div class="tabbable" style="margin-bottom: 25px;">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#tab1" id="tablink1"  data-toggle="tab"><span class="icon icone-eraser"></span>Target Reports</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab1">
							<div class="body-inner">
								<div class="portlet-body">
									<table class="table table-striped table-bordered table-hover" id="tblTargetReport">
										<thead>
											<tr>
												<th style="width:8px;">
												<input type="checkbox" class="group-checkable" data-set="#tblBranch .checkboxes" />
												</th>
												<th class="hidden-480">Target Name</th>
												<th class="hidden-480">Start Date</th>
												<th class="hidden-480">End Date</th>
												<th clas="hidden-480">Target Type</th>
												<th> Status</th>
												<th >View</th>

											</tr>
										</thead>
										<tbody>
											<?php
											if (isset($target_report_list)) {
												foreach ($target_report_list as $key) {
													echo "<tr class=\"odd gradeX\">
<td>
<input type=\"checkbox\" class=\"checkboxes\" value=\"1\" /></td>
<td class=\"hidden-480\">{$key->targetSubject}</td>
<td class=\"hidden-480\">{$key->targetStartDate}</td>
<td class=\"hidden-480\">{$key->targetEndDate}</td>
<td class=\"hidden-480\">{$key->targetTypeName}</td>
<td class=\"hidden-480\">{$key->targetIsAchieved}</td>
<td ><span class=\"label label-success\" onclick='updatetarget(\"{$key->targetId}\");' >Submit Report</span>
<span class=\"label label-success\" onclick='viewtargetreports(\"{$key->targetId}\");' >View Report</span>
<span class=\"label label-success\" >Achive or Not<span></td>
</tr>";
												}
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab2">

							<?php
							$attributes = array('class' => 'form-horizontal span12 widget shadowed yellow', 'id' => 'form_target_report');
							echo form_open('branch_manager/target_report', $attributes);
							?>

							<!-- <form class="form-horizontal span12 widget shadowed yellow" id="form_target_report" method="post" action="<?php echo base_url(); ?>branch_manager/addReport"> -->
							<div class="alert alert-error hide">
								<button class="close" data-dismiss="alert"></button>
								You have some form errors. Please check below.
							</div>
							<div class="alert alert-success hide">
								<button class="close" data-dismiss="alert"></button>
								Your form validation is successful!
							</div>

							<div class="body-inner">
								<h3 class="form-section">Target Report </h3>
								
								<!-- Description -->
								<div class="control-group">
									<label class="control-label">Description about target</label>
									<div class="controls">
										<lable class="control-label span8" style="text-align:left" id="description">
								
										</lable>
									</div>
								</div>
								<!--/ Description         --

								<!-- date -->
								<div class="control-group">
									<label class="control-label">Date<span class="required">*</span></label>
									<div class="controls">
										<div class="input-append span6" id="date_datepicker">
											<input type="text" name="date" id="date" class="m-wrap span7">
											<span class="add-on"><i class="icon-calendar"></i></span>
										</div>
									</div>
								</div><!--/ date -->

								<!-- Report Description -->
								<div class="control-group">
									<label class="control-label">Report Description<span class="required">*</span></label>
									<div class="controls">
										<input type="text" name="report_description" id="report_description" class="span8"/>
									</div>
								</div><!--/ Description	 -->
								<input type="hidden" id="targetId" name="targetId"/>
								<!-- Form Action -->
								<div class="form-actions">
									<button type="submit" class="btn btn-primary" id="addreport" name="addreport">
										Register
									</button>
									<button type="button" class="btn">
										Cancel
									</button>
								</div><!--/ Form Action -->
							</div>
							</form>
						</div>
						<div class="tab-pane" id="tab3">
							<table class="table table-striped table-bordered table-hover" id="obtainmarks">
								<thead>
									<tr>
									<tr>
										<th class="hidden-480">Date</th>
										<th class="hidden-480">Description</th>
									</tr>
								</thead>

								<tbody id="lst_Tatget_Reports"></tbody>
							</table>
						</div>
					</div>
				</div>
				<!--/ End Tabs -->

				<!--View Target Report -->
				<div class="form-horizontal form-view" id="ViewBatch">
					<h3> View Target Report</h3>
					<h3 class="form-section">Target Info</h3>
					<div class="row-fluid">
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" for="firstName">Target Name</label>
								<div class="controls">
									<span class="text" id="target_name"></span>
								</div>
							</div>
						</div>

					</div>
					<!--/row-->
					<div class="row-fluid">
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label">Description:</label>
								<div class="controls">
									<span class="text" id="description"></span>
								</div>
							</div>
						</div>

					</div>
					<!--/row-->

					<h3 class="form-section">Dates</h3>
					<div class="row-fluid">
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label">Start Date:</label>
								<div class="controls">
									<span class="text" id="start_date"></span>
								</div>
							</div>
						</div>
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label">End Date:</label>
								<div class="controls">
									<span class="text" id="end_date"></span>
								</div>
							</div>
						</div>

					</div>
					<!--/row-->
					<div class="row-fluid">
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label">Status:</label>
								<div class="controls">
									<span class="text" id="status"></span>
								</div>
							</div>
						</div>
						<!--/span-->

					</div>
				</div><!-- End View Targer Report -->

			</div>
			<!--/ END Row -->
		</div>
		<!--Page Content End  -->
	</div>
	<!--/ END Content -->
</section>
<!--/ END Template Main Content -->