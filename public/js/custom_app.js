$(function () {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "ordering": true,
        "paging": true,

    })
    $('#example2').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "ordering": true,
        "paging": false,
        "searching": true,
        "info": false,
    });
    $('#example3').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "ordering": false,
        "paging": false,
        "searching": false,
        "info": false,
    });
    $('#example4').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "ordering": true,
        "paging": false,
        "searching": true,
        "info": false,
    });
    $('#example5').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "ordering": true,
        "paging": false,
        "searching": true,
        "info": false,
    });
    $("#report").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "paging": false,
        "ordering": false,
        "info": false,
        "buttons": ["excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
})
$(function () {

});
$(function () {
    $('.select2').select2()
});
$(function () {
    $('.textarea').summernote()
})
$('.status_id').on('change', function () {
    var status_id = $(this).val();
    if (status_id == 5) {
        $(".followup-date").hide();
        $("#follow_up_date").hide();
        $("#product_form").show();
        //document.getElementById('product_form').style.display = 'block';
    } else {
        $(".followup-date").show();
        $("#follow_up_date").show();
        $("#product_form").hide();
    }
})

/*$(document).ready(function () {
    $('#addProduct').select2({
        language: {
            noResults: function () {
                return '<a href="#" id="hideShow" onclick="noResultsButtonClicked()" data-toggle="modal" data-target="#productAddModal"  title="Add New Product" class="btn btn-primary add_btn"> <i class="fa fa-plus" > </i> Add New Product</a>';
            },
        },
        escapeMarkup: function (markup) {
            return markup;
        },
    });

});
function noResultsButtonClicked() {
    $("#updateStatusModal").modal('hide');
    ("#addProduct").select2().next().hide();
}*/
$('#source_id').on('change', function () {
    var source_id = $(this).val();
    if (source_id == 6) {
        document.getElementById('champaign_list').style.display = 'block';
    } else {
        document.getElementById('champaign_list').style.display = 'none';
    }
})

$('#source_id').on('change', function () {
    var source_id = $(this).val();
    if (source_id == 7) {
        document.getElementById('reference-source').style.display = 'block';
        document.getElementById('reference-phone').style.display = 'block';
    } else {
        document.getElementById('reference-source').style.display = 'none';
        document.getElementById('reference-phone').style.display = 'none';
    }
})








