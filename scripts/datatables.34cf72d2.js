
var demoDataTables = function() {
	return {
		init: function() {
			$('.datatable').dataTable({
				'sPaginationType': 'bootstrap'
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