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

    
    $('.removeEvent').click(function(e){
      e.preventDefault();
      $(this).closest('.delete_whole_extra_item_add').remove();
    });


    // student role generate script
    $(document).on('click', '#roleSearch', function(e){
      e.preventDefault();

      let year_id = $('#year').val();
      let class_id = $('#class').val();
      
      // alert(year_id + - + class_id);

      $.ajax({
        url : "/students/roll/getstudent",
        type : 'GET',
        data : {'year' : year_id, 'class' : class_id}, 
        success : function(data){
          // alert(data);

          $('#role-generate').removeClass('d-none');
          let table_body = '';

          $.each(data, function(key, value){
            $.each(value, function(k, v){

              table_body += `
                <tr>
                  <td>${v.student.id_no} <input class="form-control" type="hidden" name="student_id[]" placeholder="roll" value="${v.student_id}"></td>
                  <td>${v.student.name}</td>
                  <td>${v.student.f_name}</td>
                  <td>${v.student.gender}</td>
                  <td><input class="form-control" type="text" name="roll[]" placeholder="roll" value="${v.roll} "></td>
                </tr>
                `;

            });
          });



          $('#role-generate-body').html(table_body);

        }
      });

    });




      
  });
})(jQuery);

