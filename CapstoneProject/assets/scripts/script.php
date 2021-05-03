<script>
$(document).ready(function(){

    // On Loads
    $.get('/categories/api_get',
        function(res){
            set_categories(res.categories);
        }
    )
    // End of On Loads
    var files = {};

    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;
            files = input.files;

            for (var i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                var file = files[i];
                reader.fileName = file.name;
                reader.index = i;
                reader.onload = function(event) {
                    var element = $(`
                    <div class="image my-2 d-flex align-items-center">
                        <i class="fa fa-bars mr-2"></i>
                        <div class="product-image">
                        </div>
                        <span class="mx-2 product-name">Milo.jpg</span>
                        <i class="fa fa-trash delete-image text-danger" aria-hidden="true"></i>
                        <input type="checkbox" name="main" data-imgindex="${event.target.index}" class="img-main ml-3 mr-1">
                        <label for="" class="m-0">Main</label>
                    </div>
                    `);
                    var img = $('<img>').css('width',50).css('height',50);
                    element.find(".product-name").html(event.target.fileName);
                    img.attr('src', event.target.result).appendTo(element.find('.product-image'));
                    element.appendTo(placeToInsertImagePreview)
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };


    $("#multiple-upload").change(function(){
        imagesPreview(this, 'div.my-images');
    });

    $('.select-categories').hover(function(){
    
        $('.my-categories').css('height',"auto");
        $('.my-categories').css('border'," 1px solid #ced4da");
    },function(){
        $('.my-categories').css('height',0);
        $('.my-categories').css('border',"none");
    });





 
    $(document).on('click','.img-main',function(e){
        console.log();
        if ($(this).is(":checked")) {
            $('.img-main').prop("checked",false);
            $(this).prop("checked", true);
        }else{
            $(this).prop("checked", false);
        }
    
    })

  


    $(document).on('click','.my-categories li',function(e){
        e.stopPropagation();
        var cat_name = $(this).find('.cat_name').text();
        var cat_id = $($(this).children()[0]).attr('data-catid');
        console.log(cat_id);
        $('.category').html(cat_name);
        $('.category').attr('data-catid',cat_id);
    })





    $(document).on('click','.delete-category',function(e){
        e.stopPropagation();
        var bool = confirm("Do you want to delete the Category? ");
        var id = $(this).parent().parent().attr('data-catid');

        var csrf_name = $('#csrf').attr('name');
        var csrf_val = $('#csrf').val();
        if(bool){
            // ajax
            $.ajax({
                url: '/categories/delete',
                type: 'post',     
                data:{
                    cat_id: id,
                    [csrf_name]: csrf_val
                },              
                success: function(data) {
                    set_categories(data.categories);
                },
                error:function(data){
                    console.log(data);
                }
            });
        }
    })


    $(document).on('click','.edit-cat-input',function(e){
        e.stopPropagation();
    })

    $(document).on('blur','.edit-cat-input',function(e){
        e.stopPropagation();
        var val = $(this).val();
        var parent = $(this).parent();
        var id = $(this).parent().parent().attr('data-catid');
  
        $(this).parent().html('');
        parent.html(val);

        var csrf_name = $('#csrf').attr('name');
        var csrf_val = $('#csrf').val();
        
        if(val!=""){
            $.ajax({
                url: '/categories/update',
                type: 'post',     
                data:{
                    cat_id: id,
                    name: val,
                    [csrf_name]: csrf_val
                },              
                success: function(data) {
                    // set_categories(data.categories);
                    console.log(data);
                },
                error:function(data){
                    console.log(data);
                }
            });
        }
    })


    $(document).on('click','.edit-category',function(e){
        e.stopPropagation();
        var cat_name = $(this).parent().siblings();
        var cat_id = $(this).parent().parent().attr('data-catId');
        console.log(cat_id);

        var text = $(cat_name[0]).text();

        // console.log(text);

        $(cat_name[0]).html('')
        var el = $(`<input type="text" class="edit-cat-input" value="${text}">`);
        $(cat_name[0]).append(el);

    })


    function set_categories($arr){
        $('.my-categories ul').html('');
        $arr.forEach((d)=>{
            var el = $(`<li>
                  <div class="d-flex" data-catId="${d.id}">
                      <div class="col-6 cat_name">${d.name}</div>
                      <div class="col-6 text-right actions">
                        <i class="fa mx-2 fa-pencil edit-category"></i>
                        <i class="fa fa-trash text-danger delete-category"></i>
                      </div>
                  </div>
                 </li>`);
                 $('.my-categories ul').append(el);
        });
    }


    $('#add-category').on('blur',function(){
        var new_cat = $(this).val();
        var self = this;

        var csrf_name = $('#csrf').attr('name');
        var csrf_val = $('#csrf').val();
       
        if(new_cat != ""){
            $.ajax({
                url: '/categories/create',
                type: 'post',     
                data:{
                    name: new_cat,
                    [csrf_name]: csrf_val
                },              
                success: function(data) {
                    console.log(data);
                    $(self).val('');
                    set_categories(data.categories);
                },
                error:function(data){
                    console.log(data);
                }
            });
        }
    });


    $('#add-product-form').submit(function(e){
        e.preventDefault();
        
        var csrf_name = $('#csrf').attr('name');
        var csrf_val = $('#csrf').val();
       
        var form_data = new FormData();

        var product = {
            category_id:$('.category').attr('data-catid'),
            name:$('#product-name').val(),
            description:$('#product-description').val(),
            price:$('#product-price').val(),
            main_image:$('.img-main:checked').attr('data-imgindex'),
            stocks:$('#product-stocks').val(),
            [csrf_name]: csrf_val
        }

        console.log(product);

  

        for ( var key in product ) {
            form_data.append(key, product[key]);
        }

        for (var index = 0; index < files.length; index++) {
            form_data.append("files[]", files[index]);
        }

        $.ajax({
                url: '/products/create',
                type: 'post',
                contentType: false,
                cache: false,
                processData: false,
                data:form_data,              
                success: function(data) {
                    location.reload();
                    console.log(data);
                },
                error:function(data){
                    console.log(data);
                }
            });


        return false;
    });
});

</script>