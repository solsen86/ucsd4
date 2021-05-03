$(window).on('load change', function () {
    $('#asset_table').DataTable( {
        ajax: {
            url: './get_data.php',
            contentType: 'application/json'
        },
        columns: [
            {data: 'building'}, // 0
            {data: 'room'},     // 1
            {data: 'location'}, // 2
            {data: 'id'},       // 3
            {data: 'name'},     // 4
            {data: 'brand'},    // 5
            {data: 'model'},    // 6
            {data: 'type'},     // 7
            {data: 'serial'},   // 8
            //{data: 'os'},
            //{data: 'cpu'},
            //{data: 'hdd_type'},
            //{data: 'hdd_size'},
            //{data: 'mem'},
            //{data: 'wlan'},
            //{data: 'lan'},
            //{data: 'ip'},
            //{data: 'bios'},
            {data: 'sped'},     // 9
            //{data: 'date'},
            {data: 'age'},      // 10
            //{data: 'price'},
            {data: 'status'},   // 11
            {data: 'actions'}   // 12
        ],
        language: {
            searchPanes: {
                clearMessage: 'Clear All',
                collapse: {0: '<i class="fas fa-filter"></i>', _: '<i class="fas fa-filter"></i>'},
                emptyPanes: null
            },
            emptyTable: "No records exist in Database",
        },
        buttons: [
            {
                extend: 'searchPanes',
                config: {
                    cascadePanes: true
                }
            },
            // {
            //     extend: 'colvis',
            //     collectionLayout: 'fixed four-column'
            // }
        ],
        columnDefs: [
            { 
                searchPanes:{
                    show: true
                },
                targets: [0],
            },
            { 
                searchPanes:{
                    show: true
                },
                targets: [1],
            },
            { 
                searchPanes:{
                    show: true
                },
                targets: [2]
            }
        ],
        dom: 'Bfrtip',
        //scrollX: true,
        responsive: true,
        //colReorder: true,
        pageResize: true,
        stateSave: true
    });
    
    $('#filepath').on('change',function(){
        //get the file name
        var fileName = $(this).val().split("\\").pop();
        //replace the "Choose a file" label
        $('#filename').addClass("selected").html(fileName);
    });
    
    $('#uploadCsv').on("submit", function(e) {
    
        var file_name = $(this).serialize();
        console.log(file_name)

        e.preventDefault();
    });

    $('#deleteRecord').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var deviceId = button.data('id');
        //var link = "location.href='delete.php?id=" + deviceId + "'";
        //console.log(link);
    
        var modal = $(this);
        modal.find('.modal-title').text('Device ' + deviceId);
        modal.find('.modal-body p').text('Are you sure you want to delete device ' + deviceId + '?');
        modal.find('#asset_tag').val(deviceId);
        //modal.find('#delete').attr("onclick", link);
    });

    $('#deleteForm').on('submit', function(e) {
        var asset_tag = $(this).serialize();
        console.log(asset_tag);

        var elem = document.getElementById(asset_tag.split('=')[1]);
        var row = $(elem).closest('tr');

        // hide modal after submit
        $('#deleteRecord').modal('hide')

        $.ajax({
            type: "POST",
            url: "./delete.php",
            data: asset_tag,
            success: function(response) {
                if(response == 1) {
                    console.log("Successfully Deleted!");
                    // remove row
                    $(row).css('background', 'tomato');
                    $(row).fadeOut(800, function() {
                        $(this).remove();
                    });

                    $('#result').append('<div id="alert-result" class="alert alert-success" role="alert"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Record removed successfully!</strong></div>');

                    setTimeout(function() {
                        $('#alert-result').remove();
                    }, 5000);

                    
                    //$('#asset_table').DataTable().ajax.reload();
                } else {
                    console.log("Failed to be deleted");
                    $('#result').append('<div id="alert-result" class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failed to remove record!</strong></div>');
                    
                    setTimeout(function() {
                        $('#alert-result').remove();
                    }, 5000);
                }
            }
        });
        e.preventDefault();
    });
});

