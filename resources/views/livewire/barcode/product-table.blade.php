<div>
    @if (session()->has('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <div class="alert-body">
                <span>{{ session('message') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <livewire:pos.filter :categories="$categories"/>
            <div class="table-responsive-md">
                <table class="table table-bordered mb-0">
                    <thead>
                    <tr class="align-middle">
                        <th class="align-middle">Product Name</th>
                        <th class="align-middle">Code</th>
                        <th class="align-middle">
                            Quantity <i class="bi bi-question-circle-fill text-info" data-toggle="tooltip" data-placement="top" title="Max Quantity: 100"></i>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    {{-- <tr>
                        @if(!empty($product))
                            <td class="align-middle">{{ $product->product_name }}</td>
                            <td class="align-middle">{{ $product->product_code }}</td>
                            <td class="align-middle text-center" style="width: 200px;">
                                <input wire:model.live="quantity" class="form-control" type="number" min="1" max="100" value="{{ $quantity }}">
                            </td>
                        @else
                            <td colspan="3" class="text-center">
                                <span class="text-danger">Please search & select a product!</span>
                            </td>
                        @endif
                    </tr> --}}
                    <div wire:loading.flex class="col-12 position-absolute justify-content-center align-items-center" style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.5);z-index: 99;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    @foreach ($products as $product)
                        <tr>
                            <td class="align-middle">{{ $product->product_name }}</td>
                            <td class="align-middle">{{ $product->product_code }}</td>
                            <td class="align-middle text-center" style="width: 200px;">
                                <input wire:model.live="quantities.{{ $product->id }}" class="form-control" type="number" max="100" :value="quantities[{{ $product->id }}] ?? ''">
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                <button wire:click="generateBarcodes" type="button" class="btn btn-primary">
                    <i class="bi bi-upc-scan"></i> Generate Barcodes
                </button>
            </div>
        </div>
    </div>

    <div wire:loading wire:target="generateBarcodes" class="w-100">
        <div class="d-flex justify-content-center">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>

    @if(!empty($barcodes))
        <div class="text-right mb-3">
            <button wire:click="getPdf" wire:loading.attr="disabled" type="button" class="btn btn-primary">
                <span wire:loading wire:target="getPdf" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                <i wire:loading.remove wire:target="getPdf" class="bi bi-file-earmark-pdf"></i> Download PDF
            </button>
            <button wire:click="getThermal" wire:loading.attr="disabled" type="button" class="btn btn-secondary ml-2">
                <span wire:loading wire:target="getThermal" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                <i wire:loading.remove wire:target="getThermal" class="bi bi-printer"></i> Print Thermal
            </button>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                    @foreach($barcodes as $barcode)
                        <div class="col-lg-3 col-md-4 col-sm-6" style="border: 1px solid #000000;border-style: dashed;background-color: #ffffff;">
                            <p class="mt-3 mb-1" style="font-size: 15px;color: #000;">
                                {{ $barcode['product']->product_name }}
                            </p>
                            <div>
                                {!! $barcode['barcode'] !!}
                            </div>
                            @if(!empty($barcode['qrcode']))
                                <div class="mt-2 d-flex justify-content-center">
                                    {!! $barcode['qrcode'] !!}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <div @class(['mt-3' => $products->hasPages()])>
        {{ $products->links() }}
    </div>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('openNewTab', (data) => {
            window.open(data.url, '_blank');
        });
    });
</script>
