<x-app :title="$title" :description="$meta_description" :keywords="$meta_keywords"
    :ogImage="asset('assets/img/meta-img.jpg')" :ogUrl="url()->current()">
    <livewire:section.banner />
    <livewire:section.products />
</x-app>