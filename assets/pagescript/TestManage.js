var Test = function() {
	var formValidatorAddTest = function() {
		var form1 = $('#form_test');
		var error1 = $('.alert-error', form1);
		var success1 = $('.alert-success', form1);
		form1.validate({
			errorElement : 'span', //default input error message container
			errorClass : 'help-inline', // default input error message class
			focusInvalid : false, // do not focus the last invalid input
			ignore : "",
			rules : {
				batch_id : {
					required : true,
				},
				test_date : {
					required : true,
				},
				test_marks : {
					required : true,
				}
			},

			invalidHandler : function(event, validator) {//display error alert on form submit
				success1.hide();
				error1.show();
				App.scrollTo(error1, -200);
			},

			highlight : function(element) {// hightlight error inputs
				$(element).closest('.help-inline').removeClass('ok');
				// display OK icon
				$(element).closest('.control-group').removeClass('success').addClass('error');
				// set error class to the control group
			},

			unhighlight : function(element) {// revert the change done by hightlight
				$(element).closest('.control-group').removeClass('error');
				// set error class to the control group
			},

			success : function(label) {
				label.addClass('valid').addClass('help-inline ok')// mark the current input as valid and display OK icon
				.closest('.control-group').removeClass('error').addClass('success');
				// set success class to the control group
			},

			submitHandler : function(form) {
				success1.show();
				form.submit();
				error1.hide();
			}
		});
	};
	var formValidatorAddTestmarks = function() {
		var form1 = $('#form_mark');
		var error1 = $('.alert-error', form1);
		var success1 = $('.alert-success', form1);
		form1.validate({
			errorElement : 'span', //default input error message container
			errorClass : 'help-inline', // default input error message class
			focusInvalid : false, // do not focus the last invalid input
			ignore : "",
			rules : {
				".marks" : {
					required : true,
				}
			},

			invalidHandler : function(event, validator) {//display error alert on form submit
				success1.hide();
				error1.show();
				App.scrollTo(error1, -200);
			},

			highlight : function(element) {// hightlight error inputs
				$(element).closest('.help-inline').removeClass('ok');
				// display OK icon
				$(element).closest('.control-group').removeClass('success').addClass('error');
				// set error class to the control group
			},

			unhighlight : function(element) {// revert the change done by hightlight
				$(element).closest('.control-group').removeClass('error');
				// set error class to the control group
			},

			success : function(label) {
				label.addClass('valid').addClass('help-inline ok')// mark the current input as valid and display OK icon
				.closest('.control-group').removeClass('error').addClass('success');
				// set success class to the control group
			},

			submitHandler : function(form) {
				success1.show();
				form.submit();
				error1.hide();
			}
		});
	};

	return {
		//main function to initiate the module
		init_table : function() {
			if (!jQuery().dataTable) {
				return;
			}
			// begin tblEvent table
			$('#tbltest').dataTable({
				"aoColumns" : [{
					"bSortable" : false
				}, null, {
					"bSortable" : false
				}, null, null],
				"aLengthMenu" : [[5, 15, 20, -1], [5, 15, 20, "All"] // change per page values here
				],
				// set the initial value
				"iDisplayLength" : 5,
				"sDom" : "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
				"sPaginationType" : "bootstrap",
				"oLanguage" : {
					"sLengthMenu" : "_MENU_ records per page",
					"oPaginate" : {
						"sPrevious" : "Prev",
						"sNext" : "Next"
					}
				},
				"aoColumnDefs" : [{
					'bSortable' : false,
					'aTargets' : [0]
				}]
			});

			jQuery('#tbltest .group-checkable').change(function() {
				var set = jQuery(this).attr("data-set");
				var checked = jQuery(this).is(":checked");
				jQuery(set).each(function() {
					if (checked) {
						$(this).attr("checked", true);
					} else {
						$(this).attr("checked", false);
					}
				});
				jQuery.uniform.update(set);
			});

			jQuery('#tbltest .dataTables_filter input').addClass("m-wrap medium");
			// modify table search input
			jQuery('#tbltest .dataTables_length select').addClass("m-wrap small");
			// modify table per page dropdown
			//jQuery('#tblEvent .dataTables_length select').select2(); // initialize select2 dropdown
		},
		init_formvalidation : function() {
			formValidatorAddTest();
			formValidatorAddTestmarks();
		},
		init_uijquery : function() {

			$("#test_date_datepicker input").datepicker({
				isRTL : App.isRTL(),
				dateFormat : 'dd-mm-yy'
			});
			$("#test_date_datepicker .add-on").click(function() {
				$("#test_date_datepicker input").datepicker("show");
			});

			$(".tab3link").click(function() {
				$("#tab1link").parent().attr("class", "");
				$("#lst_students").html("");
				testid=$(this).data("test_id");
				$.ajax({
					url : "../ajax_manager/studentlistMarks/" + $(this).data("test_id"),
					dataType : 'json',
					async : true,
					success : function(json) {
						if (json) {
							$('#testId').val(testid);
							$.each(json.student_list, function(i, item) {
								if (item.testResultObtainedMarks == null)
									$('#lst_students').append("<tr class='odd gradeX'><td>" + item.userFirstName + " " + item.userMiddleName + " " + item.userLastName + "</td><td><input type='text' class='marks span4' name='obtained_marks[]' id='obtained_marks" + i + "'/><input type='hidden' name='student_ids[]' id='student_ids" + i + "' value='" + item.studentbatchId + "'/></div></td></tr>");
								else
									$('#lst_students').append("<tr class='odd gradeX'><td>" + item.userFirstName + " " + item.userMiddleName + " " + item.userLastName + "</td><td><input type='text' class='marks span4' name='obtained_marks[]' id='obtained_marks" + i + "'value = '" + item.testResultObtainedMarks + "'/><input type='hidden' name='student_ids[]' id='student_ids" + i + "' value='" + item.studentbatchId + "'/></div></td></tr>");
							});
							$('.marks').each(function() {
								$(this).rules('add', {
									required : true,
									number : true,
									messages : {
										required : "This field is required",
										number : "only number allows"
									}
								});
							});
						}
					}
				});
			});
			$(".tab4link").click(function() {
				$("#tab1link").parent().attr("class", "");
				$("#lst_students_view").html("");
				$.ajax({
					url : "../ajax_manager/studentlistMarks/" + $(this).data("test_id"),
					dataType : 'json',
					async : true,
					success : function(json) {
						if (json) {
							$.each(json.student_list, function(i, item) {
									$('#lst_students_view').append("<tr class='odd gradeX'><td>" + item.userFirstName + " " + item.userMiddleName + " " + item.userLastName + "</td><td>" + item.testResultObtainedMarks + "</td></tr>");
							});
						}
					}
				});
			});

		}
	};
}();
