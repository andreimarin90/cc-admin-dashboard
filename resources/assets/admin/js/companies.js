(function ($) {
    $('.select2').select2({
        placeholder: "Please select an industry",
        allowClear: true
    });
    $('.status-toggle').bootstrapToggle({
        on: "Active",
        off: "Inactive"
    });
})(jQuery);
