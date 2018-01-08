
var demoDataTables = function() {
	return {
		init: function() {
			$('.datatable').dataTable({
				'sPaginationType': 'bootstrap',
				buttons: [
            'excel'
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
