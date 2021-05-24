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

    /* Fill table body */
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
            rows += '<button data-bs-toggle="modal" data-bs-target="#editRecord" class="btn btn-secondary edit-item mr-2"><i class="fas fa-pen"></i></button>';
            // rows += '<button data-bs-toggle="modal" data-bs-target="#checkOut" class="btn btn-secondary mr-2"><i class="fas fa-user-check"></i></button>';
            rows += '<button class="btn btn-danger remove-item mr-2"><i class="fas fa-trash-alt"></i></button>';
            rows += '</div>';
            rows += '</td>';
            rows += '</tr>'; 
        });

        console.log(rows);

        // add rows to <tbody>
        $("tbody").html(rows);
    } 

    // validate and submit form data for new item
    $("body").on('click', '.add-record',function (e) {
        'use strict';
        e.preventDefault();

        if (!$("#addForm")[0].checkValidity()) {
            e.stopPropagation();
        }

        $("#addForm")[0].classList.add('was-validated');

        //variables from form
        var sped;
        if(document.getElementById("spedCheck").checked) {
            sped = "YES";
        } else {
            sped = "NO";
        }
        
        var data = {};
        data["id"] = $("#addNew").find("input[name='id']").val();
        data["bldg"] = $("#addNew").find("select[name='bldg']").children("option:selected").val();
        data["room"] = $("#addNew").find("input[name='room']").val();
        data["loc"] = $("#addNew").find("input[name='loc']").val();
        data["name"] = $("#addNew").find("input[name='name']").val();
        data["brand"] = $("#addNew").find("input[name='brand']").val();
        data["model"] = $("#addNew").find("input[name='model']").val();
        data["type"] = $("#addNew").find("select[name='type']").children("option:selected").val();
        data["sn"] = $("#addNew").find("input[name='sn']").val();
        data["os"] = $("#addNew").find("select[name='os']").children("option:selected").val();
        data["cpu"] = $("#addNew").find("input[name='cpu']").val();
        data["s_type"] = $("#addNew").find("select[name='s_type']").children("option:selected").val();
        data["s_size"] = $("#addNew").find("input[name='s_size']").val();
        data["mem"] = $("#addNew").find("input[name='mem']").val();
        data["ip"] = $("#addNew").find("input[name='ip']").val();
        data["wlan"] = $("#addNew").find("input[name='wlan']").val();
        data["lan"] = $("#addNew").find("input[name='lan']").val();
        data["bios"] = $("#addNew").find("input[name='bios']").val();
        data["sped"] = sped;
        data["date"] = $("#addNew").find("input[name='date']").val();
        data["price"] = $("#addNew").find("input[name='price']").val();
        data["status"] = $("#addNew").find("select[name='status']").children("option:selected").val();
        
        // show data collected from the form
        console.log(data);

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: './api/addNew.php',
            data: {data:data}
        }).done(function(data) {
            $("#addNew").find("input[name='id']").val('');
            $("#addNew").find("select[name='bldg']").val("");
            $("#addNew").find("input[name='room']").val('');
            $("#addNew").find("input[name='loc']").val('');
            $("#addNew").find("input[name='name']").val('');
            $("#addNew").find("input[name='brand']").val('');
            $("#addNew").find("input[name='model']").val('');
            $("#addNew").find("select[name='type']").val("");
            $("#addNew").find("input[name='sn']").val('');
            $("#addNew").find("select[name='os']").val("");
            $("#addNew").find("input[name='cpu']").val('');
            $("#addNew").find("select[name='s_type']").val("");
            $("#addNew").find("input[name='s_size']").val('');
            $("#addNew").find("input[name='mem']").val('');
            $("#addNew").find("input[name='ip']").val('');
            $("#addNew").find("input[name='wlan']").val('');
            $("#addNew").find("input[name='lan']").val('');
            $("#addNew").find("input[name='bios']").val('');
            $("#addNew").find("input[name='sped']").prop('checked', false); //unchecks sped checkbox
            $("#addNew").find("input[name='date']").val('');
            $("#addNew").find("input[name='price']").val('');
            $("#addNew").find("select[name='status']").val("");
            
            $("#addForm")[0].classList.remove('was-validated');
            getData();
            $("#addNew").modal('hide');

        });
    });

    /* Populate Edit Record Modal Data*/
    $("body").on("click", ".edit-item", function() {

        //get fields from row
        var id = $(this).parents("td").data("id");
        var status = $(this).parents("td").prev("td").text();
        var price = $(this).parents("td").prev("td").prev("td").text();
        var date = $(this).parents("td").prev("td").prev("td").prev("td").text();
        var sped = $(this).parents("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
        var bios = $(this).parents("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
        var lan = $(this).parents("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
        var wlan = $(this).parents("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
        var ip = $(this).parents("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
        var mem = $(this).parents("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
        var s_size = $(this).parents("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
        var s_type = $(this).parents("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
        var cpu = $(this).parents("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
        var os = $(this).parents("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
        var sn = $(this).parents("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
        var type = $(this).parents("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
        var model = $(this).parents("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
        var brand = $(this).parents("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
        var name = $(this).parents("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
        var loc = $(this).parents("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
        var room = $(this).parents("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
        var bldg = $(this).parents("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
        var hidden_id = $(this).parents("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();

        // filling data fields for the edit form with current information
        $("#editForm").find("input[name='id']").val(id);
        $("#editForm").find("select[name='bldg']").val(bldg);
        $("#editForm").find("input[name='room']").val(room);
        $("#editForm").find("input[name='loc']").val(loc);
        $("#editForm").find("input[name='name']").val(name);
        $("#editForm").find("input[name='brand']").val(brand);
        $("#editForm").find("input[name='model']").val(model);
        $("#editForm").find("select[name='type']").val(type);
        $("#editForm").find("input[name='sn']").val(sn);
        $("#editForm").find("select[name='os']").val(os);
        $("#editForm").find("input[name='cpu']").val(cpu);
        $("#editForm").find("select[name='s_type']").val(s_type);
        $("#editForm").find("input[name='s_size']").val(s_size);
        $("#editForm").find("input[name='mem']").val(mem);
        $("#editForm").find("input[name='ip']").val(ip);
        $("#editForm").find("input[name='wlan']").val(wlan);
        $("#editForm").find("input[name='lan']").val(lan);
        $("#editForm").find("input[name='bios']").val(bios);
        $("#editForm").find("input[name='hidden_id']").val(hidden_id);

        if(sped == "YES") {
            $("#editForm").find("input[name='sped']").prop('checked', true); //checks sped checkbox
        } else {
            $("#editForm").find("input[name='sped']").prop('checked', false); //unchecks sped checkbox
        }
        
        $("#editForm").find("input[name='date']").val(date);
        $("#editForm").find("input[name='price']").val(price);
        $("#editForm").find("select[name='status']").val(status);
    });

    /* Update Record Request */
    $("body").on("click", ".update-record", function(e) {
        'use strict';
        e.preventDefault();

        if (!$("#editForm")[0].checkValidity()) {
            e.stopPropagation();
        }

        $("#editForm")[0].classList.add('was-validated');

        //variables from form
        var sped;
        if(document.getElementById("spedCheck").checked) {
            sped = "YES";
        } else {
            sped = "NO";
        }

        var data = {};
        data["row"] = $("#editForm").find("input[name='hidden_id']").val();
        data["id"] = $("#editForm").find("input[name='id']").val();
        data["bldg"] = $("#editForm").find("select[name='bldg']").children("option:selected").val();
        data["room"] = $("#editForm").find("input[name='room']").val();
        data["loc"] = $("#editForm").find("input[name='loc']").val();
        data["name"] = $("#editForm").find("input[name='name']").val();
        data["brand"] = $("#editForm").find("input[name='brand']").val();
        data["model"] = $("#editForm").find("input[name='model']").val();
        data["type"] = $("#editForm").find("select[name='type']").children("option:selected").val();
        data["sn"] = $("#editForm").find("input[name='sn']").val();
        data["os"] = $("#editForm").find("select[name='os']").children("option:selected").val();
        data["cpu"] = $("#editForm").find("input[name='cpu']").val();
        data["s_type"] = $("#editForm").find("select[name='s_type']").children("option:selected").val();
        data["s_size"] = $("#editForm").find("input[name='s_size']").val();
        data["mem"] = $("#editForm").find("input[name='mem']").val();
        data["ip"] = $("#editForm").find("input[name='ip']").val();
        data["wlan"] = $("#editForm").find("input[name='wlan']").val();
        data["lan"] = $("#editForm").find("input[name='lan']").val();
        data["bios"] = $("#editForm").find("input[name='bios']").val();
        data["sped"] = sped;
        data["date"] = $("#editForm").find("input[name='date']").val();
        data["price"] = $("#editForm").find("input[name='price']").val();
        data["status"] = $("#editForm").find("select[name='status']").children("option:selected").val();
        
        // show data collected from the form
        console.log(data);

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: './api/update.php',
            data: {data:data}
        }).done(function(data) {
            $("#editForm").find("input[name='id']").val('');
            $("#editForm").find("input[name='hidden_id']").val('');
            $("#editForm").find("select[name='bldg']").val('');
            $("#editForm").find("input[name='room']").val('');
            $("#editForm").find("input[name='loc']").val('');
            $("#editForm").find("input[name='name']").val('');
            $("#editForm").find("input[name='brand']").val('');
            $("#editForm").find("input[name='model']").val('');
            $("#editForm").find("select[name='type']").val('');
            $("#editForm").find("input[name='sn']").val('');
            $("#editForm").find("select[name='os']").val("");
            $("#editForm").find("input[name='cpu']").val('');
            $("#editForm").find("select[name='s_type']").val("");
            $("#editForm").find("input[name='s_size']").val('');
            $("#editForm").find("input[name='mem']").val('');
            $("#editForm").find("input[name='ip']").val('');
            $("#editForm").find("input[name='wlan']").val('');
            $("#editForm").find("input[name='lan']").val('');
            $("#editForm").find("input[name='bios']").val('');
            $("#editForm").find("input[name='sped']").prop('checked', false); //unchecks sped checkbox
            $("#editForm").find("input[name='date']").val('');
            $("#editForm").find("input[name='price']").val('');
            $("#editForm").find("select[name='status']").val("");
            
            $("#editForm")[0].classList.remove('was-validated');
            getData();
            $("#editForm").modal('hide');

        });
    })

    /* Remove Record */
    $("body").on("click", ".remove-item", function() {        
        
        var id = $(this).parents("td").data('id');
        var row = $(this).parents("tr");

        console.log(id)

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: './api/delete.php',
            data: {id:id}
        }).done(function(data){
            row.remove();
            getData();
        });
    });
});

