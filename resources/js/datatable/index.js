import * as $ from 'jquery';
import 'datatables';

export default (function () {
  $('#dataTable').DataTable({
		language: {
			'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
			// More languages : http://www.datatables.net/plug-ins/i18n/
		}
	});
}());
