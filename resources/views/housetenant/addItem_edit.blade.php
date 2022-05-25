<div class="row">



    @php
        
        foreach ($global_vehicle_type as $key => $vehicle_type) {
            foreach ($tenant_vehicle_type_array as $tenant_vehicle_type) {
                if ($vehicle_type->type_id == $tenant_vehicle_type) {
                    unset($global_vehicle_type[$key]);
                }
            }
        }
    @endphp


    <div class="col-sm-5 col-md-5 col-lg-5 px-0">
        <div class="form-group">
            <select class="form-control form-select-sm shadow-sm" aria-label="Default select example"
                name="edit_tenant_vehicle_type[]">
                <option value="" selected>- Sila Pilih -</option>
                @foreach ($global_vehicle_type as $vehicle_type)
                    {{-- <option value="{{ $region->type_id }}">{{ $region->type_name }}</option> --}}
                    {{-- @foreach ($tenant_vehicle_type_array as $tenant_vehicle_type)
                        @if ($vehicle_type->type_id == $tenant_vehicle_type)

                        @else --}}
                    @if (Request::old('tenant_vehicle_type') == $vehicle_type->type_id)
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
            <input type="text" class="form-control shadow-sm" id="tenant_vehicle_count"
                name="edit_tenant_vehicle_count[]" value="{{ old('tenant_vehicle_count') }}">
        </div>
    </div>

</div>
