<select id="<?=$id?>" name="<?=$name?>" class="form-control" style="width: 100%;">
</select>

<?= $this->section('on_document_ready_script') ?>
 
<?= $this->endSection() ?>

<?= $this->section('page_script') ?>

<script>

	function loadDoTypes(selectedValue = null) 
    {
        $.ajax({

            url: "<?= base_url($endpoint) ?>",

            type: "GET",

            dataType: "json",

            success: function(response) {

                let html =
                    '<option value="">Select Day Off Type</option>';

                $.each(response.data, function(index, item) {

                    html += `
                        <option value="${item.id}">
                            ${item.name}
                        </option>
                    `;

                });

                $('#<?=$id?>').html(html);
                console.log(selectedValue);
                if (selectedValue !== null) {
                    $('#<?=$id?>').val(selectedValue);
                }
            }

        });
    }
</script>

<?= $this->endSection() ?>
