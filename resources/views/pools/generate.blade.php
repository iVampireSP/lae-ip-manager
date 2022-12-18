<x-app-layout>
    <h3>IP 地址生成器</h3>

    {{-- 输入地址数量 --}}
    <form action="{{ route('pools.generate', $pool->id) }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="count" class="form-label">数量(最大 1000 个)</label>
            <input type="text" class="form-control" id="count" name="count" value="{{ old('count') ?? 10 }}">
        </div>

        <button type="submit" class="btn btn-primary">生成</button>
    </form>

</x-app-layout>
