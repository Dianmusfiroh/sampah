<script>
    var url = '';

    const deleteData = (id) =>{
        url = '{{route("settingCustom.destroy",":id")}}';
        url = url.replace(':id',id);
        console.log(id);
        $("#deleteForm").attr('action',url);
    }
    const formSubmit = () => {
        $("#deleteForm").submit();
    }
</script>
