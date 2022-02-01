<h5 id="msg"></h5>

<!-- input of cake flavor types -->
<div class="form-group">
    <label>Cake Flavor Name</label>
    <input type="text" value="" name="cake_name" id="cake_name" class="form-control" />
</div>

<!-- Total price input -->
<div class="form-group">
    <label>Total Price</label>
    <input type="number" name="price" id="total_price" value="" class="form-control" />
</div>
<!-- Discount input -->
<div class="form-group">
    <label>Discount</label>
    <input type="text" name="discount" id="discount_offer" value="" class="form-control" />
    <p id='err_dis' style="color: red;"></p>
</div>


<script>
    $(document).ready(function() {
        var name = localStorage.getItem('name'); //cake flavour types name
        var total_price = localStorage.getItem('total_price');
        var discount = localStorage.getItem('discount');
        $('#cake_name').val(name);
        $('#total_price').val(total_price);
        $('#discount_offer').val(discount);
    });
</script>