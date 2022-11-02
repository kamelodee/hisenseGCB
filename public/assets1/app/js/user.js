$( document ).ready(function() {
    // ReloadGrid();

// alert('working')
// let BASE_URL ='http://localhost/trucks/truck'
// function ReloadGrid(){

//     $.ajaxSetup({
//         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
//     });
//     jQuery.ajax({
//         url: BASE_URL+'/users/gettable',
//         type: 'GET',
//         dataType: 'html',
//         beforeSend: function() {
          
//         },
//         success: function( data ){

//             $("#gridContent").html(data);
//             console.log(data);
//         },
//         error: function (xhr, b, c) {
//             console.log("xhr=" + xhr + " b=" + b + " c=" + c);
//         },
//         complete: function() {
       
//         }
//     });
// }




function SubmitAdd(e){

    e.preventDefault();

    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    jQuery.ajax({
        url: BASE_URL+'/users/store',
        type: 'POST',
        //dataType: 'html',
        data: $('#saveForm').serialize(),
        beforeSend: function() {        
            $("#submitBtn").attr('disable','disable').text('Saving....');
        },
        success: function( data ){
            console.log(data);
            $("#fullModal").modal("hide");
            ReloadGrid();
        },
        error: function (xhr, b, c) {
            console.log("xhr=" + xhr + " b=" + b + " c=" + c);
        },
        complete: function() {
            $("#submitBtn").removeAttr('disable').text('Submit');
        }
    });
}


});

function UserEdit(id){

    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    jQuery.ajax({
        url: BASE_URL+'/users/edit/'+id,
        type: 'GET',
        
        beforeSend: function() {        
            //$("#submitBtn").attr('disable','disable').text('Saving....');
        },
        success: function( data ){

            console.log(data);
            
            $("#fullModalTitle").text("Edit User");
            $("#fullModal").modal("show");
            $("#fullModalBody").html(data);
        },
        error: function (xhr, b, c) {
            console.log("xhr=" + xhr + " b=" + b + " c=" + c);
        },
        complete: function() {
            //$("#submitBtn").removeAttr('disable').text('Submit');
        }
    });


}


function Adduser(){

    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    jQuery.ajax({
        url: BASE_URL+'/users/create',
        type: 'GET',
        dataType: 'html',
        beforeSend: function() {
          
        },
        success: function( data ){

            $("#fullModalTitle").text("Add User");
            $("#fullModal").modal("show");
            $("#fullModalBody").html(data);

        },
        error: function (xhr, b, c) {
            console.log("xhr=" + xhr + " b=" + b + " c=" + c);
        },
        complete: function() {
       
        }
    });
}
