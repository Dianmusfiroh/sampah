<script>
    var url = '';
    const deleteData = (id) =>{
        url = '{{route("${model}.destroy",":id")}}';
        url = url.replace(':id',id);
        $("#deleteForm").attr('action',url);
    }
    const formSubmit = () => {
        $("#deleteForm").submit();
    }
</script>
