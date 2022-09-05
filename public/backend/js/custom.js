(function($){
  $(document).ready(function(){

      // img preview system
      $('#inputTag').change(function(e){
          let reader = new FileReader();
          reader.onload = function(e){
              $('#imgPriview').attr('src', e.target.result);
          }

          reader.readAsDataURL(e.target.files[0]);
      });


      // sweet alert show befor delete
      $(document).on('click', '#delete', function(e){
          e.preventDefault();

          let link = $(this).attr('href');

          Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                  window.location.href = link;
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
              }
            })

      });



      // Add extra item in fee category amount page
      $(document).on('click', '.addEventMore', function(e){
        e.preventDefault();

        let add_extra_item = $('#Whole_extra_item_add').html();
        $('.add_item').append(add_extra_item);


      });


      $(document).on('click', '.removeEvent', function (e){
        e.preventDefault();
        /**
         * where i am clicking, most closest .delete_whole_extra_itme_add will be deleted.
         * although the other classes are same.
         * closest will work only where i am clicking, exactly this class will remove
         */
        $(this).closest('.delete_whole_extra_item_add').remove();
        
      });

      
  });
})(jQuery);

