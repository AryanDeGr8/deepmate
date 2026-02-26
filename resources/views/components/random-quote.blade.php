@props(['quote','name'])
<div {{ $attributes->merge(['class' => 'p-6 text-xl text-gray-900 dark:text-gray-100']) }}>
    <figure class="max-w-screen-md mx-auto text-center">
        <blockquote class="flex justify-center">
            <p class="text-2xl italic tracking-tight text-heading text-center">"{{ $quote }}"</p>
        </blockquote>

        <figcaption class="flex items-center justify-center mt-6 space-x-3 rtl:space-x-reverse">
            <div class="flex items-center divide-x rtl:divide-x-reverse divide-default">
                <cite class="pe-3 font-medium text-heading"> - {{ $name }}</cite>
            </div>
        </figcaption>
    </figure>
</div>
