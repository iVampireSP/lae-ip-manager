<x-app-layout>
    <h3>新建地址池</h3>

    <form action="{{ route('pools.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="pool" class="form-label">IP 地址/子网掩码(例如 192.168.1.0/24)</label>
            <input type="text" class="form-control" id="pool" name="pool" value="{{ old('pool') }}">
        </div>

        <div class="mb-3">
            <label for="gateway" class="form-label">网关</label>
            <input type="text" class="form-control" id="gateway" name="gateway" value="{{ old('gateway') }}">
        </div>


        <div class="mb-3">
            <label for="nameservers" class="form-label">名称服务器(一行一个，最多4个)</label>
            <textarea class="form-control" id="nameservers" name="nameservers" rows="4">{{ old('nameservers') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">介绍</label>
            <input type="text" class="form-control" id="description" name="description"
                value="{{ old('description') }}">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">价格</label>
            <input type="text" class="form-control" id="price" name="price"
                value="{{ old('price') }}">
        </div>

        {{-- 选择可用区 --}}
        <div class="mb-3">
            <label for="region_id" class="form-label">可用区</label>
            <select class="form-select" id="region_id" name="region_id">
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">提交</button>
    </form>

</x-app-layout>
