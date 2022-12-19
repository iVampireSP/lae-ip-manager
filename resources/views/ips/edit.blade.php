<x-app-layout>
    <h3>编辑 {{ $ip->ip }}</h3>


    <p>IP 分配位置：{{ $ip->position }}</p>

    <form action="{{ route('ips.update', $ip->id) }}" method="post">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="mac" class="form-label">MAC 地址</label>
            <input type="text" class="form-control" id="mac" name="mac" value="{{ $ip->mac }}">
        </div>

        <div class="mb-3">
            <label for="hostname" class="form-label">主机名</label>
            <input type="text" class="form-control" id="hostname" name="hostname" value="{{ $ip->hostname }}">
        </div>


        <div class="mb-3">
            <label for="description" class="form-label">描述</label>
            <input type="text" class="form-control" id="description" name="description"
                value="{{ $ip->description }}">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">价格</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ $ip->price }}">
        </div>


        <div class="mb-3">
            <label for="blocked" class="form-label">保留此 IP</label>
            <select class="form-select" id="blocked" name="blocked">
                <option value="0" {{ $ip->blocked ? '' : 'selected' }}>否</option>
                <option value="1" {{ $ip->blocked ? 'selected' : '' }}>是</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
    </form>

    <hr />

    <form action="{{ route('ips.destroy', $ip->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">解除绑定</button>

    </form>

</x-app-layout>
