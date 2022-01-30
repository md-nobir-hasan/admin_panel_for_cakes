<h5 id="msg"></h5>
<div class="form-group">
    <label>Cake Flavor Name</label>
    <input type="text" value="" name="cake_name" id="cake_name" class="form-control" />
</div>

<div class="form-group">
    <label>Total Price</label>
    <input type="number" name="price" id="total_price" value="" class="form-control" />
</div>

<div class="form-group">
    <label>Discount</label>
    <input type="text" name="discount" id="discount_offer" value="" class="form-control" />
    <p id='err_msg' style="color: red;"></p>
</div>


<script>
    $(document).ready(function() {
        var name = localStorage.getItem('name');
        var total_price = localStorage.getItem('total_price');
        var discount = localStorage.getItem('discount');
        // alert(name);
        // alert(total_price);
        // alert(discount);
        // document.getElementById("nobir").innerHTML = "yes possible";
        // $('#nobir').html("name");
        // alert(name);
        //var id = localStorage.getItem('id');
        $('#cake_name').val(name);
        $('#total_price').val(total_price);
        $('#discount_offer').val(discount);

        //   $('#gender').val(gender);
        //   $('#designation').val(designation);
        //   $('#age').val(age);
        //   if(images != '')
        //   {
        //    $('#uploaded_image').html('<img src="images/'+images+'" class="img-thumbnail" width="100" />');
        //    $('#hidden_images').val(images);
        //   }
    });
</script>