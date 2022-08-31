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
    
})