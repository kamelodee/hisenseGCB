$( document ).ready(function() {
    // ReloadGrid();

 
function ReloadGrid(){

    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    jQuery.ajax({
        url: BASE_URL+'/transactions/gettable',
        type: 'GET',
        dataType: 'html',
        beforeSend: function() {
          
        },
        success: function( data ){

            $("#gridContent").html(data);
            console.log(data);
        },
        error: function (xhr, b, c) {
            console.log("xhr=" + xhr + " b=" + b + " c=" + c);
        },
        complete: function() {
       
        }
    });
}


function Edit(id){

    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    jQuery.ajax({
        url: BASE_URL+'/transactions/edit/'+id,
        type: 'GET',
        //dataType: 'html',
        //data: {topic_id:id},
        beforeSend: function() {        
            //$("#submitBtn").attr('disable','disable').text('Saving....');
        },
        success: function( data ){

            console.log(data);
            
            $("#fullModalTitle").text("Edit Topic");
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
    
function add(id){

    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    jQuery.ajax({
        url: BASE_URL+'/transactions/add/'+id,
        type: 'GET',
        
        beforeSend: function() {        
            //$("#submitBtn").attr('disable','disable').text('Saving....');
        },
        success: function( data ){

            $("#fullModalTitle").text("Edit Topic");
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


  

});

  
function TransactionDetails(id){
    console.log(id)
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
        jQuery.ajax({
            url: BASE_URL+'/transactions/details/'+id,
            type: 'GET',
            
            beforeSend: function() {        
                //$("#submitBtn").attr('disable','disable').text('Saving....');
            },
            success: function( data ){
    
                console.log(data);
                
                $("#fullModalTitle").text("Transaction Details");
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