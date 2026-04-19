<div>
    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Group Kategori</label>
                <select wire:model.live="categoryGroup" class="form-control">
                    <option value="">Semua Group</option>
                    @foreach($categoryGroups as $group)
                        <option value="{{ $group->id }}">{{ $group->category_name ?? $group->group_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Kategori</label>
                <select wire:model.live="category" class="form-control">
                    <option value="">Semua Kategori</option>
                    @foreach($availableCategories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
