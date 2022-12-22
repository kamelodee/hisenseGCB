$( document ).ready(function() {
    ReloadGrid();

 
function ReloadGrid(){

    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    jQuery.ajax({
        url: BASE_URL+'/showrooms/gettable',
        type: 'GET',
        dataType: 'html',
        beforeSend: function() {
          
        },
        success: function( data ){

            $("#showrromgridContent").html(data);
            console.log(data);
        },
        error: function (xhr, b, c) {
            console.log("xhr=" + xhr + " b=" + b + " c=" + c);
        },
        complete: function() {
       
        }
    });
}



});
    

function ShowroomEdit(id){

    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    jQuery.ajax({
        url: BASE_URL+'/showrooms/edit/'+id,
        type: 'GET',
        //dataType: 'html',
        //data: {topic_id:id},
        beforeSend: function() {        
            //$("#submitBtn").attr('disable','disable').text('Saving....');
        },
        success: function( data ){

            console.log(data);
            
            $("#fullModalTitle").text("Edit Showroom");
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


function Showroom(id){

    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    jQuery.ajax({
        url: BASE_URL+'/showrooms/show/'+id,
        type: 'GET',
        //dataType: 'html',
        //data: {topic_id:id},
        beforeSend: function() {        
            //$("#submitBtn").attr('disable','disable').text('Saving....');
        },
        success: function( data ){

            console.log(data);
            
            $("#fullModalTitle").text(" Showroom Details");
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

function addaccount(id){

    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    jQuery.ajax({
        url: BASE_URL+'/showrooms/addcount/'+id,
        type: 'GET',
        //dataType: 'html',
        //data: {topic_id:id},
        beforeSend: function() {        
            //$("#submitBtn").attr('disable','disable').text('Saving....');
        },
        success: function( data ){

            console.log(data);
            
            $("#fullModalTitle").text("Add Account");
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
    
function showroomadd(){

    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    jQuery.ajax({
        url: BASE_URL+'/showrooms/create/',
        type: 'GET',
        
        beforeSend: function() {        
            //$("#submitBtn").attr('disable','disable').text('Saving....');
        },
        success: function( data ){

            $("#fullModalTitle").text("Add Showroom");
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