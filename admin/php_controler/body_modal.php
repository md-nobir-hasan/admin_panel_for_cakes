<!-- This modal body for product +,- with discount  -->
<div>
    <form>
        <input id="num_p" type="number" value="">
    </form>
</div>


<script>
    $(document).ready(function() {

        var num_sold_p = localStorage.getItem("num_sold_p");
        $('#num_p').val(num_sold_p);

    });
</script>