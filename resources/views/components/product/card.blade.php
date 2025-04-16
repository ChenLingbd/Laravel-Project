@php
    use App\Enums\Tagtype;
@endphp

<div>
    <section class="bg-white py-16">

        <x-h.h1>推薦書籍</x-h.h1>

        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3 max-w-7xl mx-auto px-4">
            @foreach ($products as $product)
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm max-w-sm mx-auto w-full"
                    data-v0-t="card">
                    <div class="space-y-1.5 p-6">
                        <h4 class="font-semibold text-2xl mb-2">商品名稱:{{ $product->name }}</h4>
                        <div>
                            <h1 class="font-semibold">用戶名稱:{{ $product->user->name }}</h1>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="text-2xl font-bold">${{ $product->price }}</div>
                        <h1 class="font-semibold">上架時間: {{ $product->updated_at->format('Y/m/d') }}</h1>
                        <p class="font-semibold text-sm mt-2">{{ $product->description }}</p>
                        <div class="mt-4">
                            @if ($product->media->isNotEmpty())
                                @php
                                    $media = $product->getFirstMedia('images');
                                @endphp
                                @if ($media)
                                    <img src="{{ $media->getUrl() }}" alt="這是圖片" width="1200" height="900"
                                        style="aspect-ratio: 900 / 1200; object-fit: cover;"
                                        class="w-full rounded-md object-cover" />
                                @else
                                    <div>沒圖片</div>
                                @endif
                            @else
                                <div>沒有圖片</div>
                            @endif
                        </div>
                        <div class="flex items-center justify-between mb-8">
                            <x-h.h6>年級 :
                                <x-span.font-semibold>
                                    @php
                                        $gradeTag = $product->tags->firstWhere('type', Tagtype::Grade->value);
                                        $semesterTag = $product->tags->firstWhere('type', Tagtype::Semester->value);
                                    @endphp
                                    {{ $gradeTag ? $gradeTag->name : '無' }}
                                    {{ $semesterTag ? $semesterTag->name : '學期:無' }}
                                </x-span.font-semibold>
                            </x-h.h6>
                            <x-h.h6>課程 :
                                <x-span.font-semibold>
                                    @php
                                        $categoryTag = $product->tags->firstWhere('type', Tagtype::Category->value);
                                    @endphp
                                    {{ $categoryTag ? $categoryTag->name : '無' }}
                                </x-span.font-semibold>
                            </x-h.h6>
                        </div>
                    </div>
                    <div class="flex items-center pt-2 p-6">
                        <a href= "{{ route('products.show', ['product' => $product->id]) }}">
                            <x-button.blue-short>
                                洽談
                            </x-button.blue-short>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
