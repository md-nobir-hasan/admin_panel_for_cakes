
<!-- This modal body for product +,- without discount  -->
<div>
    <form>
        <input id="num_p_out_dis" type="number" value="">
    </form>
</div>




<script>
    $(document).ready(function(){

     var num_sold_pro_out_dis = localStorage.getItem("num_sold_pro_out_dis");
     $('#num_p_out_dis').val(num_sold_pro_out_dis);

    });
</script>