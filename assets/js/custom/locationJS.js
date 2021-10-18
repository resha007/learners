//$(document).ready(function() {
    $("#update").prop("disabled",true);
    $("#delete").prop("disabled",true);
    var action,data = '';

    const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
    });

    $("#add").click(function(){
        action = "add";
        sendData();
    });

    $("#update").click(function(){
        action = "update";
        data = $('form').serialize();

        Swal.fire({
            width:'400px',
            padding:null,
            title: 'Are you sure?',
            position: 'top-end',
            text: "You won't be able to revert this!",
            allowEnterKey: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Update it!'
        }).then((result) => {
            if (result.value) {
                updateData();
            }
                    //$("#reset").click();
        })

        
    });

    $("#delete").click(function(){
        action = "delete";
        data = $('form').serialize();

        Swal.fire({
            width:'400px',
            padding:null,
            title: 'Are you sure?',
            position: 'top-end',
            text: "You won't be able to revert this!",
            allowEnterKey: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                deleteData();
            }
                    //$("#reset").click();
        })

        
    });

    function sendData(){
            if(validate() != '1'){
                $.ajax({
                    type : "POST",
                    url		: "location/save",
                    dataType : 'json',
                    async : true,
                    data	: $('form').serialize(),
                    success: function(data) {//alert(data);
                        if(data){
                            Toast.fire({
                                type: 'success',
                                title: 'Successfully added'
                            });
                        }else{
                            Toast.fire({
                                type: 'error',
                                title: 'Something went wrong. Please try again.'
                            });
                        }
                    
                        dataLoad();
                        $("#reset").click();
                    }
                });
        }
        
    }

    function updateData(){
        if(validate() != '1'){
            $.ajax({
                type : "POST",
                url		: "location/update",
                dataType : 'json',
                async : true,
                data	: $('form').serialize(),
                success: function(data) {//alert(data);
                    if(data){
                        Toast.fire({
                            type: 'success',
                            title: 'Successfully updated'
                        });
                    }else{
                        Toast.fire({
                            type: 'error',
                            title: 'Something went wrong. Please try again.'
                        });
                    }
                
                    dataLoad();
                    $("#reset").click();
                }
            });
        }
    }

    function deleteData(){
        if(validate() != '1'){
            $.ajax({
                type : "POST",
                url		: "location/delete",
                dataType : 'json',
                async : true,
                data	: $('form').serialize(),
                success: function(data) {//alert(data);
                    if(data){
                        Toast.fire({
                            type: 'success',
                            title: 'Successfully deleted'
                        });
                    }else{
                        Toast.fire({
                            type: 'error',
                            title: 'Something went wrong. Please try again.'
                        });
                    }
                
                    dataLoad();
                    $("#reset").click();
                }
            });
        }
    }

    // //validations
    function validate(){
        var err = 0;

        var elem = document.getElementById('dataForm').elements;
        for(var i = 0; i < elem.length; i++){
            if(elem[i].type != "button" && elem[i].type != "reset" && elem[i].id != "txtId"){
                if(elem[i].value == '' || elem[i].value == '0'){
                    Toast.fire({
                        type: 'warning',
                        title: 'This field is required'
                        });
                        $("#"+elem[i].id).focus();
                    err = 1;
                    return err;
                }
            }
        }
    }

    var dataTables1 = null;

    //body onload function
    function dataLoad(){
        //initialize the data table
        if(dataTables1==null){
            dataTables1 = $('#datatable').DataTable({
                responsive: true,
                "columnDefs": [
                    {
                        "targets": [ 0 ],
                        "visible": false,
                        "searchable": false
                    },
                        {
                        "targets": [ 0,1,2],
                        "defaultContent": ""
                    }
                ]
            });
        }
        dataTables1.clear().draw();;
        //load data to the data table using ajax
            $.ajax({
                    type  : 'ajax',
                    url		: "location/get",
                    dataType : 'json',
                    async : true,
                    success: function(data) {//alert(data);
                    for (var i in data) {
                        if(data[i]["status"]=='A')
                                data[i]["status"]="Active";
                        else if(data[i]["status"]=='I')
                                data[i]["status"]="Inactive";

                        dataTables1.row.add([ 
                            data[i]["id"],
                            data[i]["name"],
                            data[i]["description"],
                            data[i]["status"]
                    ]).draw();
                    }
                }
            });
    }

    //onclick on the row of the data table, fill the textboxes to update and delete
    $('#datatable tbody').on('click','tr',function(){
        $("#add").prop("disabled",true);
        $("#update").prop("disabled",false);
        $("#delete").prop("disabled",false);

        var rowData = dataTables1.row(this).data();
        //console.log('rowData: '+rowData);
        //alert(rowData);
        var elem = document.getElementById('dataForm').elements;
        for(var i = 0; i < elem.length; i++)
        {
            if(elem[i].type != "button" && elem[i].type != "reset"){
                elem[i].value = rowData[i];
            }
        }
        $("#"+elem[1].id).focus();
        
    } );
//});
