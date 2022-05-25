<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>

<script>
var i = 0;
var addbtn;
$("#addbtn").click(function(){
++i;
$("#dynamicAddRemove").append('<tr><td><input type="text" name="moreFields['+i+'][name]" placeholder="" class="form-control" /></td><td><input type="number" name="moreFields['+i+'][harga]]" placeholder="" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
});
$(document).on('click', '.remove-tr', function(){
$(this).parents('tr').remove();
});
</script>
