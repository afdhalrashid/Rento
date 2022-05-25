<div class="row">

    <div class="col-sm-5 col-md-5 col-lg-5 px-0">
        <div class="form-group">
            @if ($key == 0)
                <label for="edit_tenant_vehicle_type">Jenis Kenderaan</label>
                <small class="text-muted">cth.<i> Kereta</i></small>
            @endif
            <select class="form-control form-select-sm shadow-sm" aria-label="Default select example"
                name="edit_tenant_vehicle_type[]">
                <option value="">- Sila Pilih -</option>
                @foreach ($global_vehicle_type as $vehicle_type)
                    {{-- <option value="{{ $region->type_id }}">{{ $region->type_name }}</option> --}}
                    {{-- @foreach ($tenant_vehicle_type_array as $tenant_vehicle_type)
                        @if ($vehicle_type->type_id == $tenant_vehicle_type)

                        @else --}}
                    @if ($vehicle->vehicle_type == $vehicle_type->type_id)
                        <option value="{{ $vehicle_type->type_id }}" selected>
                            {{ $vehicle_type->type_name }}</option>
                    @else
                        <option value="{{ $vehicle_type->type_id }}">
                            {{ $vehicle_type->type_name }}
                        </option>
                    @endif
                    {{-- @endif
                    @endforeach --}}


                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-4 col-md-4 col-lg-4 px-2">
        <div class="form-group">
            @if ($key == 0)
                <label for="edit_tenant_vehicle_count">Bilangan Kenderaan</label>
                <small class="text-muted">cth.<i> 1/2/3</i></small>
            @endif
            <input type="text" class="form-control shadow-sm" id="tenant_vehicle_count"
                name="edit_tenant_vehicle_count[]" value="{{ $vehicle->vehicle_count }}">
        </div>
    </div>
    @if ($key == 0)
        <div class="col-sm-2 col-md-2 col-lg-2 px-1">
            <div class="form-group">
                <label for="helpInputTop">&nbsp;</label>
                <button class="btn-sm btn-success form-control" onclick="addnewEditItem();return false;"><i
                        class="fas fa-plus"></i></button>
            </div>
        </div>
    @endif

</div>
