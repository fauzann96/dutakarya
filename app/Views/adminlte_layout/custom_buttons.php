<script>
    function deleteButton(onclickFunction = null){
        let onclickAttr = onclickFunction ? ` onclick="${onclickFunction}"` : '';
        return `<button type="button" id="delete" class="btn btn-danger btn-xs"${onclickAttr}><i class="fas fa-trash"></i>Hapus</button>`;
    }
    function editButton(onclickFunction = null){
        let onclickAttr = onclickFunction ? ` onclick="${onclickFunction}"` : '';
        return `<button type="button" id="edit" class="btn btn-info btn-xs"${onclickAttr}><i class="fas fa-edit"></i> Edit</button>`;
    }
    function viewButton(){
        return `<button type="button" id="view" class="btn btn-primary btn-xs"><i class="fas fa-eye"></i> Lihat</button>`;
    }
</script>