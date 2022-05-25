@section('plugins.Sweetalert2', true)
<script>
    var Toast = Swal.mixin({
      toast: true,
      position: 'top',
      showConfirmButton: false,
      timer: 3000
    });
    const showToast = (icon='success',title='toast title') => {
        Toast.fire({
            icon: icon,
            title: title
        });
    }
</script>