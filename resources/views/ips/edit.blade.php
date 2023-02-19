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
            <label for="module_id" class="form-label">绑定的 Module ID</label>
            <input type="text" class="form-control" id="module_id" name="module_id"
                   value="{{ $ip->module_id }}">
        </div>

        <div class="mb-3">
            <label for="host_id" class="form-label">绑定的 Host ID</label>
            <input type="text" class="form-control" id="host_id" name="host_id"
                   value="{{ $ip->host_id }}">
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

    <hr/>
    <p>要解绑 IP，请联系对应的模块。</p>
    <form action="{{ route('ips.destroy', $ip->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">清除参数</button>
    </form>

</x-app-layout>
