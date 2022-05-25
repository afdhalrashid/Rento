<style>
    address {
        text-align: left;
    }

    address>span {
        text-align: left;
        display: inline-block;
    }

</style>

<span class="align-middle"> </span>
<div> </div>
<div></div>
<input name="house_id" type="hidden" value="{{ $house->id }}">
<address class="my-3">
    <span>
        {{ $house->address1 }}, {{ $house->address2 }},<br />
        {{ $house->poskod }}, {{ $house->daerah }},<br />
        {{ $house->parameter_state->type_name }}<br />
    </span>
</address>
