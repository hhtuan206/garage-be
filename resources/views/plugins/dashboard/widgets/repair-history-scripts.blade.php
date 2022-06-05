<script>
    var repairs = @json(array_values($repairsPerMonth));
    var months = @json(array_keys($repairsPerMonth));

    var trans = {
        chartLabel: "{{ __('Biểu đồ sửa chữa')  }}",
        new: "{{ __('Mới') }}",
        repair: "{{ __('Sửa chữa') }}",
        repairs: "{{ __('Sửa chữa ') }}"
    };
</script>
{!! HTML::script('assets/js/chart.min.js') !!}
{!! HTML::script('assets/js/as/dashboard-admin.js') !!}
