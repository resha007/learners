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
			sendData();
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
			sendData();
		}
                //$("#reset").click();
	})

	
});

function sendData(){
        if(validate() != '1'){
                $.ajax({
                    url		: './LoanTypeServlet?action='+action,
                    type	: 'POST',
                    dataType	: 'json',
                    data	: $('form').serialize(),
                    success	:function(data){
                            Toast.fire({
                                type: 'success',
                                title: data.success
                            });
                            dataLoad();
                            $("#reset").click();
                    }
                });
	}
	
}

//validations
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
		dataTables1 = $('#userTable').DataTable({
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
        dataTables1.clear().draw();
	//load data to the data table using ajax
        $.ajax({
                url		: './LoanTypeServlet',
                type		: 'GET',
                data		: {"type":"tbl"},
                success: function(data) {
                for (var i in data) {
                    if(data[i]["status"]==1)
                            data[i]["status"]="Active";
                    else if(data[i]["status"]==2)
                            data[i]["status"]="Inactive";

                    dataTables1.row.add([ 
                        data[i]["id"],
                        data[i]["code"],
                        data[i]["name"],
                        data[i]["description"],
                        data[i]["status"]
                   ]).draw();
                }
            }
         });
}

//onclick on the row of the data table, fill the textboxes to update and delete
$('#bootstrap-data-table1 tbody').on('click','tr',function(){
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
        //alert(elem[i].type);
    }
    $("#"+elem[1].id).focus();
	// for (var x=0; x < inputList.length ; x++){
 //                if(rowData[8]=="Active")
	// 		rowData[8]=1;
	// 	else if(rowData[8]=="Inactive")
	// 		rowData[8]=2;
                
	// 	document.getElementById(inputList[x]).value = rowData[x]; 
	// }
	
} );

//reset button
$("#reset").click(function(){
    $("#add").prop("disabled",false);
    $("#update").prop("disabled",true);
    $("#delete").prop("disabled",true);
});

//checks the code is already in the database
$("#txtCode").change(function(){
	var code = $("#txtCode").val().toUpperCase();

	$.ajax({
            url		: './LoanTypeServlet',
            type	: 'GET',
            data	: {"type":"tbl"},
	    success: function(data) {
	    	for (var i in data) {
	    		if(data[i]["code"]==code){
	    			Toast.fire({
                                    type: 'warning',
                                    title: 'This code is already available'
                                });
	    			$("#txtCode").val("");
	    			$("#txtCode").focus();
	    		}
	    	}
	    }
	});
});