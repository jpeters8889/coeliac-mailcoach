<div class="flex relative">
    <input type="hidden" wire.model="productId"/>

    @if($productId)
        <div class="flex @unless($block === 'single') flex-col space-y-2 items-center justify-center @endunless">
            <div style="@if($block === 'single') width: 20% @else width: 90% @endif">
                <img src="{{ $product->main_image }}"/>
            </div>
            <div style="@if($block === 'single') width: 80% @else width: 90% @endif">
                <h2 class="text-xl">{{ $product->title }}</h2>
                <p class="text-italic text-xs">{{ $product->extra['price'] }}</p>

                <textarea
                    wire:model.live="description"
                    class="text-base w-full border m-1 p-1"
                    x-data="{ resize: () => { $el.style.height = '5px'; $el.style.height = $el.scrollHeight + 'px' } }"
                    x-init="resize()"
                    @input="resize()"
                ></textarea>

                <a class="text-sm cursor-pointer" wire:click="remove">Remove...</a>
            </div>
        </div>
    @else
        <input type="text" wire:model.live.debounce="search" placeholder="Search products..." class="text-2xl w-full"/>
    @endif

    @if($search !== '')
        <div class="absolute bg-white min-h-[8rem] mt-2 shadow text-base w-full z-50"
             style="top: 100%; max-height: 500px; overflow: scroll;"
        >
            <ul class="">
                @forelse($results as $product)
                    <li class="flex p-2 space-x-2 hover:bg-gray-200 transition cursor-pointer @unless($loop->last) border-b @endunless"
                        wire:click="selectProduct({{ $product->id }})">
                        <div style="width: 20%">
                            <img src="{{ $product->main_image }}"/>
                        </div>
                        <div style="width: 80%">
                            <h2 class="text-xl">{{ $product->title }}</h2>
                            <p>{{ $product->meta_description }}</p>
                            <p class="text-italic text-xs">{{ $product->created_at }}</p>
                        </div>
                    </li>
                @empty
                    <li>No products found...</li>
                @endforelse
            </ul>
        </div>
    @endif
</div>
