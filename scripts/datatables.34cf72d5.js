
var demoDataTables = function() {
	return {
		init: function() {
			$('.datatable').dataTable({
				'sPaginationType': 'bootstrap',
				buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
			});
			$('.chosen').chosen({
				width: '80px'
			});
		}
	};
}();
$(function() {
	demoDataTables.init();
});
