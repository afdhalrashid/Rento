<table id="listhouse_table" class="table table-striped">
    <thead>
        <tr>
            <th class="">No</th>
            <th class="">Nama Pemilik Rumah</th>
            <th class="">No telefon Pemilik Rumah</th>
            <th class="">Emel Pemilik Rumah</th>
            <th class="">Alamat Rumah</th>
            <th class="">Gambar Rumah</th>
            <th width="250px">Tindakan</th>
        </tr>
    </thead>
    @php $i=0 @endphp
    @foreach ($houses as $house)
        <tr>
            <td class="">{{ ++$i }}</td>
            <td class="">{{ $house->namaowner }}</td>
            <td class="">{{ $house->phoneno_owner }}</td>
            <td class="">{{ $house->email_owner }}</td>
            <td class="">{{ $house->address1 }}, {{ $house->address2 }}, {{ $house->poskod }},
                {{ $house->daerah }}, {{ $house->negeri }}</td>
            <td class="">
                @foreach ($house->images as $image)
                    <img class="hs_img" src="{{ asset($image->image_path) }}" width="80px" height="75px" />
                @endforeach

            </td>
            <td>

                {{-- {{ dd($listhouse_announced) }} --}}
                <input type="hidden" name="house_id[]" value="{{ $house->id }}">
                <input type="checkbox" name="check_house[]" value="{{ $house->id }}" @foreach ($listhouse_announced as $checked_house)  @if ($checked_house->house_id==$house->id)
                checked @endif
    @endforeach>
    </td>
    </tr>
    @endforeach
    {{-- <tr>

        <td>
            <input type="hidden" name="house_id[]" value="10">
            <input type="checkbox" name="check_house[]" value="10">
        </td>
    </tr> --}}
</table>
