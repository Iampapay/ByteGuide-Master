$(document).ready( function() {
    $('#example').dataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });
//======================= Edit pages Image section ================
  $('.imgClose').off().on('click', function(evt){
      evt.preventDefault();
      let inputFile = $(this).parent('.hasImg').prev('.imgCls');
      inputFile.removeClass('hideMe').addClass('req');
      $(this).parent('.hasImg').remove();
    });

 });

function  deleteData(url, token){
event.preventDefault();
    swal({
        title: "Are you sure?",
        text: "You want to delete this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    },
        function () {
            $.ajax({
                type: 'POST',
                url: url,
                data: { '_method': 'delete', '_token': token},
                async: false,
                success: (response) => {
                	
                    //swal("Deleted!", "Your has been deleted.", "success");
                    window.location.reload();
                },
                error: () => {

                }

            });

        });

}

function showCategory(role){
     var values = $("#roles:checked").map(function(){
      return $(this).val();
    }).get();

     if(values.indexOf('2') != -1){
      $('#bankinformation').show();
     }else{
      $('#bankinformation').hide();
     }

     if(values.indexOf('2') != -1 || values.indexOf('4') != -1){
       $('#category-div').show();
     }else{
       $('#category-div').hide();  
     }

}

$(document).ready(function(){
    $('[data-tog="tooltip"]').mouseover(function(){
      $(this).tooltip('show');
    });
    $('[data-tog="tooltip"]').click(function(){
      $(this).tooltip('destroy');
    });
   // $('[data-tog="tooltip"]').tooltip({ trigger:'hover focus' }); 
});

  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor')

  })





