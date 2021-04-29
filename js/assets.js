$(window).on('load', function () {
    $('#asset_table').DataTable( {
        ajax: {
            url: 'get_data.php',
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
            }
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
    
    $('#validatedCustomFile').on('change',function(){
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });
    
    $('#uploadCsv').on("submit", function() {
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if(!regex.test($("#validatedCustomFile").val().toLowerCase())) {
            return false;
        }
        return true;
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

        $.ajax({
            type: "POST",
            url: "./delete.php",
            data: asset_tag,
            success: function(response) {
                if(response == 1) {
                    console.log("Successfully Deleted!");
                } else {
                    console.log("Failed to be deleted");
                }
            }
        });
        e.preventDefault();
    });
});

