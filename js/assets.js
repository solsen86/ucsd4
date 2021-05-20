$(window).ready(function () {

    getData();

    /* manage data list */
    function getData() {
        $.ajax({
            dataType: 'json',
            url: './api/getData.php',
        }).done(function(data){
            manageRow(data.data);
        });
    }

    // /* Get Page Data */
    // function getPageData() {
    //     $.ajax({
    //         dataType: 'json',
    //         url: './api/getData.php',
    //         data: {page:page}
    //     }).done(function(data) {
    //         manageRow(data.data);
    //     });
    // }

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
            rows += '<div class="btn-group" role="group">';
            rows += '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item mr-2"><i class="fas fa-pen"></i></button>';
            rows += '<button data-toggle="modal" data-target="#check-out" class="btn btn-primary check-out mr-2"><i class="fas fa-user-check"></i></button>';
            rows += '<button class="btn btn-danger remove-item mr-2"><i class="fas fa-trash-alt"></i></button>'
            rows += '</div>';
            rows += '</td>';
            rows += '</tr>'; 
        });

        // add rows to <tbody>
        $("tbody").html(rows);
    }

    /* Create New Record */
    $(".add-record").click(function(e){
        e.preventDefault();

        //variables from form
        var sped;
        if(document.getElementById("spedCheck").checked) {
            sped = $("#addNew").find("input[name='sped'").val();
        } else {
            sped = "NO";
        }

        var data = [];
        data["id"] = $("#addNew").find("input[name='id'").val();
        data["bldg"] = $("#addNew").find("input[name='bldg'").val();
        data["room"] = $("#addNew").find("input[name='room'").val();
        data["loc"] = $("#addNew").find("input[name='loc'").val();
        data["name"] = $("#addNew").find("input[name='name'").val();
        data["brand"] = $("#addNew").find("input[name='brand'").val();
        data["model"] = $("#addNew").find("input[name='model'").val();
        data["type"] = $("#addNew").find("input[name='type'").val();
        data["sn"] = $("#addNew").find("input[name='sn'").val();
        data["os"] = $("#addNew").find("input[name='os'").val();
        data["cpu"] = $("#addNew").find("input[name='cpu'").val();
        data["s_type"] = $("#addNew").find("input[name='s_type'").val();
        data["s_size"] = $("#addNew").find("input[name='s_size'").val();
        data["mem"] = $("#addNew").find("input[name='mem'").val();
        data["ip"] = $("#addNew").find("input[name='ip'").val();
        data["wlan"] = $("#addNew").find("input[name='wlan'").val();
        data["lan"] = $("#addNew").find("input[name='lan'").val();
        data["bios"] = $("#addNew").find("input[name='bios'").val();
        data["sped"] = sped;
        data["date"] = $("#addNew").find("input[name='date'").val();
        data["price"] = $("#addNew").find("input[name='price'").val();
        data["status"] = $("#addNew").find("input[name='status'").val();

        console.log(data);

        if(data['id'] != '' && data['sn'] != '') {
            $.ajax({
                dataType: 'json',
                type: 'POST',
                url: './api/addNew.php',
                data: {data:data}
            })
        }
    });

    /* Remove Record */
    $("body").on("click", ".remove-item", function() {
        var id = $(this).parent("td").data('id');
        var row = $(this).parent("tr");


        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: './api/delete.php',
            data: {id:id}
        }).done(function(data){
            row.remove();
            manageData();
        });
    });
});

