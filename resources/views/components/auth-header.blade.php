@props([
    'title',
    'description',
])
<link rel="stylesheet" href="{{asset('assets/css/message.css')}}">
</script><script src="{{asset('assets/js/scrollreveal.js')}}"></script>

<div class="flex w-full flex-col text-center">
    <flux:heading size="xl">{{ $title }}</flux:heading>
    <flux:subheading>{{ $description }}</flux:subheading>
</div>
