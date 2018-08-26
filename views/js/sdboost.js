/**
* @author    SpecialDev
* @copyright SpecialDev 2017
* @license  SpecialDev
* @version 1.0
* @category administration
*/

$(document).ready(function () 
{
	$('#all_selected').toggle(function () {
		$('input:checkbox').attr('checked', 'checked');
		$(this).html('<i class="icon icon-circle-o" aria-hidden="true"></i> '+uncheckAll_label);
	}, function () {
		$('input:checkbox').removeAttr('checked');
		$(this).html('<i class="icon icon-check-circle-o" aria-hidden="true"></i> '+checkAll_label);
	});

	$('#refresh').click(function () {
		location.reload(true);
	});

	$('#boost_me').click(function () {
		var total_checked = $('input[type="checkbox"]').filter(":checked").length;
		var array_checked = [];
		$('#datainfo').show();
		$('input[type="checkbox"]').each(function () {
			if ($(this).is(':checked')) {
				array_checked.push($(this).attr('id'));
			}
		});

		for (i = 0; i < array_checked.length; ++i) {
			var table = array_checked[i];
			boost(table, total_checked);
		}

		$.ajax({
			type: "POST",
			url: ajaxdb_url,
			dataType: 'json',
			data: {
				is_ajax_: 1
			},
			success: function (data) {
				var db_final_size = data.final_db_size;
				$('.sizenow').text(" "+db_final_size);
			}
		}, "json");

		//location.reload(true);
	});

});

function boost(table, total_checked) {
	var table = table;
	var data = {
		table: table,
		total_checked: total_checked,
		is_ajax: 1
	};
	$.ajax({
		type: "POST",
		url: ajax_url,
		dataType: 'json',
		data: data,
		success: function (data) {
			console.log(data);
			state = data.state;
			record = data.record;
			if (state == "perfect") {
				console.log(table+' success');
				$('#' + table).parents('.form-group').addClass('has-success');
				if (record == 1) {
					$('#' + table).parents('.form-group').find('span').text(' (' + record + ' ' + row + ')');
				} else {
					$('#' + table).parents('.form-group').find('span').text(' (' + record + ' ' + rows + ')');
				}
				if (record > 0) {
					$('#' + table).parents('.form-group').find('span').removeAttr('class').addClass('rework');
				} else {
					$('#' + table).parents('.form-group').find('span').removeAttr('class').addClass('norework');
				}
			} else {
				console.log(table+' fail');
				$('#' + table).parents('.form-group').addClass('has-error');
			}
		}
	}, "json");
}