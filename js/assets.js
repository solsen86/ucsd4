$(window).ready(function () {

    var page = 1;
    var current_page = 1;
    var total_page = 0;
    var is_ajax_fire = 0;

    manageData();

    /* manage data list */
    function manageData() {
        $.ajax({
            dataType: 'json',
            url: url+'api/getData.php',
            data: {page:page}
        }).done(function(data){
            total_page = Math.ceil(data.total/10);
            current_page = page;

            $("#pagination").twbsPagination({

            });

            manageRow(data.data);
            is_ajax_fire = 1;
        });
    }

    /* Get Page Data */
    function getPageData() {
        $.ajax({
            dataType: 'json',
            url: url+'api/getData.php',
            data: {page:page}
        }).done(function(data) {
            manageRow(data.data);
        });
    }

    /* Add new Item table row */
    function manageRow(data) {
        var rows='';
        $.each(data, function(key, value) {
            rows += '<tr>';
            rows += '<td>' + value.id + '</td>'; 
            rows += '<td>' + value.bldg + '</td>'; 
            rows += '<td>' + value.room + '</td>'; 
            rows += '<td>' + value.loc + '</td>'; 
            rows += '<td>' + value.name + '</td>'; 
            rows += '<td>' + value.brand + '</td>'; 
            rows += '<td>' + value.model + '</td>'; 
            rows += '<td>' + value.type + '</td>'; 
            rows += '<td>' + value.sn + '</td>'; 
            rows += '<td>' + value.os + '</td>'; 
            rows += '<td>' + value.cpu + '</td>'; 
            rows += '<td>' + value.s_type + '</td>'; 
            rows += '<td>' + value.s_size + '</td>'; 
            rows += '<td>' + value.mem + '</td>'; 
            rows += '<td>' + value.ip + '</td>'; 
            rows += '<td>' + value.wlan + '</td>';
            rows += '<td>' + value.lan + '</td>';   
            rows += '<td>' + value.bios + '</td>'; 
            rows += '<td>' + value.sped + '</td>'; 
            rows += '<td>' + value.age + '</td>'; 
            rows += '<td>' + value.date + '</td>'; 
            rows += '<td>' + value.price + '</td>'; 
            rows += '<td>' + value.status + '</td>';
            rows += '<td data-id="' + value.id + '">';
            rows += '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item"><i class=""></i></button';
            rows += '<button data-toggle="modal" data-target="#check-out" class="btn btn-primary check-out"><i class=""></i></button';
            rows += '<button class="btn btn-danger remove-item mr-2"><i class="fas fa-trash-alt"></i></button>'
            rows += '</td>';
            rows += '</tr>'; 
        });

        // add rows to <tbody>
        $("tbody").html(rows);
    }
});

