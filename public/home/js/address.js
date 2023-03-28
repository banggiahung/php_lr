(function ($) {
    'use strict';

    var $window = $(window);

    $('#province').change(function() {
        var code = $(this).val();
        var url = 'https://provinces.open-api.vn/api/p/' + code + '?depth=2';
        $.ajax({
            type: 'GET',
            url:url,
            success: function(data) {
                $('#district').empty();
                $('#district').siblings('.nice-select').remove(); // Remove existing nice-select, if any
                $('#district').append('<option value="">-- Chọn quận/huyện --</option>');
                $.each(data.districts, function(index, value) {
                    $('#district').append('<option value="' + value.code + '">' + value.name + '</option>');
                });
                $('#district').niceSelect();
            }
        });
    });
    $('#district').change(function() {
        var code = $(this).val();
        var url = 'https://provinces.open-api.vn/api/d/' + code + '?depth=2';
        console.log(url);

        $.ajax({
            type: 'GET',
            url:url,
            success: function(data) {
                $('#wards').empty();
                $('#wards').siblings('.nice-select').remove(); // Remove existing nice-select, if any
                $('#wards').append('<option value="">-- Chọn quận/huyện --</option>');
                $.each(data.wards, function(index, value) {
                    $('#wards').append('<option value="' + value.code + '">' + value.name + '</option>');
                });
                $('#wards').niceSelect();
            }
        });
    });
})(jQuery);
