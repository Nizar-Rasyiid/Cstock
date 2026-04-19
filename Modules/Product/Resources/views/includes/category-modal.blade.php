@php
    $category_max_id = \Modules\Product\Entities\Category::max('id') + 1;
    $category_code = "CA_" . str_pad($category_max_id, 2, '0', STR_PAD_LEFT)
@endphp
<div class="modal fade" id="categoryCreateModal" tabindex="-1" role="dialog" aria-labelledby="categoryCreateModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryCreateModalLabel">Create Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('product-categories.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category_code">Category Code <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="category_code" id="category_code" required onkeyup="checkCategoryCode()">
                        <small id="category_code_error" class="text-danger" style="display: none;">Category Code already exists.</small>
                        <small id="category_code_success" class="text-success" style="display: none;">You can use this Category Code.</small>
                    </div>
                    <div class="form-group">
                        <label for="category_name">Category Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="category_name" required>
                    </div>
                    <div class="form-group">
                        <label for="group_category_id">Group Category <span class="text-danger">*</span></label>
                        <select name="group_category_id" class="form-control">
                            <option value="">Pilih Kategori</option>
                            @foreach($group_categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Create <i class="bi bi-check"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function checkCategoryCode() {
        const categoryCode = document.getElementById('category_code').value;
        const errorElement = document.getElementById('category_code_error');
        const successElement = document.getElementById('category_code_success');

        if (categoryCode.length > 0) {
            // Make an AJAX request to check if the category code exists
            fetch("{{ route('category.check_code') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                body: JSON.stringify({ code: categoryCode })
            })
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    errorElement.style.display = "block";
                    successElement.style.display = "none";  // Show error message
                } else {
                    errorElement.style.display = "none"; 
                    successElement.style.display = "block"; // Hide error message
                }
            });
        } else {
            errorElement.style.display = "none";  // Hide error if input is empty
        }
    }
</script>