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


});