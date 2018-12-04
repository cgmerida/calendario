<script>
    $(function() {
			$('select[name=unity_id]').change(function() {
				var url = '/api/unities/' + $(this).val() + '/activities';

				$.get(url, function(data) {
					var select = $('form select[name=activity_id]');

					select.empty();

					$.each(data,function(key, value) {
						select.append('<option value=' + value.id + '>' + value.name + '</option>');
					});
				});
			});

			$('select[name=zone]').change(function() {
				var url = '/api/zone/' + $(this).val() + '/colonies';

				$.get(url, function(data) {
					var select = $('form select[name=colony_id]');

					select.empty();

					$.each(data,function(key, value) {
						select.append('<option value=' + value.id + '>' + value.name + '</option>');
					});
				});
			});
		});
</script>