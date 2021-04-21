$(window).on('load', function () {
    $('#asset_table').DataTable( {
        ajax: {
            url: 'get_data.php',
            contentType: 'application/json'
        },
        columns: [
            {data: 'loc'},
            {data: 'id'},
            {data: 'name'},
            {data: 'serial'},
            {data: 'sped'},
            {data: 'status'},
            {data: 'actions'},
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
            }
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
                targets: [4]
            },
            { 
                searchPanes:{
                    show: true
                },
                targets: [5]
            }
        ],
        dom: 'Bfrtip',
        pageResize: true,
        stateSave: true
    });


});