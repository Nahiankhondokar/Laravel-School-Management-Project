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


    /**
     * student roll generate script
     */
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


    /**
     * student Registration fee script
     */
    $(document).on('click', '#regFeeSearch', function(e){
      // e.preventDefault();

      let year_id = $('#year').val();
      let class_id = $('#class').val();
      
      // alert(year_id + - + class_id);

      $.ajax({
        url : "/students/registration/fee/class/data",
        type : "get",
        data : {'year' : year_id, 'class' : class_id}, 
        beforeSend : function(){

        },
        success : function(data){
          // alert(data);
          let source = $('#document_template').html();
          let template = Handlebars.compile(source);
          let html = template(data);
          $('#DocumentResults').html(html);
          $('[data-toggle="tooltip"]').tooltip();
        }
      });
      
    });


    /**
   * student Monthly fee script
   */
    $(document).on('click', '#monthlyFeeSearch', function(e){
      // e.preventDefault();

      let year_id = $('#year').val();
      let class_id = $('#class').val();
      let month = $('#month').val();
      
      // alert(year_id + - + class_id);

      $.ajax({
        url : "/students/monthly/fee/class/data",
        type : "get",
        data : {'year' : year_id, 'class' : class_id, 'month': month}, 
        beforeSend : function(){

        },
        success : function(data){
          // alert(data);
          let source = $('#document_template').html();
          let template = Handlebars.compile(source);
          let html = template(data);
          $('#DocumentResults').html(html);
          $('[data-toggle="tooltip"]').tooltip();
        }
      });
      
    });





    /**
   * student exam fee script
   */
     $(document).on('click', '#examFeeSearch', function(e){
      // e.preventDefault();

      let year_id = $('#year').val();
      let class_id = $('#class').val();
      let exam_type_id = $('#exam_type_id').val();
      
      // alert(year_id + - + class_id);

      $.ajax({
        url : "/students/exam/fee/class/data",
        type : "get",
        data : {'year' : year_id, 'class' : class_id, 'exam_type_id': exam_type_id}, 
        beforeSend : function(){

        },
        success : function(data){
          // alert(data);
          let source = $('#document_template').html();
          let template = Handlebars.compile(source);
          let html = template(data);
          $('#DocumentResults').html(html);
          $('[data-toggle="tooltip"]').tooltip();
        }
      });
      
    });
    

    /**
     *  employee leave purpose
     */
     $(document).on('click', '#leave_purpose', function(e){
      // e.preventDefault();

      let new_purpose = $(this).val();
      if(new_purpose == 0){
        $('#new_purpose').slideDown();
      }else {
        $('#new_purpose').slideUp();
      }
    
      
    });
    


      
  });
})(jQuery);

